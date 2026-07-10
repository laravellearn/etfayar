<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model {
    use SoftDeletes;
    use PersianDate;

    public function items() {
        return $this->hasMany(InsuranceItem::class)->orderBy('number');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function information() {
        return $this->belongsTo(Information::class);
    }

    public function getPersianChargeTimeAttribute() {
        return $this->toJalaliDateTime($this->charge_time);
    }

    public function getPersianRechargeTimeAttribute() {
        return $this->toJalaliDateTime($this->recharge_time);
    }


}
