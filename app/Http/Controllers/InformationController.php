<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\City;
use App\Models\Information;
use App\Models\Preinvoice;
use App\Models\Province;
use App\Services\uploader\Uploader;
use Illuminate\Http\Request;

class InformationController extends Controller {

    private $uploader;

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }


    public function index() {
        $list = Information::all();
        $title = __('information.informations');
        return view('information.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('information.add');
        $provinces = Province::all();
        $cities = City::all();
        $banks = Bank::all();
        return view('information.add', compact('title', 'provinces', 'cities','banks'));
    }

    public function store(Request $request) {


        $information = new Information();
        $information->name = $request->name;

        if (!is_null($request->logo)) {
            $logoPath = $this->uploader->upload($request->logo);
            $information->logo = $logoPath;
        }
        if (!is_null($request->sign)) {
            $signPath = $this->uploader->upload($request->sign);
            $information->sign = $signPath;
        }

        if ($request->header) {
            $headerPath = $this->uploader->upload($request->header);
            $information->header = $headerPath;
        }

        if ($request->footer) {
            $footerPath = $this->uploader->upload($request->footer);
            $information->footer = $footerPath;
        }


        $information->economic_code = $request->economic_code;
        $information->postal_code = $request->postal_code;
        $information->national_code = $request->national_code;
        $information->registration_number = $request->registration_number;
        $information->city_id = $request->city_id;
        $information->area = $request->area;
        $information->postal_box = $request->postal_box;
        $information->address = $request->address;
        $information->location = $request->location;
        $information->telephone = $request->telephone;
        $information->bank_id = $request->bank_id;
        $information->type = $request->type;
        $information->header_type = $request->header_type;
        $information->save();
        return redirect()->route('informations');
    }

    public function show($id) {

    }

    public function edit($id) {
        $title = __('information.edit');
        $single = Information::where('id', '=', $id)->first();
        $provinces = Province::all();
        $cities = City::all();
        $banks = Bank::all();
        return view('information.edit', compact('title', 'single', 'provinces', 'cities','banks'));
    }

    public function update(Request $request) {
       // dd($request->all());
        $information = Information::where('id', '=', $request->id)->first();
        $information->name = $request->name;

        if (!is_null($request->logo)) {
            $logoPath = $this->uploader->upload($request->logo);
            $information->logo = $logoPath;
        }
        if (!is_null($request->sign)) {
            $signPath = $this->uploader->upload($request->sign);
            $information->sign = $signPath;
        }

        if ($request->header) {
            $headerPath = $this->uploader->upload($request->header);
            $information->header = $headerPath;
        }

        if ($request->footer) {
            $footerPath = $this->uploader->upload($request->footer);
            $information->footer = $footerPath;
        }

        if (isset($request->is_delete_header) && $request->is_delete_header == 'on') {
            $information->header = null;
        }


        if (isset($request->is_delete_sign) && $request->is_delete_sign == 'on') {
            $information->sign = null;
        }

        $information->economic_code = $request->economic_code;
        $information->postal_code = $request->postal_code;
        $information->national_code = $request->national_code;
        $information->registration_number = $request->registration_number;
        $information->city_id = $request->city_id;
        $information->area = $request->area;
        $information->postal_box = $request->postal_box;
        $information->address = $request->address;
        $information->location = $request->location;
        $information->telephone = $request->telephone;
        $information->bank_id = $request->bank_id;
        $information->type = $request->type;
        $information->header_type = $request->header_type;
        $information->save();
        return redirect()->route('informations');
    }

    public function destroy($id) {
        $information = Information::where('id', '=', $id)->first();
        $information->delete();
        return redirect()->route('informations');
    }
}
