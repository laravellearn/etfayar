<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Insurance;
use App\Models\InsuranceItem;
use App\Models\Product;
use App\Models\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InsuranceController extends Controller {

    public function index() {
        $list = Insurance::all();
        $title = __('insurance.title');
        return view('insurance.list', compact('list', 'title'));
    }

    public function filter(Request $request) {

        $min = $request->min;
        $max = $request->max;

        $query = Insurance::query();
        if (isset($min) && !is_null($min)) {
            $query->where('number', '>=', $min);
        }
        if (isset($max) && !is_null($max)) {
            $query->where('number', '<=', $max);
        }

        $list = $query->get();

        $title = __('insurance.title');
        return view('insurance.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('insurance.add');
        $informations = Information::all();
        $users = User::all();
        $products = Product::all();
        return view('insurance.add', compact('title', 'informations', 'users', 'products'));
    }

    public function store(Request $request) {
        $single = new Insurance();
        $single->number = $request->number;
        $single->information_id = $request->information_id;
        $single->user_id = $request->user_id;
        $single->number = isset($request->number) ? $request->number : Insurance::max('number') + 100;
        $single->charge_time = $this->convert_jalali_to_gergorian($request->charge_time);
        $single->recharge_time = $this->convert_jalali_to_gergorian($request->recharge_time);
        $single->save();

        if (!empty($request->group_items)) {
            $is_add_first_number = false;
            $first_number = isset($request->start_number) ? $request->start_number : InsuranceItem::where('insurance_id', $single->id)->max('number') + 1;
            foreach ($request->group_items as $item) {
                $insuranceItem = new InsuranceItem();
                $insuranceItem->insurance_id = $single->id;
                $insuranceItem->product_id = $item['product_id'];
                if (!$is_add_first_number) {
                    $insuranceItem->number = $first_number++;
                    $is_add_first_number = true;
                } else {
                    $insuranceItem->number = $first_number++;
                    $is_add_first_number = true;
                }
                $insuranceItem->save();
            }
        }

        return redirect()->route('insurances');
    }


    public function show($id) {

    }

    public function edit($id) {
        $single = Insurance::query()->with('items')->find($id);
        $title = __('insurance.edit');
        $informations = Information::all();
        $users = User::all();
        $products = Product::all();
        return view('insurance.edit', compact('title', 'single', 'informations', 'users', 'products'));
    }

    public function update(Request $request) {
        $single = Insurance::find($request->id);
        $single->number = $request->number;
        $single->information_id = $request->information_id;
        $single->user_id = $request->user_id;
        $single->number = isset($request->number) ? $request->number : Insurance::max('number') + 100;
        $single->charge_time = $this->convert_jalali_to_gergorian($request->charge_time);
        $single->recharge_time = $this->convert_jalali_to_gergorian($request->recharge_time);
        $single->save();

        if (!empty($request->group_items)) {
            $single->items()->delete();
            foreach ($request->group_items as $item) {
                $insuranceItem = new InsuranceItem();
                $insuranceItem->insurance_id = $single->id;
                $insuranceItem->product_id = $item['product_id'];
                if (is_null($item['number']) || $item['number'] == 0) {
                    $insuranceItem->number = InsuranceItem::max('number') + 1;
                } else {
                    $insuranceItem->number = $item['number'];
                }
                $insuranceItem->save();
            }
        }
        return redirect()->route('insurances');
    }

    public function destroy($id) {
        $single = Insurance::query()->find($id);
        $single->items()->delete();
        $single->forceDelete();
        return redirect()->route('insurances');
    }

    private function convert_jalali_to_gergorian($visit_date) {
        if (!is_null($visit_date)) {
            $v = Verta::parse($visit_date);
            return $v->formatGregorian('Y-m-d');
        } else {
            $v = Verta::now();
            return $v->formatGregorian('Y-m-d');
        }
    }


    public function show_pdf($id) {
        $single = Insurance::query()->with('items')->find($id);
        $data = [
            'information_name' => $single->information->name,
            'full_name' => $single->user->full_name,
            'address' => $single->user->address->toStringAddress ?? '',
            'number' => $single->number,
            'persianChargeTime' => $single->persianChargeTime,
            'persianRechargeTime' => $single->persianRechargeTime,
            'persianDate' => $single->PersianDate,
            'items' => $single->items,
        ];

        $pdf = PDF::loadView('pdf.insurance', $data, [], [
            'format' => 'A4',
            'orientation' => 'P',
        ]);
        $name = $single->information->name . ' ' . $single->user->full_name . '.pdf';
        return $pdf->stream($name);
    }

}
