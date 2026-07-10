<?php

namespace App\Http\Controllers;

use App\Models\FireExtinguisherPart;
use App\Models\Preinvoice;
use App\Models\PreinvoiceItem;
use App\Models\Workshop;
use App\Models\WorkshopItem;
use Illuminate\Http\Request;

class WorkshopController extends Controller {

    public function index() {
        $list = Workshop::query()->where('status', '=', 0)->orderBy('created_at', 'desc')->get();
        $title = __('workshop.title');
        return view('workshop.list', compact('list', 'title'));
    }

    public function doneTasks() {
        $list = Workshop::query()->where('status', '=', 1)->orderBy('created_at', 'desc')->get();
        $title = __('workshop.doneTasks');
        return view('workshop.list', compact('list', 'title'));
    }

    public function edit($id) {
        $title = __('workshop.add');
        $fireExtinguisherParts = FireExtinguisherPart::all();
        $workshop = Workshop::query()->with('items')->where('id', '=', $id)->firstOrNew();
        $workshopItems = $workshop->items->toArray();
        return view('workshop.add', compact('title', 'fireExtinguisherParts', 'id', 'workshopItems'));
    }

    public function store(Request $request) {
        $workshop = Workshop::query()->where('id', '=', $request->id)->firstOrNew();
        $workshop->items()->delete();
        if (!empty($request->group_item)) {

            foreach ($request->group_item as $item) {
                $workshopItem = new WorkshopItem();
                $workshopItem->workshop_id = $workshop->id;
                $workshopItem->fire_extinguisher_part_id = $item['fireExtinguisherPart_id'];
                $fireExtinguisherPart = FireExtinguisherPart::where('id', '=', $item['fireExtinguisherPart_id'])->first();
                $workshopItem->count = $item['count'];
                $workshopItem->price = $fireExtinguisherPart->price;
                $workshopItem->title = $fireExtinguisherPart->title;
                $workshopItem->save();
            }

            $workshop->status = 1;
            $workshop->save();

        }
        return redirect()->route('workshop.doneTasks');

    }

    public function exit_from_workshop_tasks($id) {
        $single = Workshop::query()->with('items')->where('id', '=', $id)->first();
        $single->status = 1;
        $single->save();
        return redirect()->route('workshop.doneTasks');
    }


}
