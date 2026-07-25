<?php


namespace App\Services\Permission\Traits;


use App\Models\Role;

trait HasRole {

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function giveRolesTo(...$roles) {

        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty()) return $this;

        $this->roles()->syncWithoutDetaching($roles);
        return $this;


    }

    private function getAllRoles(array $roles) {
        return Role::query()->whereIn('title', collect($roles)->flatten())->get();
    }

    public function withdrawRoles(...$roles) {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);
        return $this;
    }

    public function refreshRole(...$roles) {
        $roles = $this->getAllRoles($roles);
        $this->roles()->sync($roles);
        return $this;
    }

    public function hasRole(string $role) {
        return $this->roles->contains('title', $role);
    }

    public function hasAnyRole(array $roles) {
        return $this->roles->pluck('title')->intersect($roles)->isNotEmpty();
    }

}
