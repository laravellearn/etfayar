<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        DB::listen(function ($query) {
            //dd($query);
            // $query->bindings;
            // $query->time;
        });
       // echo "a";
        //Config::set('user_exist', User::find(1));
        //dd(Setting::getValue('melipayamak_username'));
        //config('melipayamak.username', Setting::getValue('melipayamak_username'));
        //Config::set(['melipayamak.password', Setting::getValue('melipayamak_password')]);


    }
}
