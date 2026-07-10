<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\OfficeForm;
use App\Models\OfficeRequest;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider {
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
        View::composer(['layout.sidebar'], function ($view) {
            $menus = Menu::menus();
            $view->with('menus', $menus);
        });

        View::composer(['layout.navbar', 'layout.header_mobile'], function ($view) {

            $roles = auth('admin')->user()->roles->toArray();
            $collect_roles = collect($roles);
            $roles_id = $collect_roles->pluck('id');
            $str_roles_id = $roles_id->map(function ($item, $key) {
                return $item . '';
            })->toArray();

            //dump($str_roles_id);

            $forms = array();
            foreach ($str_roles_id as $item) {
                $officeForms = OfficeForm::query()->whereJsonContains('roles', $item)->get();
                if (!is_null($officeForms)) {
                    foreach ($officeForms as $officeForm) {
                        if (!in_array($officeForm, $forms)) {
                            $forms[] = $officeForm;
                        }
                    }
                }

            }

            $forms_ids = collect($forms)->flatten()->pluck('id')->toArray();
            $officeRequests = OfficeRequest::query()
                ->whereIn('office_form_id', $forms_ids)
                ->where('status', '=', 'not_seen')
                ->get();


            $notifications = array();
            foreach ($str_roles_id as $item) {
                $notifs = Notification::query()->whereJsonContains('roles', $item)->where('status', 1)->get();
                if (!is_null($notifs)) {
                    foreach ($notifs as $notif) {
                        $is_read_notification = AdminNotification::getRead($notif->id, auth('admin')->id());
                        if (!in_array($notif, $notifications) && is_null($is_read_notification)) {
                            $notifications[] = $notif;
                        }
                    }
                }

            }

            $date = Verta::now()->format('%d %B %Y');
            $view->with('requests', $officeRequests);
            $view->with('notifications', $notifications);
            $view->with('date', $date);
        });


    }
}
