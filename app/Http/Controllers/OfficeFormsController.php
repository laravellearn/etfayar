<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\OfficeForm;
use App\Models\OfficeRequest;
use App\Models\Role;
use App\Services\uploader\Uploader;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class OfficeFormsController extends Controller {


    private $uploader;


    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }


    public function index() {
        $list = OfficeForm::with('items')->get();
        $title = __('form.title');
        return view('form.list', compact('list', 'title'));

    }

    public function create($id) {
        $admins = Admin::with('roles')->get();
        $single = OfficeForm::with('items')->where('id', '=', $id)->first();
        $items = $single->items;
        $roles = Role::all();
        //dd($roles);
        $title = __('form.title');
        return view('form.add', compact('admins', 'single', 'items', 'title'));
    }

    public function store(Request $request) {
        //dd($request->except(['attachment','attachments']));
        $request['applicant_id'] = auth('admin')->id();
        if ($request->attachment) {
            $request['attachment_path'] = $this->uploader->upload($request->attachment);
        }

        if ($request->attachments) {
            $request['attachments_path'] = $this->uploader->uploads($request->attachments);
        }
        //dd($request->all(), $request->files);


        //unset($request['attachment']);
        //dd($request->all());

        //$data = new \stdClass();
        //$data->form_title = $request->form_title;
        //$data->office_form_id = $request->office_form_id;
        //$data->form_id = $request->form_id;
        //$data->price = $request->price;
        //$data->price_text = $request->price_text;
        //$data->pay_to = $request->pay_to;
        //$data->about = $request->about;
        //$data->cart_number = $request->cart_number;
        //$data->account_number = $request->account_number;
        //$data->number = $request->number;
        //$data->applicant_id = $request->applicant_id;
        //$data->attachment = $request->attachment_path;

        $officeRequest = new OfficeRequest();
        $officeRequest->office_form_id = $request->form_id;
        $officeRequest->applicant_id = $request->applicant_id;
        $officeRequest->recipient_id = null;
        $officeRequest->data_json = Json::encode($request->except(['attachment', 'attachments']));
        $officeRequest->data_text = serialize($request->except(['attachment', 'attachments']));
        $officeRequest->number = $this->max_number();
        $officeRequest->status = 'not_seen';
        $officeRequest->save();
        return redirect()->route('my_office_requests');
    }

    private function max_number() {
        $number = OfficeRequest::query()->max('number');
        return $number + 1;
    }

    public function admins($form_id) {
        $single = OfficeForm::where('id', '=', $form_id)->first();
        $roles = Role::all();
        $title = __('form.admins_received_request');
        return view('form.admins', compact('single', 'roles', 'form_id', 'title'));
    }

    public function update_admins(Request $request) {
        $officeForm = OfficeForm::where('id', '=', $request->form_id)->first();
        $roles = Json::encode($request->roles);
        if ($roles == 'null') {
            $officeForm->roles = null;
            $officeForm->save();
        } else {
            $officeForm->roles = Json::encode($request->roles);
            $officeForm->save();
        }
        return redirect()->route('forms');
    }


    public function show(OfficeForm $officeForm) {
        //
    }

    public function edit(OfficeForm $officeForm) {
        //
    }

    public function update(Request $request, OfficeForm $officeForm) {
        //
    }

    public function destroy(OfficeForm $officeForm) {
        //
    }
}
