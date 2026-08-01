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
        $adminId = auth('admin')->id();

        $roles    = auth('admin')->user()->roles;
        $strRoles = $roles->pluck('id')->map(fn($id) => (string)$id)->toArray();

        // باگ ۷ و ۸: جلوگیری از نوتیفیکیشن تکراری با استفاده از collection و unique
        $seenIds = collect();
        $all     = collect();

        // نوتیف‌های مبتنی بر نقش
        foreach ($strRoles as $roleId) {
            Notification::whereJsonContains('roles', $roleId)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->get()
                ->each(function ($n) use (&$seenIds, &$all) {
                    if (!$seenIds->contains($n->id)) {
                        $seenIds->push($n->id);
                        $all->push($n);
                    }
                });
        }

        // نوتیف‌های مستقیم به این ادمین
        Notification::where('admin_id', $adminId)
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->get()
            ->each(function ($n) use (&$seenIds, &$all) {
                if (!$seenIds->contains($n->id)) {
                    $seenIds->push($n->id);
                    $all->push($n);
                }
            });

        // مرتب‌سازی نهایی بر اساس تاریخ
        $all = $all->sortByDesc('created_at');

        // باگ ۹: جداسازی خوانده‌شده و نخوانده
        $readIds = AdminNotification::where('admin_id', $adminId)
            ->pluck('notification_id')
            ->toArray();

        $unreadList = $all->filter(fn($n) => !in_array($n->id, $readIds))->values();
        $readList   = $all->filter(fn($n) =>  in_array($n->id, $readIds))->values();

        $title = __('notification.received');
        return view('notification.list_received', compact('unreadList', 'readList', 'title'));
    }

    /**
     * علامت‌گذاری یک نوتیفیکیشن به‌عنوان خوانده‌شده برای ادمین جاری، و انتقال
     * به لینک مرتبط با همون نوتیفیکیشن (مثلاً همون فاکتور/ترابری/داغی).
     * اگه لینکی ثبت نشده باشه، به صفحه‌ی جزئیات خود نوتیفیکیشن می‌ره.
     */
    public function open($id) {
        $single = Notification::query()->where('id', $id)->firstOrFail();

        $adminNotification = AdminNotification::query()
            ->where('admin_id', auth('admin')->id())
            ->where('notification_id', $single->id)
            ->firstOrCreate();
        $adminNotification->admin_id = auth('admin')->id();
        $adminNotification->notification_id = $single->id;
        $adminNotification->save();

        if (!empty($single->url)) {
            return redirect($single->url);
        }

        return redirect()->route('notification.show', $single->id);
    }

}
