<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopItem extends Model {
    use HasFactory;

    protected $table = 'workshop_items';
    public $timestamps = false;

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function fireExtinguisherPart() {
        return $this->belongsTo(FireExtinguisherPart::class);
    }


}
