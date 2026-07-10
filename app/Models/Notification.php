<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nette\Utils\Json;

class Notification extends Model {
    use SoftDeletes;
    use PersianDate;


    public function getRolesIdsAttribute() {
        if (!is_null($this->roles)) {
            return Json::decode($this->roles);
        } else {
            return array();
        }
    }


    public function sender() {
        return $this->belongsTo(Admin::class, 'sender_id');
    }

    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 1) {
            $status->title = __("common.active");
            $status->class = 'label label-lg font-weight-bold label-light-success label-inline';
        } else if ($this->status == 0) {
            $status->title = __("common.inactive");
            $status->class = 'label label-lg font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }

}
