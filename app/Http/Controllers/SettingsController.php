<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller {

    public function index() {
        //
    }

    public function charge_card() {
        $title = __('charge_card.settings');
        $list = Setting::query()->where('type', 'charge_card')->get();
        return view('charge_card.settings', compact('title', 'list'));
    }

    public function store_charge_card(Request $request) {
        //dd($request->all());
        $settings = $request->settings;
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
        return redirect()->route('charge_card.settings');
    }

    public function show(Setting $setting) {
        //
    }

    public function edit(Setting $setting) {
        //
    }

    public function update(Request $request, Setting $setting) {
        //
    }

    public function destroy(Setting $setting) {
        //
    }
}
