<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreinvoiceDescription extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'preinvoice_description';

    public function description() {
        return $this->belongsTo(Description::class);
    }


}
