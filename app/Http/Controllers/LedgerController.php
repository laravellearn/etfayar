<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Preinvoice;
use Illuminate\Http\Request;

class LedgerController extends Controller {

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

        $preinvoices = $query->orderBy('created_at')->get();

        $rows = $preinvoices->map(function ($p) {
            $itemsTotal = collect($p->items)->sum(fn($i) => $i->count * $i->price);
            $debit      = $itemsTotal - ($p->discount ?? 0);
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
                'persian_date'  => $p->persianDate,
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

        $title = __('ledger.title');
        return view('ledger.index', compact('rows', 'totals', 'title'));
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
