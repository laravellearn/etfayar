<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopItem extends Model {
    use HasFactory;

    protected $table = 'workshop_items';
    public $timestamps = false;
    protected $appends = ['persian_sent_date'];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function fireExtinguisherPart() {
        return $this->belongsTo(FireExtinguisherPart::class);
    }

    // تاریخ شمسیِ روزی که این قطعه‌ی داغی اضافه/ارسال شده.
    public function getPersianSentDateAttribute() {
        if (is_null($this->sent_date)) {
            return '';
        }
        $v = new \Hekmatinasser\Verta\Verta($this->sent_date);
        return $v->format('%d %B %Y');
    }

}
