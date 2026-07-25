<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller {
    public function index() {
        $list = Bank::all();
        $title = __('bank.title');
        return view('bank.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('bank.add');
        return view('bank.add', compact('title'));
    }

    public function store(Request $request) {
        $single = new Bank();
        $single->name = $request->name;
        $single->account = $request->account;
        $single->cart_code = $request->cart_code;
        $single->sheba = $request->sheba;
        $single->status = $request->status;
        $single->save();
        return redirect()->route('banks')->with('status', 'با موفقیت ثبت شد');
    }

    public function show($id) {

    }

    public function edit($id) {
        $single = Bank::query()->find($id);
        $title = __('bank.edit');
        return view('bank.edit', compact('title', 'single'));
    }

    public function update(Request $request) {
        $single = Bank::query()->find($request->id);
        $single->name = $request->name;
        $single->account = $request->account;
        $single->cart_code = $request->cart_code;
        $single->sheba = $request->sheba;
        $single->status = $request->status;
        $single->save();
        return redirect()->route('banks')->with('status', 'با موفقیت ویرایش شد');
    }

    public function destroy($id) {
        $single = Bank::query()->find($id);
        $single->delete();
        return redirect()->route('banks');
    }

}
