<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model {
    use HasFactory;

    protected $table = 'user_address';


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function getToStringAddressAttribute() {
        $address = ' استان: ' . $this->city->province->name . ' ،شهر: ' . $this->city->name . ' ،منطقه: ' . $this->area . ' ، ' . $this->address . ' ،کدپستی: ' . $this->postal_code;
        return $address;
    }


}
