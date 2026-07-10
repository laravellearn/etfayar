<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Notification;
use App\Models\Role;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class NotificationController extends Controller {

    public function index() {
        $list = Notification::orderByDesc('created_at')->get();
        $title = __('notification.list');
        return view('notification.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('notification.add');
        $roles = Role::all();
        return view('notification.add', compact('title', 'roles'));
    }

    public function store(Request $request) {
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->body = $request->body;
        $notification->sender_id = auth('admin')->id();
        $notification->status = $request->status;
        $roles = Json::encode($request->roles);
        if ($roles == 'null') {
            $notification->roles = null;
            $notification->save();
        } else {
            $notification->roles = Json::encode($request->roles);
            $notification->save();
        }
        return redirect()->route('notifications');
    }

    public function edit($id) {
        $single = Notification::query()->where('id', $id)->firstOrFail();
        $roles = Role::all();
        $title = __('notification.edit');
        return view('notification.edit', compact('single', 'title', 'roles'));
    }

    public function show($id) {
        $single = Notification::query()->where('id', $id)->firstOrFail();
        $roles = Role::all();
        $title = $single->title;

        $adminNotification= AdminNotification::query()
            ->where('admin_id',auth('admin')->id())
            ->where('notification_id',$single->id)
            ->firstOrCreate();
        $adminNotification->admin_id=auth('admin')->id();
        $adminNotification->notification_id=$single->id;
        $adminNotification->save();

        return view('notification.show', compact('single', 'title', 'roles'));
    }

    public function update(Request $request) {
        $notification = Notification::query()->where('id', $request->id)->firstOrFail();
        $notification->title = $request->title;
        $notification->status = $request->status;
        $notification->body = $request->body;
        $roles = Json::encode($request->roles);
        if ($roles == 'null') {
            $notification->roles = null;
            $notification->save();
        } else {
            $notification->roles = Json::encode($request->roles);
            $notification->save();
        }
        return redirect()->route('notifications');
    }

    public function destroy($id) {
        $notification = Notification::query()->where('id', $id)->firstOrFail();
        $notification->delete();
        return back()->with('status', 'حذف اطلاعیه با موفقیت انجام شد');
    }

    public function received() {
        $roles = auth('admin')->user()->roles->toArray();
        $collect_roles = collect($roles);
        $roles_id = $collect_roles->pluck('id');
        $str_roles_id = $roles_id->map(function ($item, $key) {
            return $item . '';
        })->toArray();

        //dump($str_roles_id);

        $list = array();
        foreach ($str_roles_id as $item) {
            $notifs = Notification::query()->whereJsonContains('roles', $item)->where('status', 1)->orderByDesc('created_at')->get();
            if (!is_null($notifs)) {
                foreach ($notifs as $notif) {
                    if (!in_array($notif, $list)) {
                        $list[] = $notif;
                    }
                }
            }

        }

        //dd($notifications);
        $title = __('notification.received');
        return view('notification.list_received', compact('list', 'title'));
    }

}
