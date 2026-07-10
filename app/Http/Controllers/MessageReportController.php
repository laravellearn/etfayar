<?php

namespace App\Http\Controllers;

use App\Models\MessageReport;
use Illuminate\Http\Request;

class MessageReportController extends Controller {

    public function index() {
        $list = MessageReport::query()->orderByDesc('created_at')->get();
        $title = __('message_report.list');
        return view('message_report.list', compact('list', 'title'));
    }

    public function my_message_reports() {
        $admin_id = auth('admin')->id();
        $list = MessageReport::query()->where('admin_id', $admin_id)->orderByDesc('created_at')->get();
        $title = __('message_report.my_list');
        return view('message_report.list', compact('list', 'title'));
    }


    public function destroy($id) {
        $single = MessageReport::query()->find($id);
        $single->delete();
        return redirect()->back();
    }


}
