<?php

namespace App\Http\Controllers;

use App\Models\IP;
use App\Models\Setting;
use Illuminate\Http\Request;

class IPsController extends Controller {

    public function index() {
        $list = IP::all();
        $title = __('ip.list');
        return view('ip.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('ip.add');
        return view('ip.add', compact('title'));
    }

    public function store(Request $request) {
        $single = new IP();
        $single->address = $request->address;
        $single->description = $request->description;
        $single->status = $request->status;
        $single->save();
        return redirect()->route('ips')->with('status', 'با موفقیت ثبت شد');

    }

    public function show(IP $IP) {
        //
    }

    public function edit($id) {
        $single = IP::query()->find($id);
        $title = __('ip.add');
        return view('ip.edit', compact('title', 'single'));
    }

    public function update(Request $request) {
        $single = IP::query()->find($request->id);
        $single->address = $request->address;
        $single->description = $request->description;
        $single->status = $request->status;
        $single->save();
        return redirect()->route('ips')->with('status', 'با موفقیت ویرایش شد');
    }

    public function destroy($id) {
        $single = IP::query()->find($id);
        $single->delete();
        return redirect()->route('ips');
    }

    public function invalid() {
        return view('ip.invalid');
    }

    public function settings() {
        $title = __('ip.settings');
        $value = Setting::getValue('is_active_ip_protection');
        return view('ip.settings', compact('title', 'value'));
    }

    public function store_settings(Request $request) {
        if (isset($request->is_active_ip_protection) && $request->is_active_ip_protection == 'on') {
            Setting::setValue('is_active_ip_protection', 'true');
        } else {
            Setting::setValue('is_active_ip_protection', 'false');
        }
        return redirect()->route('ip.settings')->with('status', 'با موفقیت ثبت شد');

    }

}
