<?php

namespace App\Services\Invoice;

use App\Models\FireExtinguisherPart;
use App\Models\WorkshopItem;

class WorkshopItemStore {

    public static function store($workshop_items, $workshop) {
        self::delete_old_items($workshop);
        if (!empty($workshop_items)) {
            foreach ($workshop_items as $item) {
                $workshopItem = new WorkshopItem();
                $workshopItem->workshop_id = $workshop->id;
                $workshopItem->fire_extinguisher_part_id = $item['fireExtinguisherPart_id'];
                $fireExtinguisherPart = FireExtinguisherPart::where('id', '=', $item['fireExtinguisherPart_id'])->first();
                $workshopItem->count = $item['count'];
                $workshopItem->price = $fireExtinguisherPart->price;
                $workshopItem->title = $fireExtinguisherPart->title;
                $workshopItem->save();
            }

        }
    }

    public static function delete_old_items($workshop) {
        if (isset($workshop->items)) {
            $workshop->items()->delete();
        }
    }

}
