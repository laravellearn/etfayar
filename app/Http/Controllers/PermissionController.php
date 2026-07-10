<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller {

    public function index() {
        //dd(Permission::permissions()->toArray());
        $list = Permission::all();
        $title = __('title.permissions');
        return view('permission.list', compact('list','title'));
    }

    public function create() {
        $permission = Permission::query()->latest('id')->firstOrFail();
        $code = 0;
        if ($permission != null) {
            $code = $permission->code;
        }
        $code = $code + 100;
        $title = __('title.add_permission');
        return view('permission.add', compact('code','title'));
    }

    public function store(Request $request) {
        $permission = new Permission();
        $permission->code = $request->code;
        $permission->title = $request->title;
        $permission->persian_title = $request->persian_title;
        $permission->parent_title = $request->parent_title;
        $permission->status = $request->status;
        $permission->save();
        return redirect()->route('permissions')->with('status', "مجوز افزوده شد");
    }

    public function edit($id) {
        $permission = Permission::query()->where('id', $id)->firstOrFail();
        $title = __('title.edit_permission');
        return view('permission.edit', compact('permission','title'));
    }


    public function update(Request $request) {
        $permission = Permission::query()->where('id', $request->id)->firstOrFail();
        $permission->persian_title = $request->persian_title;
        $permission->parent_title = $request->parent_title;
        $permission->status = $request->status;
        $permission->save();
        return redirect()->route('permissions')->with('status', "ویرایش مجوز انجام شد");
    }

    public function destroy($id) {
        $permission = Permission::query()->where('id', $id)->firstOrFail();
        $permission->delete();
        return back()->with('status', 'حذف مجوز با موفقیت انجام شد');
    }

}
