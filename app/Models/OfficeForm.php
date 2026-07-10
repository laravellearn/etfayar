<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Json;

class OfficeForm extends Model {

    public function items() {
        return $this->hasMany(FormItem::class)->where('status','=',1)->orderBy('position');
    }

    public function getRolesIdsAttribute() {
        if (!is_null($this->roles)) {
            return Json::decode($this->roles);
        } else {
            return array();
        }
    }



}
