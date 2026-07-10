<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
        $list = Product::all();
        $title = __('product.title');
        return view('product.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('product.add');
        return view('product.add', compact('title'));
    }

    public function store(Request $request) {
        $single = new Product();
        $single->title = $request->title;
        $single->price = $request->price;
        $single->quantity = $request->quantity;
        $single->code = $this->get_max_code() + 10;
        $single->type = $request->type;
        $single->save();
        return redirect()->route('products');
    }

    private function get_max_code() {
        $max_product_code = Product::query()->max('code');
        return $max_product_code;
    }

    public function show($id) {

    }

    public function edit($id) {
        $single = Product::query()->find($id);
        $title = __('product.edit');
        return view('product.edit', compact('title', 'single'));
    }

    public function update(Request $request) {
        $single = Product::query()->find($request->id);
        $single->title = $request->title;
        $single->price = $request->price;
        $single->quantity = $request->quantity;

        $single->save();
        return redirect()->route('products');
    }

    public function destroy($id) {
        $single = Product::query()->find($id);
        $single->delete();
        return redirect()->route('products');
    }

}
