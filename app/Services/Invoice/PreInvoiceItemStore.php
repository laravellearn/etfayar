<?php

namespace App\Services\Invoice;

use App\Models\PreinvoiceItem;
use App\Models\Product;

class PreInvoiceItemStore {

    public static function store($products, $preinvoice) {
        self::delete_old_items($preinvoice);
        if (!empty($products)) {
            // باگ ۲: ترتیب ردیف‌های پیش‌فاکتور هنگام ویرایش تغییر می‌کرد.
            // حل: sort_order صریح ذخیره می‌شود تا ترتیب اصلی حفظ شود.
            $sortOrder = 1;
            foreach ($products as $product) {

                $productsParts = explode('@', $product);
                $product_id = $productsParts[0];
                $product_count = $productsParts[1];
                $product_price = $productsParts[2];

                $preinvoceItem = new PreinvoiceItem();
                $preinvoceItem->preinvoice_id = $preinvoice->id;
                $preinvoceItem->product_id = $product_id;
                $product = Product::where('id', $product_id)->first();
                $preinvoceItem->title = $product->title;
                $preinvoceItem->count = $product_count;
                $preinvoceItem->price = $product_price;
                $preinvoceItem->sort_order = $sortOrder++;
                $preinvoceItem->save();
            }
        }
    }

    public static function delete_old_items($preinvoice) {
        $preinvoice->items()->delete();
    }

}
