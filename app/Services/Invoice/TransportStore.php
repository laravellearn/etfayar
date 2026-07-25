<?php

namespace App\Services\Invoice;

use App\Models\Transport;
use App\Services\Notification\SystemNotifier;
use Hekmatinasser\Verta\Facades\Verta;

class TransportStore {

    public static function store($single,$request) {
        $transport = Transport::query()->where('preinvoice_id', '=', $single->id)->firstOrNew();
        $isNew = !$transport->exists;
        $transport->admin_id = auth('admin')->id();
        $transport->preinvoice_id = $single->id;
        $transport->visit_time_from_1 = $request->visit_time_from_1;
        $transport->visit_time_to_1 = $request->visit_time_to_1;
        $transport->visit_time_from_2 = $request->visit_time_from_2;
        $transport->visit_time_to_2 = $request->visit_time_to_2;
        $transport->visit_date =  self::convert_jalali_to_gergorian($request->visit_date);
        $transport->delivery_duration = $request->delivery_duration;
        $transport->description = $request->additional_description;
        $transport->is_fiduciary = $request->is_fiduciary;
        // وضعیت اولیه فقط برای رکورد تازه‌ساخته‌شده تنظیم می‌شه؛ اگه این ترابری از
        // قبل وجود داشته و در حال پیگیریه (مثلاً جمع‌آوری یا تحویل)، ویرایش اطلاعات
        // بازدید نباید وضعیتش رو به «در انتظار» برگردونه.
        if ($isNew) {
            $transport->status = 'waiting';
        }
        $transport->save();

        if ($isNew) {
            $customerName = $single->request->user->full_name ?? '';
            SystemNotifier::toRoles(
                ['Transportation Supervisor'],
                'ارسال یک مورد ترابری جدید',
                "یک مورد ترابری جدید برای مشتری {$customerName} ارسال شد.",
                route('transports')
            );
        }
    }

    private static function convert_jalali_to_gergorian($visit_date) {
        if (!is_null($visit_date)) {
            $v = Verta::parse($visit_date);
            return $v->formatGregorian('Y-m-d');
        } else {
            $v = Verta::now();
            return $v->formatGregorian('Y-m-d');
        }
    }

}
