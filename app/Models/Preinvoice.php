<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preinvoice extends Model {
    use HasFactory;
    use SoftDeletes;
    use PersianDate;


    public function request() {
    return $this->belongsTo(UserRequest::class, 'request_id');
    }

    public function items() {
        return $this->hasMany(PreinvoiceItem::class);
    }


    public function transport() {
        return $this->hasOne(Transport::class);
    }


    public function workshop() {
        return $this->hasOne(Workshop::class);
    }

    public function descriptions() {
        return $this->hasMany(PreinvoiceDescription::class);
    }

    public function information() {
        return $this->belongsTo(Information::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function getPersianConfirmedAtAttribute() {
        if (is_null($this->confirmed_at)) {
            return null;
        }
        $v = new \Hekmatinasser\Verta\Verta($this->confirmed_at);
        return $v->format('%d %B %Y');
    }

    public function getGeneralStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 'pending') {
            $status->title = __("preinvoice.pending");
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-danger label-inline';
        } else if ($this->status == 'transport') {
            $status->title = __("preinvoice.transport");
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-warning label-inline';
        } else if ($this->status == 'financial') {
            $status->title = __("preinvoice.financial");
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-success label-inline';
        } else {
            $status->title = __("preinvoice.unknown");
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-dark-secondary label-inline';
        }
        return $status;
    }

    public function getTransportStatusValueAttribute() {

        $transportStatus = [];
        if (isset($this->transport)) {
            if ($this->transport->collect_time != null) {
                $status = new \stdClass();
                $status->title = 'جمع آوری انجام شده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-success label-inline';
                $transportStatus[] = $status;
            } else {
                $status = new \stdClass();
                $status->title = 'جمع آوری نشده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-danger label-inline';
                $transportStatus[] = $status;
            }

            if ($this->transport->charge_receipt_file != null) {
                $status = new \stdClass();
                $status->title = 'رسید شارژ بارگذاری شده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-success label-inline';
                $transportStatus[] = $status;
            } else {
                $status = new \stdClass();
                $status->title = 'رسید شارژ بارگذاری نشده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-danger label-inline';
                $transportStatus[] = $status;
            }


            if ($this->transport->delivery_time != null) {
                $status = new \stdClass();
                $status->title = 'تحویل انجام شده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-success label-inline';
                $transportStatus[] = $status;
            } else {
                $status = new \stdClass();
                $status->title = 'تحویل انجام نشده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-danger label-inline';
                $transportStatus[] = $status;
            }

            if ($this->transport->cancel_time != null) {
                $status = new \stdClass();
                $status->title = 'کنسل شده است';
                $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-danger label-inline';
                $transportStatus[] = $status;
            }
        } else {
            $status = new \stdClass();
            $status->title = 'به واحد ترابری ارسال نشده است';
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-warning label-inline';
            $transportStatus[] = $status;
        }
        return $transportStatus;
    }

    public function getFinancialStatusValueAttribute() {
        $status = new \stdClass();
        $status->title = __("preinvoice.pending");
        $status->class = 'label label-md font-weight-bold label-danger label-inline';
        return $status;
    }

    public function getWorkshopStatusValueAttribute() {
        $workshopStatus = [];

        if (!isset($this->workshop)) {
            $status = new \stdClass();
            $status->title = 'ثبت کارگاه نشده است';
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-warning label-inline';
            $workshopStatus[] = $status;
        }


        if (isset($this->workshop) && $this->workshop->status == 1 && !$this->workshop->has_no_fire_extinguisher_part && isset($this->workshop->items) && count($this->workshop->items) > 0) {
            $status = new \stdClass();
            $status->title = 'ثبت داغی شده است';
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-success label-inline';
            $workshopStatus[] = $status;
        }

        if (isset($this->workshop) && $this->workshop->status == 1 && $this->workshop->has_no_fire_extinguisher_part) {
            $status = new \stdClass();
            $status->title = 'شارژ شد و داغی ندارد';
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-light-warning label-inline';
            $workshopStatus[] = $status;
        }

        if (isset($this->workshop) && $this->workshop->status == 0) {
            $status = new \stdClass();
            $status->title = 'منتظر تعیین وضعیت در کارگاه';
            $status->class = 'text-nowrap mb-2 label label-md font-weight-bold label-secondary label-inline';
            $workshopStatus[] = $status;
        }


        return $workshopStatus;
    }


}
