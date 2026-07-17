<?php

namespace App\Services\Invoice;

use App\Models\Transport;
use Hekmatinasser\Verta\Facades\Verta;

class TransportStore {

    public static function store($single,$request) {
        $transport = Transport::query()->where('preinvoice_id', '=', $single->id)->firstOrNew();
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
        $transport->save();
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
