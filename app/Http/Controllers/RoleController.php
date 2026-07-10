<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller {

    public function index() {
        $list = Role::with('permissions')->get();
        $title = __('title.roles');
        return view('role.list', compact('list', 'title'));
    }


    public function create() {
        $permissions = Permission::permissions();
        $role = Role::query()->latest('id')->firstOrFail();
        $code = 0;
        if ($role != null) {
            $code = $role->code;
        }
        $code = $code + 100;
        $title = __('title.add_role');
        return view('role.add', compact('code', 'permissions', 'title'));
    }

    public function store(Request $request) {
        $role = new Role();
        $role->code = $request->code;
        $role->title = $request->title;
        $role->persian_title = $request->persian_title;
        $role->status = $request->status;
        $role->save();
        $role->refreshPermissions($request->permissions);
        // return redirect()->back()->with('status', "نقش افزوده شد");
        return redirect()->route('roles')->with('status', "نقش افزوده شد");
    }

    public function edit($id) {
        $role = Role::query()->with('permissions')->where('id', $id)->firstOrFail();
        $permissions = Permission::permissions();
        $title = __('title.edit_role');
        return view('role.edit', compact('role', 'permissions', 'title'));
    }


    public function update(Request $request) {
        $role = Role::query()->where('id', $request->id)->firstOrFail();
        $role->persian_title = $request->persian_title;
        $role->status = $request->status;
        $role->save();
        $role->refreshPermissions($request->permissions);
        //return redirect()->back()->with('status', "ویرایش نقش انجام شد");
        return redirect()->route('roles')->with('status', "نقش افزوده شد");
    }

    public function destroy($id) {
        $role = Role::query()->where('id', $id)->firstOrFail();
        $role->delete();
        return back()->with('status', 'حذف نقش با موفقیت انجام شد');
    }


}
