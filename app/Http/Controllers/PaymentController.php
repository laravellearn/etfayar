<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\Preinvoice;
use App\Services\uploader\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller {

    private $uploader;


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

public function store(Request $request)
{
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
        $single->save();
    }

    return redirect()->route('transport.driversTasks');
}


// public function store(Request $request)
// {
//     // حداقل یکی از فیلدها باید مقدار داشته باشد
//     if (
//         empty($request->price) &&
//         empty($request->bank_id) &&
//         !$request->boolean('is_deposit')
//     ) {
//         return redirect()->back()
//             ->withInput()
//             ->withErrors([
//                 'payment' => 'حداقل یکی از موارد مبلغ، بانک یا بیعانه باید تکمیل شود.'
//             ]);
//     }

//     $single = new Payment();

//     if ($request->boolean('is_deposit')) {
//         $single->is_deposit = true;
//     }

//     if ($request->hasFile('upload_payment_receipt')) {
//         $imagePath = $this->uploader->upload($request->upload_payment_receipt);
//         $single->payment_receipt = $imagePath;
//     }

//     $single->admin_id = auth('admin')->id();
//     $single->invoice_id = $request->invoice_id;
//     $single->bank_id = $request->bank_id;
//     $single->price = $request->price;
//     $single->description = $request->description;
//     $single->save();

//     if ($request->boolean('is_deposit')) {
//         DB::table('transports')
//             ->where('preinvoice_id', $request->invoice_id)
//             ->update([
//                 'is_deposit' => true,
//             ]);
//     }

//     return redirect()->route('transport.driversTasks');
// }

    public function agree_payment($id) {
        $single = Payment::query()->where('id', '=', $id)->first();
        $single->is_agree = true;
        $single->save();
        return redirect()->back();
    }
    public function disagree_payment($id) {
        $single = Payment::query()->where('id', '=', $id)->first();
        $single->is_agree = false;
        $single->save();
        return redirect()->back();
    }

}
