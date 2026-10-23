<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\Preinvoice;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class LedgerController extends Controller {

    /**
     * حداقل درصد مالیات برای فاکتورهای رسمی (طبق قرارداد ۱۰٪).
     * برای فاکتور رسمی، مالیات اعمال‌شده = بیشترِ (مالیات ثبت‌شده روی فاکتور، این مقدار)؛
     * بنابراین اگر روی فاکتور رسمی همین ۱۰٪ ثبت شده باشد دوبار حساب نمی‌شود.
     */
    public const OFFICIAL_INVOICE_TAX_PERCENT = 10;

    /**
     * اعداد فارسی/عربی را به انگلیسی تبدیل می‌کند.
     */
    private function normalizeDigits($value): string {
        return strtr((string)$value, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);
    }

    /**
     * تاریخ شمسی (مثلاً 1405/07/01) را به تاریخ میلادی Y-m-d تبدیل می‌کند؛ اگر نامعتبر بود null.
     */
    private function jalaliToGregorian($value): ?string {
        $value = trim($this->normalizeDigits($value));
        if ($value === '') {
            return null;
        }
        try {
            return Verta::parse($value)->formatGregorian('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * گزارش بدهکاران و بستانکاران: برای هر فاکتور صادرشده، مبلغ بدهکار (فاکتور
     * منهای تخفیف)، بستانکار (جمع پرداخت‌های تاییدشده)، باقیمانده و وضعیت رو
     * محاسبه و نمایش می‌ده.
     */
    public function index(Request $request) {
        $query = Preinvoice::query()
            ->where('is_invoice', true)
            ->whereHas('request')
            ->with([
                'request.user',
                'items',
                'information',
                'workshop.items',
                'payments' => function ($q) {
                    $q->where('status', 1); // فقط پرداخت‌های تاییدشده توسط مالی
                },
            ]);

        if (!empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhereHas('request.user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('family', 'like', "%{$search}%")
                            ->orWhere('company', 'like', "%{$search}%");
                    });
            });
        }

        // فیلتر شماره حساب (از بین حساب‌های ثبت‌شده در سیستم)
        $selectedBank = null;
        if (!empty($request->bank_id)) {
            $selectedBank = Bank::query()->where('id', $request->bank_id)->first();
            if ($selectedBank) {
                $query->where(function ($q) use ($selectedBank) {
                    $q->where('bank_id', $selectedBank->id);
                    if (!empty($selectedBank->account)) {
                        $q->orWhere('bank_account', $selectedBank->account);
                    }
                });
            }
        }

        // فیلتر بازه‌ی تاریخی (روی تاریخ صدور فاکتور: تاریخ تایید، و اگر نبود تاریخ ایجاد)
        $dateFrom = $this->jalaliToGregorian($request->date_from);
        $dateTo   = $this->jalaliToGregorian($request->date_to);
        if ($dateFrom) {
            $query->whereRaw('DATE(COALESCE(confirmed_at, created_at)) >= ?', [$dateFrom]);
        }
        if ($dateTo) {
            $query->whereRaw('DATE(COALESCE(confirmed_at, created_at)) <= ?', [$dateTo]);
        }

        $preinvoices = $query->orderByRaw('COALESCE(confirmed_at, created_at)')->orderBy('id')->get();

        $rows = $preinvoices->map(function ($p) {
            // مبلغ قابل پرداخت فاکتور = جمع آیتم‌ها + آیتم‌های داغی (کارگاه) + مالیات
            $itemsTotal    = collect($p->items)->sum(fn($i) => $i->count * $i->price);
            $workshopTotal = collect($p->workshop->items ?? [])->sum(fn($i) => $i->count * $i->price);
            $subTotal      = $itemsTotal + $workshopTotal;

            $taxPercent = (float)($p->tax ?? 0);
            $isOfficial = isset($p->information) && $p->information->header_type == 1;
            if ($isOfficial) {
                $taxPercent = max($taxPercent, self::OFFICIAL_INVOICE_TAX_PERCENT);
            }

            $payable    = round($subTotal + ($subTotal * $taxPercent / 100));
            $debit      = $payable - ($p->discount ?? 0);
            $credit     = $p->payments->sum('price');
            $remaining  = $debit - $credit;

            if ($remaining > 0) {
                $status = 'debtor';
            } elseif ($remaining < 0) {
                $status = 'creditor';
            } else {
                $status = 'settled';
            }

            return (object) [
                'preinvoice_id' => $p->id,
                'code'          => $p->code,
                'customer_id'   => $p->request->user->id ?? null,
                'customer_name' => $p->request->user->full_name ?? '',
                'bank_account'  => $p->bank_account,
                'persian_date'  => $p->is_invoice ? ($p->persianConfirmedAt ?? $p->persianDate) : $p->persianDate,
                'is_official'   => $isOfficial,
                'tax_percent'   => $taxPercent,
                'debit'         => $debit,
                'credit'        => $credit,
                'remaining'     => $remaining,
                'status'        => $status,
            ];
        });

        if (!empty($request->status_filter) && $request->status_filter !== 'all') {
            $rows = $rows->where('status', $request->status_filter);
        }

        $rows = $rows->values();

        $totals = (object) [
            'debit'     => $rows->sum('debit'),
            'credit'    => $rows->sum('credit'),
            'remaining' => $rows->sum('remaining'),
        ];

        // لیست حساب‌های ثبت‌شده در سیستم برای فیلتر شماره حساب
        $banks = Bank::query()->orderBy('name')->get();

        $title = __('ledger.title');
        return view('ledger.index', compact('rows', 'totals', 'title', 'banks'));
    }

    /**
     * پرداخت‌هایی که در انتظار تایید واحد مالی هستن.
     * status=0 یعنی در انتظار تایید مالی.
     */
    public function pendingApprovals() {
        $list = Payment::with([
                'preinvoice.request.user',
                'bank',
                'admin',
            ])
            ->where('status', 0)
            ->orderByDesc('created_at')
            ->get()
            ->each(function ($payment) {
                // اضافه کردن customer_name به عنوان ویژگی موقت روی هر پرداخت
                $payment->customer_name = $this->resolveCustomerName($payment);
            });

        $title = __('ledger.pending_approvals');
        return view('ledger.pending', compact('list', 'title'));
    }

    /**
     * پرداخت‌هایی که توسط واحد مالی رد شدن.
     * status=2 یعنی رد شده.
     */
    public function rejected() {
        $list = Payment::with([
                'preinvoice.request.user',
                'bank',
                'admin',
            ])
            ->where('status', 2)
            ->orderByDesc('created_at')
            ->get()
            ->each(function ($payment) {
                // اضافه کردن customer_name به عنوان ویژگی موقت روی هر پرداخت
                $payment->customer_name = $this->resolveCustomerName($payment);
            });

        $title = __('ledger.rejected');
        return view('ledger.rejected', compact('list', 'title'));
    }

    /**
     * نام مشتری را از زنجیره‌ی preinvoice → request → user می‌خواند.
     *
     * اگر هر بخشی از زنجیره null بود، به‌ترتیب fallback می‌کند به:
     *   1. preinvoice->seller_name  (اسنپ‌شات نام فروشنده روی فاکتور)
     *   2. رشته‌ی خالی
     *
     * این متد تضمین می‌کند که view هرگز با null کار نمی‌کند.
     */
    private function resolveCustomerName(Payment $payment): string {
        // زنجیره‌ی اصلی: payment → preinvoice → request → user → full_name
        $user = $payment->preinvoice?->request?->user ?? null;

        if ($user !== null) {
            return $user->full_name ?? '';
        }

        // fallback: اگر user پیدا نشد، از seller_name روی preinvoice استفاده کن
        return $payment->preinvoice?->seller_name ?? '';
    }
}
