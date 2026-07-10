<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller {

    public function index() {
        $list = Notification::all();
        $title = __('notification.lists');
        return view('notification.list', compact('list','title'));
    }


    public function create() {
        $title = __('notification.add_notification');
        return view('notification.add',compact('title'));
    }

    public function store(Request $request) {
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->status = $request->status;
        $notification->save();
        return redirect()->route('notifications');
    }

    public function edit($id) {
        $notification = Notification::query()->where('id', $id)->firstOrFail();
        $title = __('notification.edit');
        return view('notification.edit', compact('notification','title'));
    }


    public function update(Request $request) {
        $notification = Notification::query()->where('id', $request->id)->firstOrFail();
        $notification->title = $request->title;
        $notification->status = $request->status;
        $notification->save();
        return redirect()->route('notifications');
    }

    public function destroy($id) {
        $notification = Notification::query()->where('id', $id)->firstOrFail();
        $notification->delete();
        return back()->with('status', 'حذف اطلاعیه با موفقیت انجام شد');
    }
}
