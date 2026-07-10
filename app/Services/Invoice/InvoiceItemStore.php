<?php

namespace App\Services\Invoice;

use App\Models\PreinvoiceItem;
use App\Models\Product;

class InvoiceItemStore {

    public static function store($products, $invoice) {
        self::delete_old_items($invoice);
        if (!empty($products)) {
            foreach ($products as $product) {

                $productsParts = explode('@', $product);
                $product_id = $productsParts[0];
                $product_count = $productsParts[1];
                $product_price = $productsParts[2];

                $preinvoceItem = new PreinvoiceItem();
                $preinvoceItem->preinvoice_id = $invoice->id;
                $preinvoceItem->product_id = $product_id;
                $product = Product::where('id', $product_id)->first();
                $preinvoceItem->title = $product->title;
                $preinvoceItem->count = $product_count;
                $preinvoceItem->price = $product_price;
                $preinvoceItem->save();
                ProductManager::update_product_quantity($product_id, $product_count);
            }
        }
    }

    public static function delete_old_items($invoice) {
        foreach ($invoice->items as $item) {
            ProductManager::back_product_quantity($item->product_id, $item->count);
            $item->delete();
        }

    }

}
