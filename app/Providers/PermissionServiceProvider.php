<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {


        try {
            Permission::all()->map(function ($permission) {
                Gate::define($permission->title, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });

            });
            Blade::if('role', function ($role) {
                return auth('admin')->check() && auth('admin')->user()->hasRole($role);
            });
            Blade::if('permission', function ($permission) {
                return auth('admin')->check() && auth('admin')->user()->can($permission);
            });
        } catch (\Exception $e) {

        }

    }
}
