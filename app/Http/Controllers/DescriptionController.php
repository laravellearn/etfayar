<?php

namespace App\Http\Controllers;

use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller {

    public function index() {
        $list = Description::all();
        $title = __('description.title');
        return view('description.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('description.add');
        return view('description.add', compact('title'));
    }

    public function store(Request $request) {
        $description = new Description();
        $description->description = $request->description;
        $description->save();
        return redirect()->route('descriptions');
    }

    public function show($id) {

    }

    public function edit($id) {
        $single = Description::query()->find($id);
        $title = __('description.edit');
        return view('description.edit', compact('title','single'));
    }

    public function update(Request $request) {
        $description = Description::query()->find($request->id);
        $description->description = $request->description;
        $description->save();
        return redirect()->route('descriptions');
    }

    public function destroy($id) {
        $description = Description::query()->find($id);
        $description->delete();
        return redirect()->route('descriptions');
    }

}
