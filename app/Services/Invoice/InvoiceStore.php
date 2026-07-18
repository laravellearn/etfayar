<?php

namespace App\Services\Invoice;

use App\Models\Information;
use App\Models\Preinvoice;
use App\Models\UserRequest;

class InvoiceStore {

    public static function store($request) {
        $single = Preinvoice::with('items', 'request')->where('id', $request->id)->firstOrCreate();
        $information = Information::where('id', $request->information_id)->first();
        $single->title = $information->name;
        $single->tax = $request->tax;
        $single->header = $request->header;
        $single->sign = $request->sign;
        $single->information_id = $request->information_id;
        $single->code = self::generate_invoice_code($single->request->id);
        $single->description = $request->description;
        if ($request->status != 'financial') {
            $single->status = $request->status;
        }

        $bank = $information->bank ?? null;
        if (!is_null($bank)) {
            $single->bank_id = $bank->id;
            $single->bank_name = $bank->name;
            $single->bank_account = $bank->account;
            $single->bank_cart_code = $bank->cart_code;
            $single->bank_sheba = $bank->sheba;
        }

        if (!is_null($information)) {
            $single->seller_name = $information->name;
            $single->seller_economic_code = $information->economic_code;
            $single->seller_postal_code = $information->postal_code;
            $single->seller_national_code = $information->national_code;
            $single->seller_registration_number = $information->registration_number;
        }

        $single->save();
        return $single;
    }

    public static function generate_invoice_code($request_id) {
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

    }
}
