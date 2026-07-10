<?php

namespace App\Services\Invoice;

use App\Models\PreinvoiceDescription;

class DescriptionStore {

    public static function store($descriptions, $preinvoice) {
        self::delete_old_descriptions($preinvoice);
        if (!empty($descriptions)) {
            foreach ($descriptions as $item) {
                $preinvoiceDescription = new PreinvoiceDescription();
                $preinvoiceDescription->preinvoice_id = $preinvoice->id;
                $preinvoiceDescription->description_id = $item['description_id'];
                $preinvoiceDescription->save();
            }
        }
    }

    public static function delete_old_descriptions($preinvoice) {
        $preinvoice->descriptions()->delete();
    }

}
