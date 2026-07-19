<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model {
    use HasFactory;
    use SoftDeletes;
    use PersianDate;

    protected $fillable = [
        'preinvoice_id',
        'is_deposit'
    ];

    public function preinvoice() {
        return $this->belongsTo(Preinvoice::class);
    }

    public function collect_driver() {
        return $this->belongsTo(Admin::class, 'collect_driver_id');
    }

    public function delivery_driver() {
        return $this->belongsTo(Admin::class, 'delivery_driver_id');
    }

    public function getTransportStatusValueAttribute() {
        $status_states = ['waiting', 'collect', 'delivery', 'cancel', 'done'];
        $collect_status_states = ['waiting_for_set_collector', 'pending_collect', 'collected', 'cancel'];
        $delivery_status_states = ['waiting_for_set_deliverer', 'pending_delivery', 'delivered', 'cancel'];
        $status = new \stdClass();
        if ($this->status == $status_states[0]) {
            $status->title = __("transport.not_set");
            $status->class = 'label label-lg font-weight-bold label-light-warning label-inline';
        } else if ($this->status == $status_states[1]) {
            if ($this->collect_status == $collect_status_states[0]) {
                $status->title = __("transport.waiting_for_set_collector");
                $status->class = 'label label-lg font-weight-bold label-light-secondary label-inline';
            } else if ($this->collect_status == $collect_status_states[1]) {
                $status->title = __("transport.pending_collect");
                $status->class = 'label label-lg font-weight-bold label-light-warning label-inline';
            } else if ($this->collect_status == $collect_status_states[2]) {
                $status->title = __("transport.collected");
                $status->class = 'label label-lg font-weight-bold label-light-success label-inline';
            } else if ($this->collect_status == $collect_status_states[3]) {
                $status->title = __("transport.cancel");
                $status->class = 'label label-lg font-weight-bold label-light-danger label-inline';
            }
        } else if ($this->status == $status_states[2]) {
            if ($this->delivery_status == $delivery_status_states[0]) {
                $status->title = __("transport.waiting_for_set_deliverer");
                $status->class = 'label label-lg font-weight-bold label-info label-inline';
            } else if ($this->delivery_status == $delivery_status_states[1]) {
                $status->title = __("transport.pending_delivery");
                $status->class = 'label label-lg font-weight-bold label-warning label-inline';
            } else if ($this->delivery_status == $delivery_status_states[2]) {
                $status->title = __("transport.delivered");
                $status->class = 'label label-lg font-weight-bold label-success label-inline';
            } else if ($this->delivery_status == $delivery_status_states[3]) {
                $status->title = __("transport.cancel");
                $status->class = 'label label-lg font-weight-bold label-danger label-inline';
            }
        } else if ($this->status == $status_states[3]) {
            $status->title = __("transport.cancel");
            $status->class = 'label label-lg font-weight-bold label-danger label-inline';
        } else if ($this->status == $status_states[4]) {
            $status->title = __("transport.done");
            $status->class = 'label label-lg font-weight-bold label-dark label-inline';
        } else {
            $status->title = __("transport.unknown");
            $status->class = 'label label-md font-weight-bold label-dark-secondary label-inline';
        }
        return $status;
    }

    public function getTransportCollectStatusValueAttribute() {
        $collect_status_states = ['waiting_for_set_collector', 'pending_collect', 'collected', 'cancel'];
        $status = new \stdClass();
        if ($this->collect_status == $collect_status_states[0]) {
            $status->title = __("transport.waiting_for_set_collector");
            $status->class = 'label label-lg font-weight-bold label-secondary label-inline';
        } else if ($this->collect_status == $collect_status_states[1]) {
            $status->title = __("transport.pending_collect");
            $status->class = 'label label-lg font-weight-bold label-warning label-inline';
        } else if ($this->collect_status == $collect_status_states[2]) {
            $status->title = __("transport.collected");
            $status->class = 'label label-lg font-weight-bold label-success label-inline';
        } else if ($this->collect_status == $collect_status_states[3]) {
            $status->title = __("transport.cancel");
            $status->class = 'label label-lg font-weight-bold label-danger label-inline';
        } else {
            $status->title = __("transport.unknown");
            $status->class = 'label label-md font-weight-bold label-dark-secondary label-inline';
        }
        return $status;
    }

    public function getTransportDeliveryStatusValueAttribute() {
        $delivery_status_states = ['waiting_for_set_deliverer', 'pending_delivery', 'delivered', 'cancel'];
        $status = new \stdClass();
        if ($this->delivery_status == $delivery_status_states[0]) {
            $status->title = __("transport.waiting_for_set_deliverer");
            $status->class = 'label label-lg font-weight-bold label-info label-inline';
        } else if ($this->delivery_status == $delivery_status_states[1]) {
            $status->title = __("transport.pending_delivery");
            $status->class = 'label label-lg font-weight-bold label-warning label-inline';
        } else if ($this->delivery_status == $delivery_status_states[2]) {
            $status->title = __("transport.delivered");
            $status->class = 'label label-lg font-weight-bold label-success label-inline';
        } else if ($this->delivery_status == $delivery_status_states[3]) {
            $status->title = __("transport.cancel");
            $status->class = 'label label-lg font-weight-bold label-danger label-inline';
        } else {
            $status->title = __("transport.unknown");
            $status->class = 'label label-md font-weight-bold label-dark-secondary label-inline';
        }
        return $status;
    }


    public function getTransportChargeReceiptStatusValueAttribute() {
        $status = [];
        if (is_null($this->charge_receipt_file)) {
            $status['title'] = __("transport.not_upload");
            $status['class'] = 'label label-lg font-weight-bold label-light-danger label-inline';
        } else {
            $status['title'] = __("transport.uploaded");
            $status['class'] = 'label label-lg font-weight-bold label-light-success label-inline';
        }
        return $status;
    }


    public function getPersianVisitDateAttribute() {
        $v = new Verta($this->visit_date);
        return $v->format('Y/n/j');
    }

    public function getPersianCollectTimeAttribute() {
        if (is_null($this->collect_time)) {
            return null;
        }
        $v = new Verta($this->collect_time);
        return $v->format('Y/n/j H:i');
    }

    public function getPersianDeliveryTimeAttribute() {
        if (is_null($this->delivery_time)) {
            return null;
        }
        $v = new Verta($this->delivery_time);
        return $v->format('Y/n/j H:i');
    }

    /**
     * متن نمایشیِ دو بازه‌ی زمانیِ مراجعه، مثلا:
     * «از ساعت 09:00 تا ساعت 12:00 و از ساعت 14:00 تا ساعت 17:00»
     * برای رکوردهای قدیمی که فقط visit_time تکی داشتند، همان مقدار قبلی نمایش داده می‌شود.
     */
    public function getVisitTimeRangeTextAttribute() {
        $ranges = [];

        if (!is_null($this->visit_time_from_1) || !is_null($this->visit_time_to_1)) {
            $ranges[] = 'از ساعت ' . $this->shortTime($this->visit_time_from_1) . ' تا ساعت ' . $this->shortTime($this->visit_time_to_1);
        }

        if (!is_null($this->visit_time_from_2) || !is_null($this->visit_time_to_2)) {
            $ranges[] = 'از ساعت ' . $this->shortTime($this->visit_time_from_2) . ' تا ساعت ' . $this->shortTime($this->visit_time_to_2);
        }

        if (!empty($ranges)) {
            return implode(' و ', $ranges);
        }

        return $this->visit_time ?? '';
    }

    private function shortTime($time) {
        if (is_null($time)) {
            return '';
        }
        return substr($time, 0, 5);
    }


}
