<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model {
    use HasFactory;
    use SoftDeletes;

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }


    public function getTypeValueAttribute() {
        $status = new \stdClass();
        if ($this->type == 1) {
            $status->title = __("common.invoice");
            $status->class = 'label label-lg font-weight-bold label-danger label-inline';
        } else if ($this->type == 0) {
            $status->title = __("common.preinvoice");
            $status->class = 'label label-lg font-weight-bold label-success label-inline';
        }
        return $status;
    }

    public function getHeaderTypeValueAttribute() {
        $status = new \stdClass();
        if ($this->header_type == 1) {
            $status->title = __("information.official");
            $status->class = 'label label-lg font-weight-bold label-danger label-inline';
        } else if ($this->header_type == 0) {
            $status->title = __("information.unofficial");
            $status->class = 'label label-lg font-weight-bold label-success label-inline';
        }
        return $status;
    }


}
