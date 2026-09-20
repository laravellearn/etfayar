<?php

namespace App\Services\Report;

use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Carbon;

/**
 * توابع کمکیِ مشترک بین همه‌ی صفحات گزارش.
 *
 * نکته‌ی مهم: چون تقویم شمسی (جلالی) با میلادی روی هم نمی‌افته (ماه‌ها هم‌طول
 * نیستن)، نمی‌شه مستقیم با GROUP BY / DATE_FORMAT در MySQL بر اساس «ماه شمسی»
 * گروه‌بندی کرد. به همین خاطر برای هر بازه‌ی شمسی (یک ماه یا یک سال)، بازه‌ی
 * معادل میلادی‌اش محاسبه می‌شه و با where بین آن دو تاریخ فیلتر می‌شه.
 */
class ReportService {

    public const MONTH_NAMES = [
        1 => 'فروردین', 2 => 'اردیبهشت', 3 => 'خرداد', 4 => 'تیر',
        5 => 'مرداد', 6 => 'شهریور', 7 => 'مهر', 8 => 'آبان',
        9 => 'آذر', 10 => 'دی', 11 => 'بهمن', 12 => 'اسفند',
    ];

    public static function currentJalaliYear(): int {
        return (int)Verta::now()->year;
    }

    public static function currentJalaliMonth(): int {
        return (int)Verta::now()->month;
    }

    /**
     * ابتدای یک ماهِ شمسیِ مشخص، به‌صورت Carbon میلادی.
     */
    public static function startOfJalaliMonth(int $jYear, int $jMonth): Carbon {
        $v = Verta::parse(sprintf('%04d-%02d-01 00:00:00', $jYear, $jMonth));
        return Carbon::instance($v->toCarbon());
    }

    /**
     * بازه‌ی [شروع, پایان) یک ماهِ شمسی، به‌صورت دو تاریخ میلادی. پایان، شروعِ
     * ماهِ بعدیه (exclusive) که هم برای فروردین تا اسفند و هم برای تغییر سال
     * درست کار می‌کنه.
     *
     * @return array{0: Carbon, 1: Carbon}
     */
    public static function jalaliMonthRange(int $jYear, int $jMonth): array {
        $start = self::startOfJalaliMonth($jYear, $jMonth);
        $nextMonth = $jMonth + 1;
        $nextYear = $jYear;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }
        $end = self::startOfJalaliMonth($nextYear, $nextMonth);
        return [$start, $end];
    }

    /**
     * بازه‌ی [شروع, پایان) یک سالِ شمسیِ کامل (فروردین تا پایان اسفند).
     *
     * @return array{0: Carbon, 1: Carbon}
     */
    public static function jalaliYearRange(int $jYear): array {
        $start = self::startOfJalaliMonth($jYear, 1);
        $end = self::startOfJalaliMonth($jYear + 1, 1);
        return [$start, $end];
    }

    /**
     * بازه‌ی یک دوره: اگه ماه مشخص شده باشه، همون یک ماه؛ وگرنه کل اون سال.
     *
     * @return array{0: Carbon, 1: Carbon}
     */
    public static function periodRange(int $jYear, ?int $jMonth): array {
        if (is_null($jMonth)) {
            return self::jalaliYearRange($jYear);
        }
        return self::jalaliMonthRange($jYear, $jMonth);
    }

    /**
     * برچسبِ قابل‌نمایشِ یک دوره، مثلاً «تیر ۱۴۰۳» یا «سال ۱۴۰۳».
     */
    public static function periodLabel(int $jYear, ?int $jMonth): string {
        if (is_null($jMonth)) {
            return "سال {$jYear}";
        }
        $monthName = self::MONTH_NAMES[$jMonth] ?? $jMonth;
        return "{$monthName} {$jYear}";
    }

    /**
     * فهرستِ N ماهِ شمسیِ اخیر (پیش‌فرض ۱۲ ماه)، به ترتیب از قدیم به جدید؛
     * هر آیتم: ['year' => .., 'month' => .., 'label' => ..]
     */
    public static function trailingMonths(int $count = 12, ?int $endYear = null, ?int $endMonth = null): array {
        $endYear = $endYear ?? self::currentJalaliYear();
        $endMonth = $endMonth ?? self::currentJalaliMonth();

        $months = [];
        $y = $endYear;
        $m = $endMonth;
        for ($i = 0; $i < $count; $i++) {
            $months[] = ['year' => $y, 'month' => $m, 'label' => self::MONTH_NAMES[$m] . ' ' . $y];
            $m--;
            if ($m < 1) {
                $m = 12;
                $y--;
            }
        }
        return array_reverse($months);
    }

    /**
     * تعداد رکوردهایی از یک کوئری که تاریخِ ستونِ مشخص‌شده‌شون در بازه‌ی
     * [start, end) قرار می‌گیره. $queryFactory باید هر بار یک Builder تازه
     * برگردونه (چون هر فراخوانی، شرط where جدیدی به همون کوئری اضافه می‌کنه).
     */
    public static function countInRange(\Closure $queryFactory, string $column, Carbon $start, Carbon $end): int {
        return $queryFactory()->where($column, '>=', $start)->where($column, '<', $end)->count();
    }

    /**
     * مجموعِ یک ستونِ عددی (یا یک عبارتِ raw) برای رکوردهایی که تاریخِ
     * ستونِ مشخص‌شده‌شون در بازه‌ی [start, end) قرار می‌گیره.
     */
    public static function sumInRange(\Closure $queryFactory, string $column, string $sumExpression, Carbon $start, Carbon $end): float {
        return (float)$queryFactory()->where($column, '>=', $start)->where($column, '<', $end)->sum($sumExpression);
    }
}
