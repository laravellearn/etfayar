<?php

namespace App\Http\Controllers;

use App\Models\UserSupport;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSupportController extends Controller {

    public function index($user_id) {
        $admin_id = auth('admin')->user()->id;
        $list = UserSupport::with('admin', 'user')
            ->where('user_id', $user_id)
            ->where('admin_id', $admin_id)
            ->orderByDesc('created_at')
            ->get();
        $title = __('user_support.list');
        return view('user_support.list', compact('list', 'title', 'user_id'));
    }

    public function create($user_id) {
        $title = __('user_support.add');
        return view('user_support.add', compact('title', 'user_id'));
    }

    public function store(Request $request) {
        $userSupport = new UserSupport();
        $userSupport->user_id = $request->user_id;
        $userSupport->admin_id = auth('admin')->id();
        $userSupport->create_description = $request->create_description;
        $userSupport->support_time = $this->convert_jalali_to_gergorian($request->support_time);
        $userSupport->status = $request->status;
        $userSupport->save();
        return redirect()->route('user_supports', $request->user_id);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $previous_url = url()->previous();
        $title = __('user_support.edit');
        $single = UserSupport::query()->where('id', $id)->firstOrFail();
        return view('user_support.edit', compact('title', 'single', 'previous_url'));
    }

    public function update(Request $request) {

        $userSupport = UserSupport::query()->where('id', $request->id)->firstOrFail();;
        $userSupport->create_description = $request->create_description;
        $userSupport->support_time = $this->convert_jalali_to_gergorian($request->support_time);
        $userSupport->done_description = $request->done_description;
        $userSupport->status = $request->status;
        $userSupport->save();

        if (str_contains($request->previous_url, 'user_support/nearest')) {
            return redirect()->route('user_support.nearest');
        }
        return redirect()->route('user_supports', $userSupport->user_id);
    }

    public function destroy($id) {
        $service = UserSupport::query()->where('id', $id)->firstOrFail();
        $service->delete();
        return back()->with('status', 'حذف پشتیبانی با موفقیت انجام شد');
    }

    private function convert_jalali_to_gergorian($visit_date) {
        if (!is_null($visit_date)) {
            $v = Verta::parse($visit_date);
            return $v->formatGregorian('Y-m-d');
        } else {
            $v = Verta::now();
            return $v->formatGregorian('Y-m-d');
        }
    }

    public function nearest() {
        //dd(now()->toDateTimeString());
        //DB::enableQueryLog();
        //dd(Carbon::now()->toDateTimeString());
        $admin_id = auth('admin')->user()->id;
        $list = UserSupport::with('admin', 'user')
            ->where('admin_id', $admin_id)
            ->where('support_time', '>', Carbon::now()->toDateTimeString())
            ->orderBy('support_time')
            ->get();
        //dd(DB::getQueryLog());
        $title = __('user_support.nearest');
        return view('user_support.nearest', compact('list', 'title'));
    }


}
