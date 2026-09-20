<?php

namespace App\Http\Controllers;

use App\Models\Acquaintance;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\Preinvoice;
use App\Models\PreinvoiceItem;
use App\Models\Service;
use App\Models\Transport;
use App\Models\User;
use App\Models\UserRequest;
use App\Models\Workshop;
use App\Services\Report\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller {

    /**
     * نگاشتِ کلید هر متریکِ «شمارشیِ ماه/سال» به کوئری و ستون تاریخِ مربوطه.
     * $queryFactory هر بار باید یک Builder تازه برگردونه.
     *
     * @return array{0: \Closure, 1: string}
     */
    private function metricQuery(string $metric): array {
        return match ($metric) {
            'customers' => [fn() => User::query(), 'created_at'],
            'requests' => [fn() => UserRequest::query(), 'created_at'],
            'preinvoices' => [fn() => Preinvoice::query(), 'created_at'],
            'invoices' => [fn() => Preinvoice::query()->where('is_invoice', true), 'confirmed_at'],
            'transport_referrals' => [fn() => Transport::query(), 'created_at'],
            'driver_referrals' => [fn() => Transport::query()->whereNotNull('driver_assigned_at'), 'driver_assigned_at'],
            'driver_cancellations' => [fn() => Transport::query()->whereNotNull('cancel_time'), 'cancel_time'],
            'workshop_referrals' => [fn() => Workshop::query(), 'created_at'],
            default => throw new \InvalidArgumentException("متریک نامعتبر: {$metric}"),
        };
    }

    // -------------------------------------------------------------------
    // صفحات
    // -------------------------------------------------------------------

    public function customersRequests() {
        $title = 'گزارش مشتریان و درخواست‌ها';
        return view('reports.customers_requests', compact('title'));
    }

    public function invoicesRevenue() {
        $title = 'گزارش پیش‌فاکتور، فاکتور و درآمد';
        return view('reports.invoices_revenue', compact('title'));
    }

    public function transportWorkshop() {
        $title = 'گزارش ترابری و کارگاه';
        return view('reports.transport_workshop', compact('title'));
    }

    public function servicesAccounts() {
        $title = 'گزارش سرویس‌ها و حساب‌ها';
        return view('reports.services_accounts', compact('title'));
    }

    // -------------------------------------------------------------------
    // داده‌های عمومی (AJAX) — روند ماهانه
    // -------------------------------------------------------------------

    /**
     * روند N ماهِ اخیر برای یک متریکِ شمارشی.
     * GET /reports/data/trend/{metric}?months=12
     */
    public function trend(Request $request, string $metric) {
        [$queryFactory, $column] = $this->metricQuery($metric);
        $months = (int)($request->query('months', 12));
        $months = max(1, min($months, 36));

        $series = ReportService::trailingMonths($months);
        $labels = [];
        $values = [];
        foreach ($series as $m) {
            [$start, $end] = ReportService::jalaliMonthRange($m['year'], $m['month']);
            $labels[] = $m['label'];
            $values[] = ReportService::countInRange($queryFactory, $column, $start, $end);
        }

        return response()->json(['labels' => $labels, 'values' => $values]);
    }

    /**
     * مقایسه‌ی دو دوره (هرکدوم می‌تونه یک ماهِ مشخص یا یک سالِ کامل باشه).
     * GET /reports/data/compare/{metric}?year1=..&month1=..&year2=..&month2=..
     */
    public function compare(Request $request, string $metric) {
        $year1 = (int)$request->query('year1', ReportService::currentJalaliYear());
        $month1raw = $request->query('month1');
        $month1 = ($month1raw === null || $month1raw === '') ? null : (int)$month1raw;

        $year2 = (int)$request->query('year2', ReportService::currentJalaliYear() - 1);
        $month2raw = $request->query('month2');
        $month2 = ($month2raw === null || $month2raw === '') ? null : (int)$month2raw;

        [$queryFactory, $column] = $this->metricQuery($metric);

        [$start1, $end1] = ReportService::periodRange($year1, $month1);
        [$start2, $end2] = ReportService::periodRange($year2, $month2);

        $value1 = ReportService::countInRange($queryFactory, $column, $start1, $end1);
        $value2 = ReportService::countInRange($queryFactory, $column, $start2, $end2);

        $diffPercent = null;
        if ($value2 > 0) {
            $diffPercent = round((($value1 - $value2) / $value2) * 100, 1);
        }

        return response()->json([
            'period1' => ['label' => ReportService::periodLabel($year1, $month1), 'value' => $value1],
            'period2' => ['label' => ReportService::periodLabel($year2, $month2), 'value' => $value2],
            'diff_percent' => $diffPercent,
        ]);
    }

    // -------------------------------------------------------------------
    // گزارش درآمدِ شارژ (مورد ۲)
    // -------------------------------------------------------------------

    /**
     * درآمدِ «شارژ»: مجموعِ ردیف‌های preinvoice_items که:
     *  - متعلق به یک فاکتورِ واقعی (is_invoice = true) هستن (نه یک پیش‌فاکتورِ صرف)
     *  - عنوانشون با «شارژ» شروع می‌شه (تنها راهِ موجود برای تفکیکِ نوعِ ردیف، چون
     *    preinvoice_items فیلدِ «نوع» جداگانه نداره — فقط یک عنوانِ متنی).
     *
     * ⚠️ این یک قاعده‌ی قابل‌تنظیمه؛ اگه عنوان‌های دیگه‌ای هم باید «شارژ» حساب
     * بشن، کافیه آرایه‌ی $chargeTitlePrefixes رو تغییر بدید.
     */
    private function chargeRevenueInRange($start, $end): float {
        $chargeTitlePrefixes = ['شارژ'];

        $query = PreinvoiceItem::query()
            ->whereHas('preinvoice', function ($q) use ($start, $end) {
                $q->where('is_invoice', true)
                    ->where('confirmed_at', '>=', $start)
                    ->where('confirmed_at', '<', $end);
            });

        $query->where(function ($q) use ($chargeTitlePrefixes) {
            foreach ($chargeTitlePrefixes as $prefix) {
                $q->orWhere('title', 'like', $prefix . '%');
            }
        });

        return (float)$query->get()->sum(function ($item) {
            return $item->count * $item->price;
        });
    }

    public function chargeRevenueTrend(Request $request) {
        $months = (int)($request->query('months', 12));
        $months = max(1, min($months, 36));
        $series = ReportService::trailingMonths($months);

        $labels = [];
        $values = [];
        foreach ($series as $m) {
            [$start, $end] = ReportService::jalaliMonthRange($m['year'], $m['month']);
            $labels[] = $m['label'];
            $values[] = $this->chargeRevenueInRange($start, $end);
        }

        return response()->json(['labels' => $labels, 'values' => $values]);
    }

    public function chargeRevenueCompare(Request $request) {
        $year1 = (int)$request->query('year1', ReportService::currentJalaliYear());
        $month1raw = $request->query('month1');
        $month1 = ($month1raw === null || $month1raw === '') ? null : (int)$month1raw;

        $year2 = (int)$request->query('year2', ReportService::currentJalaliYear() - 1);
        $month2raw = $request->query('month2');
        $month2 = ($month2raw === null || $month2raw === '') ? null : (int)$month2raw;

        [$start1, $end1] = ReportService::periodRange($year1, $month1);
        [$start2, $end2] = ReportService::periodRange($year2, $month2);

        $value1 = $this->chargeRevenueInRange($start1, $end1);
        $value2 = $this->chargeRevenueInRange($start2, $end2);

        $diffPercent = null;
        if ($value2 > 0) {
            $diffPercent = round((($value1 - $value2) / $value2) * 100, 1);
        }

        return response()->json([
            'period1' => ['label' => ReportService::periodLabel($year1, $month1), 'value' => $value1],
            'period2' => ['label' => ReportService::periodLabel($year2, $month2), 'value' => $value2],
            'diff_percent' => $diffPercent,
        ]);
    }

    // -------------------------------------------------------------------
    // درصد تبدیل پیش‌فاکتور به فاکتور (مورد ۶)
    // -------------------------------------------------------------------

    /**
     * از بین پیش‌فاکتورهایی که در یک دوره‌ی مشخص «ثبت» شدن، چند درصدشون
     * (تا همین الان) به فاکتور تبدیل شدن. GET ?year=..&month=..(اختیاری)
     */
    public function conversionRate(Request $request) {
        $year = (int)$request->query('year', ReportService::currentJalaliYear());
        $monthRaw = $request->query('month');
        $month = ($monthRaw === null || $monthRaw === '') ? null : (int)$monthRaw;

        [$start, $end] = ReportService::periodRange($year, $month);

        $total = Preinvoice::query()->where('created_at', '>=', $start)->where('created_at', '<', $end)->count();
        $converted = Preinvoice::query()->where('created_at', '>=', $start)->where('created_at', '<', $end)->where('is_invoice', true)->count();
        $percent = $total > 0 ? round(($converted / $total) * 100, 1) : 0;

        return response()->json([
            'label' => ReportService::periodLabel($year, $month),
            'total' => $total,
            'converted' => $converted,
            'percent' => $percent,
        ]);
    }

    // -------------------------------------------------------------------
    // گزارش‌های ترکیبی (موارد ۷، ۸، ۹)
    // -------------------------------------------------------------------

    /**
     * درصدِ نوعِ آشنایی مشتری‌ها + تعداد کل مشتریان.
     */
    public function acquaintanceBreakdown() {
        $total = User::query()->count();

        $rows = User::query()
            ->select('acquaintance_id', DB::raw('count(*) as cnt'))
            ->groupBy('acquaintance_id')
            ->get();

        $acquaintances = Acquaintance::all()->keyBy('id');

        $items = $rows->map(function ($row) use ($acquaintances, $total) {
            $title = is_null($row->acquaintance_id)
                ? 'ثبت نشده'
                : ($acquaintances[$row->acquaintance_id]->title ?? 'نامشخص');
            return [
                'title' => $title,
                'count' => (int)$row->cnt,
                'percent' => $total > 0 ? round(($row->cnt / $total) * 100, 1) : 0,
            ];
        })->sortByDesc('count')->values();

        return response()->json(['total' => $total, 'items' => $items]);
    }

    /**
     * تعداد درخواست‌های مشتریان بر اساس نوع سرویس.
     */
    public function requestsByService() {
        $rows = UserRequest::query()
            ->select('service_id', DB::raw('count(*) as cnt'))
            ->groupBy('service_id')
            ->get();

        $services = Service::all()->keyBy('id');

        $items = $rows->map(function ($row) use ($services) {
            return [
                'title' => $services[$row->service_id]->title ?? 'نامشخص',
                'count' => (int)$row->cnt,
            ];
        })->sortByDesc('count')->values();

        return response()->json(['items' => $items]);
    }

    /**
     * موجودیِ واریزی مشتری‌ها به تفکیک حساب‌های بانکی.
     * فقط واریزی‌های تاییدشده (is_deposit = true و status = 1) در نظر گرفته می‌شن.
     */
    public function bankBalances() {
        $rows = Payment::query()
            ->where('is_deposit', true)
            ->where('status', 1)
            ->select('bank_id', DB::raw('sum(price) as total'))
            ->groupBy('bank_id')
            ->get();

        $banks = Bank::all()->keyBy('id');

        $items = $rows->map(function ($row) use ($banks) {
            $bank = $banks[$row->bank_id] ?? null;
            return [
                'title' => $bank->name ?? ($bank->title ?? 'نامشخص'),
                'total' => (float)$row->total,
            ];
        })->sortByDesc('total')->values();

        return response()->json(['items' => $items]);
    }
}
