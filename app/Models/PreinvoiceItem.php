<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreinvoiceItem extends Model {
    use HasFactory;

    protected $table = 'preinvoice_items';
    public $timestamps = false;
    protected $with=['product'];

    public function preinvoice() {
        return $this->belongsTo(Preinvoice::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getTotalPriceAttribute() {
        $totalPrice = ($this->count) * ($this->price);
        return $totalPrice;
    }


}
