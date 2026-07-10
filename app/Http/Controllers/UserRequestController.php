<?php

namespace App\Http\Controllers;

use App\Models\Preinvoice;
use App\Models\Service;
use App\Models\User;
use App\Models\UserRequest;
use App\Services\Notification\SmsSender;
use Illuminate\Http\Request;

class UserRequestController extends Controller {


    public function index() {
        $expert_id = auth('admin')->user()->id;
        $list = UserRequest::with('admin', 'user', 'service')
            ->where('expert_id', '=', $expert_id)
            ->orderByDesc('created_at')
            ->get();
        $title = __('title.requests');
        return view('request.list', compact('list', 'title'));
    }


    public function create(User $user) {
        $title = __('title.add_request');
        $services = Service::all();
        $users = User::all();
        return view('request.add', compact('title', 'services', 'users', 'user'));
    }

    public function store(Request $request) {

        $request->validate([
            'service_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            /*'code' => 'required|unique:user_requests,code',*/
            'status' => 'required',
        ]);

        $userRequest = new UserRequest();
        $userRequest->service_id = $request->service_id;
        $userRequest->user_id = $request->user_id;
        $userRequest->description = $request->description;
        $userRequest->expert_id = auth('admin')->user()->id;
        $userRequest->code = $this->generate_request_code($request->user_id);
        $userRequest->status = $request->status;
        $userRequest->save();
        SmsSender::request_registered($userRequest);
        if ($userRequest->status == 1) {
            $preinvoice = Preinvoice::query()->where('request_id', '=', $userRequest->id)->firstOrNew();
            $preinvoice->request_id = $userRequest->id;
            $preinvoice->code = $this->generate_preinvoice_code($userRequest->id);
            $preinvoice->save();
            return redirect()->route('preinvoice.edit', $preinvoice->id);
        } else {
            return redirect()->route('requests');
        }
        return redirect()->route('requests');
    }

    private function generate_request_code($user_id): string {
        $request = UserRequest::query()->with('user')->select(['id', 'user_id', 'code', 'created_at'])->where('user_id', '=', $user_id)->get();

        $max = collect($request->toArray())->max('code');
        $max = str_replace('D', '', $max);
        if ($max == "") {
            $user = User::query()->where('id', $user_id)->first();
            $code = 'D' . $user->customer_code . '-' . "1";
            return $code;
        } else {
            $parts = explode('-', $max);
            $code = 'D' . $parts[0] . '-' . ($parts[1] + 1);
            return $code;
        }
    }

    private function generate_preinvoice_code($request_id) {
        $request = UserRequest::where('id', '=', $request_id)->first();
        $code = str_replace(['D', '-'], ['', '/'], $request->code);
        return $code;
    }


    public function show($id) {
        $request = UserRequest::with('admin', 'user', 'service')->where('id', '=', $id)->firstOrFail();
        $title = __('title.show_request');
        $services = Service::all();
        $users = User::all();
        return view('request.show', compact('title', 'services', 'users', 'request'));
    }


    public function edit($id) {
        $request = UserRequest::with('admin', 'user', 'service')->where('id', '=', $id)->firstOrFail();
        $title = __('title.edit_request');
        $services = Service::all();
        $users = User::all();
        return view('request.edit', compact('title', 'services', 'users', 'request'));
    }


    public function update(Request $request) {

        $request->validate([
            'service_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            /*'code' => 'required|unique:user_requests,code,' . $request->id,*/
            'status' => 'required',
        ]);
        $userRequest = UserRequest::with('admin', 'user', 'service')->where('id', '=', $request->id)->firstOrFail();
        $userRequest->service_id = $request->service_id;
        $userRequest->user_id = $request->user_id;
        $userRequest->description = $request->description;
        //$userRequest->code = $this->generate_request_code($request->user_id);
        $userRequest->status = $request->status;
        $userRequest->save();

        //SmsSender::request_registered($userRequest);

        if ($userRequest->status == 1) {
            $preinvoice = Preinvoice::query()->where('request_id', '=', $userRequest->id)->firstOrNew();
            $preinvoice->request_id = $userRequest->id;
            $preinvoice->code = $this->generate_preinvoice_code($userRequest->id);
            $preinvoice->save();
            return redirect()->route('preinvoice.edit', $preinvoice->id);
        } else {
            return redirect()->route('requests');
        }

        return redirect()->route('requests');
    }

    public function destroy($id) {
        $service = UserRequest::query()->where('id', $id)->first();
        $service->delete();
        return back()->with('status', 'حذف درخواست با موفقیت انجام شد');
    }


}
