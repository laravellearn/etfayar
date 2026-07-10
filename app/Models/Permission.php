<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Permission extends Model {
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 1) {
            $status->title = 'فعال';
            $status->class = 'label label-md font-weight-bold label-light-success label-inline';
        } else {
            $status->title = 'غیر فعال';
            $status->class = 'label label-md font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }

    public static function permissions() {
        $permissions = Permission::where('parent_title', '=', null)->get();
        foreach ($permissions as $permission) {
            $permission['childs'] = Permission::query()->where('parent_title', $permission->title)->get();
        }
        return $permissions;
    }


}
