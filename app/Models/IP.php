<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IP extends Model {

    protected $table = 'ips';

    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 'valid') {
            $status->title = 'مجاز';
            $status->class = 'label label-md font-weight-bold label-light-success label-inline';
        } else {
            $status->title = 'غیر مجاز';
            $status->class = 'label label-md font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }



}
