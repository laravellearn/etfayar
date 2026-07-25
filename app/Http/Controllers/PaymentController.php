<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\Preinvoice;
use App\Services\uploader\Uploader;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller {

    private $uploader;

    // نقش‌هایی که مجاز به دیدن/ثبت «تاریخ واریزی» و تایید/رد پرداخت‌ها هستن
    public const FINANCIAL_ROLES = ['financial manager', 'Chief Financial Officer', 'Accountants', 'Accounting assistant'];

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }

    public function index($invoice_id) {
        $list = Payment::query()->where('invoice_id', '=', $invoice_id)->orderBy('created_at', 'desc')->get();
        $title = __('payment.title');
        return view('payment.list', compact('list', 'title', 'invoice_id'));
    }

    public function create($invoice_id) {
        $single = Preinvoice::query()->where('id', '=', $invoice_id)->first();
        $title = " افزودن رسید پرداخت " . $single->request->user->full_name;
        $banks = Bank::all();
        return view('payment.add', compact('title', 'single', 'invoice_id', 'banks'));
    }

    public function store(Request $request) {
        // حداقل یکی از فیلدها باید مقدار داشته باشد
        if (
            empty($request->price) &&
            empty($request->bank_id) &&
            !$request->boolean('is_deposit')
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'payment' => 'حداقل یکی از موارد مبلغ، بانک یا بیعانه باید تکمیل شود.'
                ]);
        }

        // اگر مبلغ یا بانک وارد شده باشه، یعنی کاربر واقعاً می‌خواد یک پرداخت ثبت کنه
        $hasPaymentInfo = !empty($request->price) || !empty($request->bank_id);

        // بیعانه همیشه (چه به‌تنهایی چه همراه پرداخت) روی خودِ transports ثبت می‌شه
        if ($request->boolean('is_deposit')) {
            DB::table('transports')
                ->where('preinvoice_id', $request->invoice_id)
                ->update([
                    'is_deposit' => true,
                ]);
        }

        // رکورد Payment فقط وقتی ساخته می‌شه که اطلاعات بانکی/مبلغ واقعاً وارد شده باشه.
        // اگر کاربر فقط چک بیعانه رو زده باشه (بدون بانک/مبلغ)، اینجا اصلاً اجرا نمی‌شه.
        if ($hasPaymentInfo) {
            $single = new Payment();

            if ($request->boolean('is_deposit')) {
                $single->is_deposit = true;
            }

            if ($request->hasFile('upload_payment_receipt')) {
                $imagePath = $this->uploader->upload($request->upload_payment_receipt);
                $single->payment_receipt = $imagePath;
            }

            $single->admin_id = auth('admin')->id();
            $single->invoice_id = $request->invoice_id;
            $single->bank_id = $request->bank_id;
            $single->price = $request->price;
            $single->description = $request->description;
            // هر پرداخت جدید، صرف‌نظر از این‌که چه کسی ثبتش کرده، در انتظار تایید واحد
            // مالی می‌مونه؛ فقط بعد از تایید در گزارش بدهکاران و بستانکاران دیده می‌شه.
            $single->status = 0;

            // تاریخ واریزی رو فقط اگه ثبت‌کننده عضو واحد مالیه می‌پذیریم؛ برای بقیه
            // (کارشناس فروش/راننده) این فیلد تا زمان تایید مالی خالی می‌مونه.
            if (auth('admin')->user()->hasAnyRole(self::FINANCIAL_ROLES) && !empty($request->payment_date)) {
                $single->payment_date = Verta::parse($request->payment_date)->formatGregorian('Y-m-d');
            }

            $single->save();

            \App\Services\Notification\SystemNotifier::toRoles(
                self::FINANCIAL_ROLES,
                'پرداخت جدید در انتظار تایید',
                'یک پرداخت جدید ثبت شده و در انتظار تایید واحد مالی است.',
                route('ledger.pending')
            );
        }

        return redirect()->route('transport.driversTasks')->with('status', 'با موفقیت ثبت شد');
    }

    public function edit($id) {
        $single = Payment::query()->where('id', $id)->firstOrFail();
        $banks = Bank::all();
        $title = __('payment.edit');
        $canSetPaymentDate = auth('admin')->user()->hasAnyRole(self::FINANCIAL_ROLES);
        return view('payment.edit', compact('single', 'banks', 'title', 'canSetPaymentDate'));
    }

    public function update(Request $request) {
        $single = Payment::query()->where('id', $request->id)->firstOrFail();

        $single->bank_id = $request->bank_id;
        $single->price = $request->price;
        $single->description = $request->description;

        if ($request->hasFile('upload_payment_receipt')) {
            $imagePath = $this->uploader->upload($request->upload_payment_receipt);
            $single->payment_receipt = $imagePath;
        }

        // فقط واحد مالی اجازه‌ی وارد کردن/تغییر تاریخ واریزی رو داره
        if (auth('admin')->user()->hasAnyRole(self::FINANCIAL_ROLES)) {
            $single->payment_date = !empty($request->payment_date)
                ? Verta::parse($request->payment_date)->formatGregorian('Y-m-d')
                : null;
        }

        $single->save();

        return redirect()->route('payments', $single->invoice_id)->with('status', 'با موفقیت ویرایش شد');
    }

    public function destroy($id) {
        $single = Payment::query()->where('id', $id)->firstOrFail();
        $single->delete();
        return back()->with('status', 'با موفقیت حذف شد');
    }

    public function agree_payment($id) {
        $single = Payment::query()->where('id', '=', $id)->first();
        $single->is_agree = true;
        $single->status = 1;
        // اگه تاریخ واریزی هنوز ثبت نشده، همون لحظه‌ی تاییدِ مالی به‌عنوان تاریخ واریزی ثبت می‌شه
        if (is_null($single->payment_date)) {
            $single->payment_date = now()->toDateString();
        }
        $single->save();
        return redirect()->back()->with('status', 'پرداخت تایید شد');
    }

    public function disagree_payment($id) {
        $single = Payment::query()->where('id', '=', $id)->first();
        $single->is_agree = false;
        $single->status = 2;
        $single->save();
        return redirect()->back()->with('status', 'پرداخت رد شد');
    }

}
