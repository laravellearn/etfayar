<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
    use HasFactory;
    use HasPermissions;
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'code',
        'title',
        'persian_title',
    ];


/*    public function users() {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }*/

    public function admins() {
        return $this->belongsToMany(Admin::class, 'admin_role', 'role_id', 'admin_id');
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

}
