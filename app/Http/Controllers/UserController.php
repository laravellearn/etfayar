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
use App\Models\Preinvoice;
use App\Models\UserRequest;

class UserController extends Controller {


    public function index(Request $request) {
        $expert_id = auth('admin')->user()->id;

        // شروع کوئری با اسکوپ کاربران متخصص جاری
        $query = User::with('roles', 'services')
            ->myUser($expert_id);

        // فیلتر نوع هویت
        if ($request->filled('identity_type')) {
            $query->where('identity_type', $request->identity_type);
        }

        // فیلتر نام و نام‌خانوادگی (شامل نام رابط و شرکت)
        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where(DB::raw("CONCAT(name, ' ', family)"), 'LIKE', "%{$name}%")
                  ->orWhere('company', 'LIKE', "%{$name}%")
                  ->orWhere('connector_name', 'LIKE', "%{$name}%");
            });
        }

        // فیلتر کد ملی
        if ($request->filled('national_code')) {
            $query->where('national_code', 'LIKE', "%{$request->national_code}%");
        }

        // فیلتر موبایل (اصلی + شماره‌های رابط)
        if ($request->filled('mobile')) {
            $mobile = $request->mobile;
            $query->where(function ($q) use ($mobile) {
                $q->where('mobile', 'LIKE', "%{$mobile}%")
                  ->orWhereHas('mobiles', function ($q2) use ($mobile) {
                      $q2->where('mobile', 'LIKE', "%{$mobile}%");
                  });
            });
        }
        
        // فیلتر شماره ثابت (تلفن اصلی + شماره ثابت‌های رابط در mobiles)
if ($request->filled('telephone')) {
    $telephone = $request->telephone;
    $query->where(function ($q) use ($telephone) {
        $q->where('telephone', 'LIKE', "%{$telephone}%")
          ->orWhereHas('mobiles', function ($q2) use ($telephone) {
              $q2->where('telephone', 'LIKE', "%{$telephone}%");
          });
    });
}

        // فیلتر ایمیل
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }

        // فیلتر شهر (بر اساس city_id در آدرس)
        if ($request->filled('city_id')) {
            $query->whereHas('address', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }

        // فیلتر کد پستی
        if ($request->filled('postal_code')) {
            $query->whereHas('address', function ($q) use ($request) {
                $q->where('postal_code', 'LIKE', "%{$request->postal_code}%");
            });
        }

        // فیلتر آدرس
        if ($request->filled('address')) {
            $query->whereHas('address', function ($q) use ($request) {
                $q->where('address', 'LIKE', "%{$request->address}%");
            });
        }

        // فیلتر شماره مشتری
        if ($request->filled('customer_code')) {
            $query->where('customer_code', 'LIKE', "%{$request->customer_code}%");
        }

        // فیلتر کد اقتصادی
        if ($request->filled('economic_code')) {
            $query->where('economic_code', 'LIKE', "%{$request->economic_code}%");
        }

        // مرتب‌سازی نهایی
        $list = $query->orderBy('customer_code', 'Desc')->get();

        // دریافت لیست شهرها برای dropdown فیلتر
        $cities = City::orderBy('name')->get();

        $title = __('title.users');
        return view('user.list', compact('list', 'title', 'cities'));
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
        // باگ ۲۱: فرم شماره‌های اضافی را با نام mobiles[] (فرمت: mobile@telephone@owner) ارسال می‌کند
        // اما saveUserMobiles از group_mobile (آرایه آبجکت) می‌خواند — اینجا تبدیل می‌کنیم
        $groupMobile = collect($request->input('mobiles', []))
            ->map(function ($item) {
                $parts = explode('@', $item);
                return [
                    'mobile'       => $parts[0] ?? null,
                    'telephone'    => $parts[1] ?? null,
                    'mobile_owner' => $parts[2] ?? null,
                ];
            })
            ->filter(fn($item) => !empty($item['mobile']))
            ->values()
            ->all();
        $request->merge(['group_mobile' => $groupMobile]);

        $request->validate([
            'name'          => 'required_if:identity_type,natural',
            'family'        => 'required_if:identity_type,natural',
            'gender'        => 'required_if:identity_type,natural',
            'company'       => 'required_if:identity_type,legal',
            'identity_type' => 'required',
            'telephone'     => 'nullable|required_if:mobile,null|unique:users',
            'mobile'        => 'nullable|required_if:telephone,null|unique:users|size:11',
            'city_id'       => 'required',
            'address'       => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name                = $request->name;
            $user->family              = $request->family;
            $user->national_code       = $request->national_code;
            $user->economic_code       = $request->economic_code;
            $user->registration_number = $request->registration_number;
            $user->gender              = $request->gender;
            $user->identity_type       = $request->identity_type;
            $user->mobile              = $request->mobile;
            $user->company             = $request->company;
            $user->website             = $request->website;
            $user->connector_name      = $request->connector_name;
            $user->connector_position  = $request->connector_position;
            $user->expert_id           = auth('admin')->user()->id;
            $user->acquaintance_id     = $request->acquaintance_id;
            $user->telephone           = $request->telephone;
            $user->mobile_owner        = $request->mobile_owner;
            $user->email               = $request->email;
            $user->customer_code       = $this->generate_customer_code();
            $user->notes               = $request->notes;
            $user->save();

            $userAddress          = new UserAddress();
            $userAddress->user_id = $user->id;
            $this->saveAddress($request, $userAddress);

            $this->saveUserMobiles($request, $user);

            $user->services()->sync($request->services ?? []);

            DB::commit();
            SmsSender::user_registered($user);

            return redirect()->route('user.show', $user->id)->with('status', 'با موفقیت ثبت شد');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            // باگ ۱۹: dd() دیباگ حذف شد — خطا به‌درستی به کاربر نمایش داده می‌شود
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
        $userSupports = \App\Models\UserSupport::with('admin')->where('user_id', $id)->orderByDesc('support_time')->get();
        $title = __('title.show_user');
        return view('user.show', compact('title', 'user', 'roles', 'experts', 'provinces', 'cities', 'services', 'acquaintances', 'userSupports'));
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
    // ردیف‌های خالیِ شماره تماس اضافه رو قبل از اعتبارسنجی حذف کن؛ وگرنه چند مقدار
    // خالی/تکراری در group_mobile باعث شکست قانون distinct می‌شن و بدون خطای قابل توجه
    // فرم ذخیره نمی‌شه.
    $request->merge([
        'group_mobile' => collect($request->group_mobile ?? [])
            ->filter(fn($item) => !empty($item['mobile'] ?? null))
            ->values()
            ->all(),
    ]);

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
        $user->notes = $request->notes;
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

        return redirect()->route('users')->with('status', 'با موفقیت ویرایش شد');
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
    
    
    
    
    public function requests($id) {
    $user = User::findOrFail($id);
    $list = UserRequest::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    $title = "درخواست‌های {$user->full_name}";
    return view('user.requests', compact('list', 'title', 'user'));
}

public function preinvoices($id)
{
    $user = User::findOrFail($id);

    $list = Preinvoice::with('request.user')
                ->whereHas('request', function ($q) use ($id) {
                    $q->where('user_id', $id);
                })
                ->orderBy('created_at', 'desc')
                ->get();

    $title = "پیش‌فاکتورهای {$user->full_name}";
    return view('user.preinvoices', compact('list', 'title', 'user'));
}


}
