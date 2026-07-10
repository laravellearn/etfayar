<?php

namespace App\Services\Calendar;

use Hekmatinasser\Verta\Verta;

trait PersianDate {

    public function getPersianDateTimeAttribute() {
        $v = new Verta($this->created_at);
        return $v->format('%d %B %Y H:i:s');
    }

    public function getPersianDateAttribute() {
        $v = new Verta($this->created_at);
        return $v->format('%d %B %Y');
    }

    public function getPersianMonthAttribute() {
        $v = new Verta($this->created_at);
        return $v->formatWord('F');
    }

    public function toJalaliDateTime($date_time) {
        $v = new Verta($date_time);
        return $v->format('%Y/%m/%d');
    }


}
