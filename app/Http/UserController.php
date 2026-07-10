<?php

namespace App\Http\Controllers;

use App\Models\Acquaintance;
use App\Models\City;
use App\Models\Mobile;
use App\Models\Province;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use App\Models\UserAddress;
use App\Services\Notification\SmsSender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {


    public function index() {
        $expert_id = auth('admin')->user()->id;
        /*$list = User::with('roles')
            ->where('expert_id', '=', $expert_id)
            ->orderBy('customer_code', 'Desc')
            ->get();*/

        $list = User::with('roles')
            ->myUser($expert_id)
            ->orderBy('customer_code', 'Desc')
            ->get();


        $title = __('title.users');
        return view('user.list', compact('list', 'title'));
    }

    public function create() {
        $roles = Role::all();
        $experts = Role::query()->with('admins')->where('title', '=', 'Sales Expert')->firstOrFail()->admins;
        $provinces = Province::all();
        $cities = City::query()->orderBy('name')->get();
        $services = Service::all();
        $acquaintances = Acquaintance::all();
        $title = __('title.add_user');
        //event('create.user',null);
        return view('user.add', compact('title', 'roles', 'experts', 'provinces', 'cities', 'services', 'acquaintances'));
    }

    private function generate_customer_code() {
        
    $customer_code = User::withoutGlobalScopes()->withTrashed()->max('customer_code') + 1;
    return $customer_code;
    }

public function store(Request $request): RedirectResponse
{

    $request->validate([
        'name' => 'required_if:identity_type,natural',
        'family' => 'required_if:identity_type,natural',
        'gender' => 'required_if:identity_type,natural',
        'company' => 'required_if:identity_type,legal',
        'identity_type' => 'required',
        'telephone' => 'nullable|required_if:mobile,null|unique:users',
        'mobile' => 'nullable|required_if:telephone,null|unique:users|size:11',
        "group_mobile" => "nullable|array",
        "group_mobile.*.mobile" => "nullable|distinct|size:11",
        'city_id' => 'required',
        'address' => 'required',
    ]);

    DB::beginTransaction();
    try {
        $user = new User();
        $user->name = $request->name;
        $user->family = $request->family;
        $user->national_code = $request->national_code;
        $user->economic_code = $request->economic_code;
        $user->registration_number = $request->registration_number;
        $user->gender = $request->gender;
        $user->identity_type = $request->identity_type;
        $user->mobile = $request->mobile;
        $user->company = $request->company;
        $user->website = $request->website;
        $user->connector_name = $request->connector_name;
        $user->connector_position = $request->connector_position;
        $user->expert_id = auth('admin')->user()->id;
        $user->acquaintance_id = $request->acquaintance_id;
        $user->telephone = $request->telephone;
        $user->mobile_owner = $request->mobile_owner;
        $user->email = $request->email;
        $user->customer_code = $this->generate_customer_code();
        $user->save();

        $userAddress = new UserAddress();
        $userAddress->user_id = $user->id;
        $this->saveAddress($request, $userAddress);

        // اصلاح: استفاده از group_mobile به جای mobiles
        $this->saveUserMobiles($request, $user);

        $user->services()->sync($request->services);

        DB::commit();
        SmsSender::user_registered($user);

        return redirect()->route('user.show', $user->id);
    } catch (\Exception $e) {
        DB::rollback();
        Log::error($e->getMessage());

    dd($e->getMessage());   // یا return $e->getMessage();

        // بازگشت به صفحه قبل با پیام خطا
        return back()
            ->withInput()
            ->with('error', 'خطایی در ثبت کاربر رخ داد. لطفاً دوباره تلاش کنید.');
    }
}


    public function show($id) {
        $user = User::query()->with('roles', 'mobiles', 'address')->where('id', $id)->firstOrFail();
        $roles = Role::all();
        $experts = Role::query()->with('admins')->where('title', '=', 'Sales Expert')->firstOrFail()->admins;
        $provinces = Province::all();
        $cities = City::all();
        $services = Service::all();
        $acquaintances = Acquaintance::all();
        $title = __('title.show_user');
        return view('user.show', compact('title', 'user', 'roles', 'experts', 'provinces', 'cities', 'services', 'acquaintances'));
    }

    public function edit($id) {
        $user = User::query()->with('roles', 'mobiles', 'address')->where('id', $id)->firstOrFail();
        $roles = Role::all();
        $experts = Role::query()->with('admins')->where('title', '=', 'Sales Expert')->firstOrFail()->admins;
        $provinces = Province::all();
        $cities = City::all();
        $services = Service::all();
        $acquaintances = Acquaintance::all();
        //$customer_code=User::query()->max('customer_code')+100;
        $title = __('title.edit_user');
        ///dd($user);
        return view('user.edit', compact('title', 'user', 'roles', 'experts', 'provinces', 'cities', 'services', 'acquaintances'));
    }

public function update(Request $request): RedirectResponse
{
    $request->validate([
        'name' => 'required_if:identity_type,natural',
        'family' => 'required_if:identity_type,natural',
        'gender' => 'required_if:identity_type,natural',
        'company' => 'required_if:identity_type,legal',
        "group_mobile" => "nullable|array",
        "group_mobile.*.mobile" => "nullable|distinct|size:11",
        'city_id' => 'required',
        'mobile' => 'nullable|required_if:telephone,null|size:11|unique:users,mobile,' . $request->id,
        'telephone' => 'nullable|required_if:mobile,null|unique:users,telephone,' . $request->id,
        'email' => 'nullable|email:rfc,dns|unique:users,email,' . $request->id,
        'identity_type' => 'required',
    ]);

    DB::beginTransaction();
    try {
        $user = User::query()->where('id', $request->id)->first();
        $user->mobile = $request->mobile;
        $user->name = $request->name;
        $user->family = $request->family;
        $user->national_code = $request->national_code;
        $user->economic_code = $request->economic_code;
        $user->registration_number = $request->registration_number;
        $user->gender = $request->gender;
        $user->company = $request->company;
        $user->website = $request->website;
        $user->connector_name = $request->connector_name;
        $user->connector_position = $request->connector_position;
        $user->identity_type = $request->identity_type;
        $user->expert_id = $request->expert_id;
        $user->acquaintance_id = $request->acquaintance_id;
        $user->telephone = $request->telephone;
        $user->mobile_owner = $request->mobile_owner;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();

        $userAddress = UserAddress::query()->where('user_id', $request->id)->first();
        if (is_null($userAddress)) {
            $userAddress = new UserAddress();
            $userAddress->user_id = $user->id;
        }
        $this->saveAddress($request, $userAddress);

        $user->mobiles()->delete();
        $this->saveUserMobiles($request, $user);

        $user->services()->sync($request->services);

        DB::commit();

        return redirect()->route('users');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error($e->getMessage());

        return back()
            ->withInput()
            ->with('error', 'خطایی در ویرایش کاربر رخ داد. لطفاً دوباره تلاش کنید.');
    }
}


    private function saveAddress(Request $request, $userAddress) {

        $userAddress->city_id = $request->city_id;
        $userAddress->address = $request->address;
        $userAddress->location = $request->location;
        $userAddress->area = $request->area;
        $userAddress->latitude = $request->latitude;
        $userAddress->longitude = $request->longitude;
        $userAddress->postal_box = $request->postal_box;
        $userAddress->postal_code = $request->postal_code;
        $userAddress->save();
    }

    private function saveUserMobiles(Request $request, $user) {
        if (!empty($request->group_mobile)) {
            foreach ($request->group_mobile as $item) {
                if (!is_null($item['mobile'])) {
                    $mobile = new Mobile();
                    $mobile->user_id = $user->id;
                    $mobile->mobile = $item['mobile'];
                    $mobile->telephone = $item['telephone'];
                    $mobile->mobile_owner = $item['mobile_owner'];
                    $user->mobiles()->save($mobile);
                }
            }
        }
    }

    public function destroy($id): RedirectResponse {
        $user = User::query()->where('id', $id)->firstOrFail();
        $user->delete();
        return back()->with('status', 'حذف کاربر با موفقیت انجام شد');
    }

    public function check(Request $request) {
        $mobile = $request->query('mobile') !== null ? $request->query('mobile') : $request->query('mobile_additional');
        $user = User::query()->where('mobile', '=', $mobile)->first();
        if (is_null($user)) {
            return response(['valid' => true], 200);
        } else {
            return response(['valid' => false], 200);
        }

    }

    public function checkExistMobile(Request $request) {
        Log::info('mobile:' . $request->mobile);
        $mobile = $request->mobile ?? 'j98uhiuiuhuih';
        $user = User::query()->where('mobile', '=', $mobile)->first();
        Log::info('user:' . $user);
        if (!is_null($user)) {
            return response(['valid' => true, 'user' => $user], 200);
        } else {
            return response(['valid' => false, 'user' => null], 200);

        }

    }

    public function checkExistTelephone(Request $request) {
        $telephone = $request->telephone;
        $user = User::query()->where('telephone', '=', $telephone)->first();
        if (!is_null($user)) {
            return response(['valid' => true, 'user' => $user], 200);
        } else {
            return response(['valid' => false, 'user' => null], 200);
        }

    }

    private function syncUserMobiles($mobiles, $user) {
        if (!empty($mobiles)) {
            foreach ($mobiles as $item) {
                $itemParts = explode('@', $item);
                $mobile = new Mobile();
                $mobile->user_id = $user->id;
                $mobile->mobile = $itemParts[0];
                $mobile->telephone = $itemParts[1];
                $mobile->mobile_owner = $itemParts[2];
                $user->mobiles()->save($mobile);
            }
        }
    }


}
