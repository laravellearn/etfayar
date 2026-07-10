<?php

namespace App\Http\Controllers;

use App\Models\FormItem;
use App\Models\OfficeForm;
use App\Models\OfficeRequest;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class OfficeRequestsController extends Controller {

    public function index() {
        $roles = auth('admin')->user()->roles->toArray();
        $collect_roles = collect($roles);
        $roles_id = $collect_roles->pluck('id');
        $str_roles_id = $roles_id->map(function ($item, $key) {
            return $item . '';
        })->toArray();

        //dump($str_roles_id);

        $forms = array();
        foreach ($str_roles_id as $item) {
            $officeForms = OfficeForm::query()->whereJsonContains('roles', $item)->get();
            if (!is_null($officeForms)) {
                foreach ($officeForms as $officeForm) {
                    if (!in_array($officeForm, $forms)) {
                        $forms[] = $officeForm;
                    }
                }
            }

        }

        $forms_ids = collect($forms)->flatten()->pluck('id')->toArray();
        $list = OfficeRequest::query()
            ->with('officeForm')
            ->whereIn('office_form_id', $forms_ids)
            //->where('status', '=', 'not_seen')
            ->orderByDesc('created_at')
            ->get();
        $title = __('office_request.title');
        return view('office_requests.list', compact('list', 'title'));
    }

    public function create() {
        $list = OfficeForm::with('items')->get();
        $title = __('office_request.create');
        return view('office_requests.forms', compact('list', 'title'));
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        $single = OfficeRequest::query()->find($id);
        $decode_data = Json::decode($single->data_json, JSON_OBJECT_AS_ARRAY);
        $data = array();
        foreach ($decode_data as $key => $value) {
            $formItem = FormItem::query()->where('name', '=', $key)->first();
            if (!is_null($formItem)) {
                $item = new \stdClass();
                $item->label = $formItem->label;
                $item->value = $value;
                $data[] = $item;
            }

            if (str_contains($key, 'attachment_path')) {
                $item = new \stdClass();
                $item->label = 'فایل پیوست';
                $value_link = asset('/storage/' . $value);
                $item->value = "<a class='btn btn-primary' target='_blank' href='{$value_link}'>مشاهده فایل</a>";
                $data[] = $item;
            }

            if (str_contains($key, 'attachments_path')) {
                foreach ($value as $file) {
                    $item = new \stdClass();
                    $item->label = 'فایل پیوست';
                    $value_link = asset('/storage/' . $file);
                    $item->value = "<a class='btn btn-primary' target='_blank' href='{$value_link}'>مشاهده فایل</a>";
                    $data[] = $item;
                }

            }


        }
        $title = $single->officeForm->title;
        return view('office_requests.show', compact('title', 'single', 'data'));
    }

    public function edit($id) {
        $single = OfficeRequest::query()->find($id);
        $decode_data = Json::decode($single->data_json, JSON_OBJECT_AS_ARRAY);
        //dump($decode_data);
        $data = array();
        foreach ($decode_data as $key => $value) {
            $formItem = FormItem::query()->where('name', '=', $key)->first();
            if (!is_null($formItem)) {
                $item = new \stdClass();
                $item->label = $formItem->label;
                $item->value = $value;
                $data[] = $item;
            }

            if (str_contains($key, 'attachment_path')) {
                $item = new \stdClass();
                $item->label = 'فایل پیوست';
                $value_link = asset('/storage/' . $value);
                $item->value = "<a class='btn btn-primary' target='_blank' href='{$value_link}'>مشاهده فایل</a>";
                $data[] = $item;
            }

            if (str_contains($key, 'attachments_path')) {
                foreach ($value as $file) {
                    $item = new \stdClass();
                    $item->label = 'فایل پیوست';
                    $value_link = asset('/storage/' . $file);
                    $item->value = "<a class='btn btn-primary' target='_blank' href='{$value_link}'>مشاهده فایل</a>";
                    $data[] = $item;
                }

            }


        }
        //dd($data);
        //dd($single);
        $title = __('office_request.edit');
        return view('office_requests.edit', compact('title', 'single', 'data'));
    }

    public function update(Request $request, OfficeRequest $officeRequest) {
        $single = OfficeRequest::query()->find($request->id);
        $single->status = $request->status;
        $single->recipient_id = auth('admin')->id();
        $single->save();
        return redirect()->route('office_requests');
    }

    public function destroy($id) {
        $single = OfficeRequest::query()->find($id);
        $single->delete();
        return redirect()->route('my_office_requests');
    }

    public function my_office_requests() {
        $admin_id = auth('admin')->id();
        $list = OfficeRequest::query()
            ->with('officeForm')
            ->where('applicant_id', $admin_id)
            //->where('status', '=', 'not_seen')
            ->get();
        $title = __('office_request.my_requests');
        return view('office_requests.my_requests', compact('list', 'title'));
    }


}
