<?php

namespace App\Http\Controllers;

use App\Models\MessageReport;
use App\Models\Setting;
use App\Models\User;
use App\Services\Notification\SmsSender;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class MessageController extends Controller {


    public function create() {
        $title = __('message_report.add');
        $users = User::all();
        //dd(config('melipayamak.username'));
        //dd(config('melipayamak_username'));

        return view('message.add', compact('title', 'users'));
    }

    public function store(Request $request) {
        //dd($request->all());
        $user_ids = $request->user_ids;
        $text = $request->text;
        foreach ($user_ids as $user_id) {
            $user = User::query()->where('id', $user_id)->first();
            SmsSender::send($text, $user->mobile, 'custom_message', $user);
        }

        return redirect()->route('my_message_reports');

    }


    public function settings() {
        $title = __('message.settings');
        $list = Setting::query()->where('type', 'sms')->get();
        return view('message.settings', compact('title', 'list'));
    }

    public function store_settings(Request $request) {
        //dd($request->all());
        $settings = $request->setting;
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
        return redirect()->route('message.settings');

    }

}
