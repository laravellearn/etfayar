<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model {
    use HasFactory;
    use SoftDeletes;
    use PersianDate;

    public function preinvoice() {
        return $this->belongsTo(Preinvoice::class);
    }

    public function items() {
        return $this->hasMany(WorkshopItem::class)->orderBy('id');
    }


}
