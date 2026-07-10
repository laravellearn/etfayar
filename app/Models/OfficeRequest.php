<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeRequest extends Model {
    use PersianDate;
    use SoftDeletes;

    public function officeForm() {
        return $this->belongsTo(OfficeForm::class, 'office_form_id');
    }

    public function applicant() {
        return $this->belongsTo(Admin::class, 'applicant_id');
    }

   public function recipient() {
        return $this->belongsTo(Admin::class, 'recipient_id');
    }


    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 'not_seen') {
            $status->title = __("office_request.not_seen");
            $status->class = 'label label-md font-weight-bold label-secondary label-inline';
        } else if ($this->status == 'pending') {
            $status->title = __("office_request.pending");
            $status->class = 'label label-md font-weight-bold label-warning label-inline';
        } else if ($this->status == 'agree') {
            $status->title = __("office_request.agree");
            $status->class = 'label label-md font-weight-bold label-success label-inline';
        } else if ($this->status == 'deny') {
            $status->title = __("office_request.deny");
            $status->class = 'label label-md font-weight-bold label-danger label-inline';
        }
        return $status;
    }


}
