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
        return view('workshop.add', compact('title', 'fireExtinguisherParts', 'id', 'workshopItems', 'workshop'));
    }

    public function store(Request $request) {
        $workshop = Workshop::query()->where('id', '=', $request->id)->firstOrNew();

        // قیمت‌های قبلاً ثبت‌شده‌ی هر قطعه رو قبل از حذف نگه می‌داریم؛ چون این متد
        // همیشه آیتم‌های قبلی رو پاک و از نو می‌سازه، بدون این کار، تغییر قیمت یک
        // قطعه در «لیست قیمت داغی‌ها» با هر بار ویرایش این داغی (حتی برای افزودن یک
        // قطعه‌ی جدید یا تغییر تعداد)، قیمت قطعات قبلاً ثبت‌شده رو هم بازنویسی می‌کرد.
        $previousPrices = $workshop->exists
            ? $workshop->items()->pluck('price', 'fire_extinguisher_part_id')->all()
            : [];

        $workshop->items()->delete();
        if (!empty($request->group_item)) {

            foreach ($request->group_item as $item) {
                $workshopItem = new WorkshopItem();
                $workshopItem->workshop_id = $workshop->id;
                $workshopItem->fire_extinguisher_part_id = $item['fireExtinguisherPart_id'];
                $fireExtinguisherPart = FireExtinguisherPart::where('id', '=', $item['fireExtinguisherPart_id'])->first();
                $workshopItem->count = $item['count'];
                // اگر این قطعه قبلاً برای همین داغی ثبت شده بود، قیمت قبلی (فریزشده) حفظ
                // می‌شه؛ فقط برای قطعه‌ی تازه‌اضافه‌شده از قیمت فعلیِ لیست قیمت استفاده می‌شه.
                $workshopItem->price = $previousPrices[$item['fireExtinguisherPart_id']] ?? $fireExtinguisherPart->price;
                $workshopItem->title = $fireExtinguisherPart->title;
                $workshopItem->save();
            }

        }

        // توضیحات و وضعیت همیشه ذخیره بشه، حتی اگه به هر دلیلی هیچ قطعه‌ای انتخاب نشده باشه.
        // تاریخ ثبت (created_at) به‌صورت خودکار توسط خود لاراول برای رکورد جدید ثبت می‌شه.
        $workshop->description = $request->description;
        $workshop->has_no_fire_extinguisher_part = $request->has('has_no_fire_extinguisher_part');
        $workshop->status = 1;
        $workshop->save();

        return redirect()->route('workshop.doneTasks');

    }

    public function exit_from_workshop_tasks($id) {
        $single = Workshop::query()->with('items')->where('id', '=', $id)->first();
        $single->status = 1;
        $single->save();
        return redirect()->route('workshop.doneTasks');
    }


}
