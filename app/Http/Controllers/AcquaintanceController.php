<?php

namespace App\Http\Controllers;

use App\Models\Acquaintance;
use App\Models\Description;
use Illuminate\Http\Request;

class AcquaintanceController extends Controller
{
    public function index()
    {
        $list = Acquaintance::all();
        $title = __('acquaintance.title');
        return view('acquaintance.list', compact('list', 'title'));
    }

    public function create()
    {
        $title = __('acquaintance.add');
        return view('acquaintance.add', compact('title'));
    }

    public function store(Request $request)
    {
        $single = new Acquaintance();
        $single->title = $request->title;
        $single->save();
        return redirect()->route('acquaintances')->with('status', 'با موفقیت ثبت شد');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $single = Acquaintance::query()->find($id);
        $title = __('acquaintance.edit');
        return view('acquaintance.edit', compact('title', 'single'));
    }

    public function update(Request $request)
    {
        $single = Acquaintance::query()->find($request->id);
        $single->title = $request->title;
        $single->save();
        return redirect()->route('acquaintances')->with('status', 'با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $single = Acquaintance::query()->find($id);
        $single->delete();
        return redirect()->route('acquaintances');
    }


}
