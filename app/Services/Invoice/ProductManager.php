<?php

namespace App\Services\Invoice;

use App\Models\Product;

class ProductManager {

    public static function get_product_quantity($product_id) {
        $single = Product::query()->find($product_id);
        $quantity = $single->quantity;
        return $quantity;
    }

    public static function have_enough_capacity($product_id, $count) {
        if (self::get_product_quantity($product_id) >= $count) {
            return true;
        } else {
            return false;
        }
    }


    public static function update_product_quantity($product_id, $count) {
        $single = Product::query()->find($product_id);
        $old_quantity = $single->quantity;
        $new_quantity = $old_quantity - $count;
        $single->quantity = $new_quantity;
        $single->save();
    }

    public static function update_products_quantity($items) {
        foreach ($items as $item) {
            ProductManager::update_product_quantity($item->product_id, $item->count);
        }
    }

    public static function back_product_quantity($product_id, $count) {

        $single = Product::query()->find($product_id);
        $old_quantity = $single->quantity;
        $new_quantity = $old_quantity + $count;
        $single->quantity = $new_quantity;
        $single->save();
    }

}
