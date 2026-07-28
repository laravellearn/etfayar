<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model {
    use HasFactory;
    use SoftDeletes;
    use PersianDate;


    public function preinvoice() {
        return $this->belongsTo(Preinvoice::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }


    public function getPersianPaymentDateAttribute() {
        if (is_null($this->payment_date)) {
            return null;
        }
        $v = new \Hekmatinasser\Verta\Verta($this->payment_date);
        return $v->format('%d %B %Y');
    }

    public function getApprovalStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 1) {
            $status->title = 'تایید شده';
            $status->class = 'label label-lg font-weight-bold label-light-success label-inline';
        } else if ($this->status == 2) {
            $status->title = 'رد شده';
            $status->class = 'label label-lg font-weight-bold label-light-danger label-inline';
        } else {
            $status->title = 'در انتظار تایید مالی';
            $status->class = 'label label-lg font-weight-bold label-light-warning label-inline';
        }
        return $status;
    }

    public function getDepositAttribute() {
        $status = new \stdClass();
        if ($this->is_deposit == true) {
            $status->title = 'بله';
            $status->class = 'label label-md font-weight-bold label-success label-inline';
        } else if ($this->is_deposit == false) {
            $status->title = 'خیر';
            $status->class = 'label label-md font-weight-bold label-danger label-inline';
        } else {
            $status->title = __("preinvoice.unknown");
            $status->class = 'label label-md font-weight-bold label-dark-secondary label-inline';
        }
        return $status;
    }


}
