<?php


namespace App\Services\Permission\Traits;


use App\Models\Permission;

trait HasPermissions {

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }


    public function givePermissionsTo(...$permissions) {

        $permissions = $this->getAllPermissions($permissions);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->syncWithoutDetaching($permissions);
        return $this;
    }

    private function getAllPermissions(array $permissions) {

        return Permission::query()->whereIn('title', collect($permissions)->flatten())->get();

    }

    public function withdrawPermission(...$permissions) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(...$permissions) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);
        return $this;
    }

    public function hasPermission(Permission $permission) {
        //Log::info($permission);
        return $this->hasPermissionThroughRole($permission) || $this->permissions->contains($permission);

    }

    public function hasPermissionAsTitle(string $permissionTitle) {
        $permission = Permission::query()->where('title', $permissionTitle)->first();
        if (!is_null($permission)) {

            return $this->hasPermission($permission);
        }

    }


    private function hasPermissionThroughRole(Permission $permission) {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) return true;
        }
        return false;
    }
}
