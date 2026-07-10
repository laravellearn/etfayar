<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, HasRole, SoftDeletes;

    protected $guard = 'web';

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


    public function getFullNameAttribute()
    {
        if ($this->identity_type == 'natural') {
            return "{$this->name} {$this->family}";
        } else {
            return "{$this->company}";
        }
    }

    public function mobiles()
    {
        return $this->hasMany(Mobile::class);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function requests()
    {
        return $this->hasMany(UserRequest::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeMyUser($query, $expert_id)
    {
        return $query->where('expert_id', $expert_id);
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
