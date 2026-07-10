<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, HasRole, SoftDeletes;

    protected $guard = 'admin';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* public function permissions()
     {
         return $this->belongsToMany(Permission::class, 'user_permission');
     }*/

    public function getFullNameAttribute() {
        return "{$this->name} {$this->family}";
    }

    public function getStatusValueAttribute() {
        $status = new \stdClass();
        if ($this->status == 1) {
            $status->title = __("common.active");
            $status->class = 'label label-lg font-weight-bold label-light-success label-inline';
        } else if ($this->status == 0) {
            $status->title = __("common.inactive");
            $status->class = 'label label-lg font-weight-bold label-light-danger label-inline';
        }
        return $status;
    }

}
