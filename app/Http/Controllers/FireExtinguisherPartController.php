<?php

namespace App\Http\Controllers;

use App\Models\FireExtinguisherPart;
use App\Services\uploader\Uploader;
use Illuminate\Http\Request;

class FireExtinguisherPartController extends Controller {

    private $uploader;

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }


    public function index() {
        $list = FireExtinguisherPart::all();
        $title = __('fireExtinguisherPart.fireExtinguisherPart');
        return view('fireExtinguisherPart.list', compact('list', 'title'));

    }

    public function create() {
        $title = __('fireExtinguisherPart.add');
        return view('fireExtinguisherPart.add', compact('title'));
    }

    public function store(Request $request) {

        $single = new FireExtinguisherPart();
        $single->title = $request->title;
        if (!is_null($request->image)) {
            $imagePath = $this->uploader->upload($request->image);
            $single->image = $imagePath;
        }
        $single->price = $request->price;
        $single->status = $request->status;
        $single->save();
        return redirect()->route('fireExtinguisherParts')->with('status', 'با موفقیت ثبت شد');
    }

    public function show($id) {

    }

    public function edit($id) {
        $title = __('fireExtinguisherPart.edit');
        $single = FireExtinguisherPart::where('id', '=', $id)->first();
        return view('fireExtinguisherPart.edit', compact('title', 'single'));
    }

    public function update(Request $request) {
        $single = FireExtinguisherPart::where('id', '=', $request->id)->first();
        $single->title = $request->title;
        if (!is_null($request->image)) {
            $imagePath = $this->uploader->upload($request->image);
            $single->image = $imagePath;
        }
        $single->price = $request->price;
        $single->status = $request->status;
        $single->save();
        return redirect()->route('fireExtinguisherParts')->with('status', 'با موفقیت ویرایش شد');
    }

    public function destroy($id) {
        $single = FireExtinguisherPart::where('id', '=', $id)->first();
        $single->delete();
        return redirect()->route('fireExtinguisherParts');
    }
}
