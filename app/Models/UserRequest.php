<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequest extends Model {
    use HasFactory;
    use SoftDeletes;
    use PersianDate;

    protected $appends = ['date', 'persianDate', 'persianMonth'];

    public function service() {
        return $this->belongsTo(Service::class);
    }


public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


    public function admin() {
        return $this->belongsTo(Admin::class, 'expert_id', 'id');
    }

    public function preinvoice() {
        return $this->hasOne(Preinvoice::class, 'request_id');
    }


    public function getDateAttribute() {
        return $this->created_at->format('Y-m-d');
    }

    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 1) {
            $status->title = __("request.preinvoice");
            $status->class = 'label label-lg font-weight-bold label-light-success label-inline';
        } else if ($this->status == 0) {
            $status->title = __("request.pending");
            $status->class = 'label label-lg font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }


}
