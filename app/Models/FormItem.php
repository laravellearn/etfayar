<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormItem extends Model {

    protected $table = 'form_item';


    public function form() {
        return $this->belongsTo(OfficeForm::class);
    }

}
