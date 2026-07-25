<?php

namespace App\Services\Invoice;

use App\Models\Workshop;
use App\Services\Notification\SystemNotifier;

class WorkshopStore {

    public static function store($workshop_id, $preinvoice_id) {
        $single = Workshop::query()->where('id', $workshop_id)->firstOrNew();
        $isNew = !$single->exists;
        $single->preinvoice_id = $preinvoice_id;
        $single->status = 1;
        $single->save();

        if ($isNew) {
            $customerName = $single->preinvoice->request->user->full_name ?? '';
            SystemNotifier::toRoles(
                ['Site Manager'],
                'ارسال یک مورد داغی جدید',
                "یک مورد جدید برای ثبت داغی مربوط به مشتری {$customerName} ارسال شد.",
                route('workshop.doneTasks')
            );
        }

        return $single;
    }

}
