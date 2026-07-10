<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

class UserSupport extends Model {
    use PersianDate;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function getPersianSupportTimeAttribute() {
        $v = new Verta($this->support_time);
        return $v->format('%d %B %Y');
    }


    public function getPersianDoneTimeAttribute() {
        if (!is_null($this->done_time)) {
            $v = new Verta($this->done_time);
            return $v->format('%d %B %Y');
        }else{
            return null;
        }
    }


    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 0) {
            $status->title = 'پشتیبانی انجام نشده است';
            $status->class = 'label label-lg font-weight-bold label-light-warning label-inline';
        } else if ($this->status == 1) {
            $status->title = 'پشتیبانی موفق';
            $status->class = 'label label-lg font-weight-bold label-light-success label-inline';
        } else if ($this->status == 2) {
            $status->title = 'پشتیبانی ناموفق';
            $status->class = 'label label-lg font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }


}
