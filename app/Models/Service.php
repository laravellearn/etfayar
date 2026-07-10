<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {
    use HasFactory;
    use SoftDeletes;


    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 1) {
            $status->title = 'فعال';
            $status->class = 'label label-md font-weight-bold label-light-success label-inline';
        } else {
            $status->title = 'غیر فعال';
            $status->class = 'label label-md font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }

}
