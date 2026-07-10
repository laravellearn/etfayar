<?php

namespace App\Services\Invoice;

use App\Models\Workshop;

class WorkshopStore {

    public static function store($workshop_id, $preinvoice_id) {
        $single = Workshop::query()->where('id', $workshop_id)->firstOrNew();
        $single->preinvoice_id = $preinvoice_id;
        $single->status = 1;
        $single->save();
        return $single;
    }

}
