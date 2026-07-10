<?php

namespace App\Services\Invoice;

use App\Models\Information;
use App\Models\Preinvoice;
use App\Models\UserRequest;

class PreInvoiceStore {

    public static function store($request) {
        $single = Preinvoice::with('items', 'request')->where('id', $request->id)->firstOrCreate();
        $information = Information::where('id', $request->information_id)->first();
        $single->title = $information->name ?? '';
        $single->tax = $request->tax;
        $single->request_id = $request->request_id;
        $single->header = $request->header;
        $single->sign = $request->sign;
        $single->information_id = $request->information_id;
        $single->code = self::generate_preinvoice_code($request->request_id);
        $single->description = $request->description;

        if ($request->status != 'financial') {
            $single->status = $request->status;
        }
        $single->save();
        return $single;
    }

    public static function update($request) {
        $single = Preinvoice::with('items', 'request')->where('id', $request->id)->firstOrCreate();
        $information = Information::where('id', $request->information_id)->first();
        $single->title = $information->name ?? '';
        $single->tax = $request->tax;
        $single->header = $request->header;
        $single->sign = $request->sign;
        $single->information_id = $request->information_id;
        $single->description = $request->description;

        if ($request->status != 'financial') {
            $single->status = $request->status;
        }
        $single->save();
        return $single;
    }

    public static function generate_preinvoice_code($request_id) {
        $request = UserRequest::where('id', '=', $request_id)->first();
        $code = str_replace(['D', '-'], ['', '/'], $request->code);
        return $code;
    }

    public static function change_to_invoice($id) {
        $shortage_products = [];
        $single = Preinvoice::with('items')->where('id', '=', $id)->firstOrFail();
        foreach ($single->items as $item) {
            if (!ProductManager::have_enough_capacity($item->product_id, $item->count)) {
                $shortage_products[] = $item;
            }
        }

        if (empty($shortage_products)) {
            ProductManager::update_products_quantity($single->items);
            $single->is_invoice = true;
            $single->status = 'financial';
            $single->save();
            return null;
        } else {
            return $shortage_products;
        }

        //dd("finish");

    }
}
