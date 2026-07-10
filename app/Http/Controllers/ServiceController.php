<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\Notification\SmsSender;
use Illuminate\Http\Request;

class ServiceController extends Controller {

    public function index() {
        $list = Service::all();
        $title = __('title.services');
        return view('service.list', compact('list','title'));
    }


    public function create() {
        $title = __('title.add_service');
        return view('service.add',compact('title'));
    }

    public function store(Request $request) {
        $service = new Service();
        $service->title = $request->title;
        $service->status = $request->status;
        $service->save();
        return redirect()->route('services');
    }

    public function edit($id) {
        $service = Service::query()->where('id', $id)->firstOrFail();
        $title = __('title.edit_service');
        return view('service.edit', compact('service','title'));
    }


    public function update(Request $request) {
        $service = Service::query()->where('id', $request->id)->firstOrFail();
        $service->title = $request->title;
        $service->status = $request->status;
        $service->save();
        return redirect()->route('services');
    }

    public function destroy($id) {
        $service = Service::query()->where('id', $id)->firstOrFail();
        $service->delete();
        return back()->with('status', 'حذف سرویس با موفقیت انجام شد');
    }

}
