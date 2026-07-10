<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model {
    use SoftDeletes;


    public function scopeGetValue($query, $key) {
        $setting = $query->where('key', 'LIKE', $key)->firstOrFail();
        return $setting->value;
    }

    public function scopeSetValue($query, $key, $value) {
        $setting = $query->where('key', 'LIKE', $key)->firstOrCreate();
        $setting->key = $key;
        $setting->value = $value;
        $setting->save();
    }

}
