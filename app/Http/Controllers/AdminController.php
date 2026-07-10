<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {

    use Authenticatable;


    public function index() {
        $list = Admin::with('roles')->get();
        $title = __('title.admins');
        return view('admin.list', compact('list', 'title'));
    }

    public function create() {
        $roles = Role::all();
        $title = __('title.add_admin');
        return view('admin.add', compact('roles', 'title'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required_if:company,null',
            'family' => 'required_if:company,null',
            'mobile' => 'required|unique:users|size:11',
            'email' => 'required|unique:users|email:rfc,dns',
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'roles' => 'required',
        ]);

        $admin = new Admin();
        $admin->mobile = $request->mobile;
        $admin->name = $request->name;
        $admin->family = $request->family;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->status = $request->status;
        $admin->save();
        $admin->refreshRole($request->roles);
        return redirect()->route('admins');

    }

    public function show($id) {
        $admin = Admin::query()->with('roles')->where('id', $id)->firstOrFail();
        $roles = Role::all();
        $ip = \request()->ip();
        $title = __('admin.show_admin');
        return view('admin.single', compact('admin', 'roles', 'title', 'ip'));
    }

    public function edit($id) {
        $admin = Admin::query()->with('roles')->where('id', $id)->firstOrFail();
        $roles = Role::all();
        $title = __('title.edit_admin');
        return view('admin.edit', compact('admin', 'roles', 'title'));
    }

    public function update(Request $request) {

        $request->validate([
            'name' => 'required',
            'family' => 'required',
            'mobile' => 'required|size:11|unique:admins,mobile,' . $request->id,
            'email' => 'required|email:rfc,dns|unique:admins,email,' . $request->id,
            'username' => 'required|unique:admins,username,' . $request->id,
            'roles' => 'required',
        ]);

        $admin = Admin::query()->where('id', $request->id)->firstOrFail();
        $admin->mobile = $request->mobile;
        $admin->name = $request->name;
        $admin->family = $request->family;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->status = $request->status;
        $admin->save();
        $admin->refreshRole($request->roles);
        return redirect()->route('admins');
    }

    public function destroy($id) {
        $admin = Admin::query()->where('id', $id)->firstOrFail();
        $admin->delete();
        return back()->with('status', 'حذف مدیر با موفقیت انجام شد');
    }

    public function profile() {
        $admin_id = auth('admin')->user()->id;
        $admin = Admin::query()->with('roles')->where('id', $admin_id)->firstOrFail();
        $roles = Role::all();
        $ip = \request()->ip();
        $title = __('admin.show_admin');
        return view('admin.profile', compact('admin', 'roles', 'title', 'ip'));
    }

    public function change_password(Request $request) {
        $request->validate([
            'password_old' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $admin = auth('admin')->user();
        $check = Hash::check($request->password_old, $admin->password);
        if ($check) {
            $admin->password = Hash::make($request->password);
            $admin->save();
            return back()->with('status', 'تغییر رمز با موفقیت انجام شد');
        }

        return back()->with('error', 'رمز قدیمی شما اشتباه است');
    }

}
