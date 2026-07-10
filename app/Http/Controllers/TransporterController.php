<?php

namespace App\Http\Controllers;

use App\Models\Preinvoice;
use App\Models\Role;
use App\Models\Transport;
use App\Models\UserRequest;
use App\Models\Workshop;
use App\Services\uploader\Uploader;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;

class TransporterController extends Controller {

    private $uploader;

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }

    public function index() {

        $collect_list = Transport::query()
            ->where('collect_driver_id', '=', null)
            //->where('is_fiduciary', '=', true)
            ->whereHas('preinvoice', function ($q) {
                $q->where('is_invoice', '=', false);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $delivery_list = Transport::query()
            ->with('preinvoice')
            ->where('delivery_driver_id', '=', null)
            ->whereHas('preinvoice', function ($q) {
                $q->where('is_invoice', '=', true);
            })
            ->orderBy('created_at', 'desc')
            ->get();


        $title = __('transport.duty_transport_officer');
        return view('transport.list', compact('collect_list', 'delivery_list', 'title'));
    }

    public function done_duty() {
        $collect_list = Transport::query()
            ->where('collect_driver_id', '!=', null)
            ->orderBy('created_at', 'desc')
            ->get();

        $delivery_list = Transport::query()
            ->with('preinvoice')
            ->where('delivery_driver_id', '!=', null)
            ->orderBy('created_at', 'desc')
            ->get();


        $title = __('transport.done_duty_transport_officer');
        return view('transport.done_duty_transport_officer', compact('collect_list', 'delivery_list', 'title'));
    }


    public function edit($id) {
        $single = Transport::with('preinvoice')->find($id);
        //dd($single);
        //$single = Preinvoice::with('items')->where('id', '=', $id)->first();
        $title = "ترابری فاکتور " . $single->preinvoice->code . ' ' . $single->preinvoice->title;
        $totalPrice = collect($single->preinvoice->items)->sum('totalPrice');
        $drivers = Role::query()->with('admins')->where('title', '=', 'Driver')->firstOrFail()->admins;
        return view('transport.edit', compact('title', 'single', 'totalPrice', 'drivers'));

    }

    public function show($id) {
        $single = Transport::with('preinvoice')->find($id);
        $title = "ترابری فاکتور " . $single->preinvoice->code . ' ' . $single->preinvoice->title;
        $totalPrice = collect($single->preinvoice->items)->sum('totalPrice');
        $drivers = Role::query()->with('admins')->where('title', '=', 'Driver')->firstOrFail()->admins;
        return view('transport.show', compact('title', 'single', 'totalPrice', 'drivers'));
    }

    public function show_for_driver($id) {
        $single = Transport::with('preinvoice')->find($id);
        $title = "ترابری فاکتور " . $single->preinvoice->code . ' ' . $single->preinvoice->title;
        $totalPrice = collect($single->preinvoice->items)->sum('totalPrice');
        $drivers = Role::query()->with('admins')->where('title', '=', 'Driver')->firstOrFail()->admins;
        return view('transport.show_for_driver', compact('title', 'single', 'totalPrice', 'drivers'));
    }

    public function update(Request $request) {
        //dd($request->all());
        $single = Transport::find($request->id);
        $single->status = $request->status;

        if ($request->status == 'collect') {
            $single->collect_driver_id = $request->collect_driver_id;
            $single->collect_status = 'pending_collect';
        }

        if ($request->status == 'delivery') {
            $single->delivery_driver_id = $request->delivery_driver_id;
            $single->delivery_status = 'pending_delivery';
        }

        $single->save();
        return redirect()->route('transports');
    }

    public function driversTasks() {
        $expert_id = auth('admin')->user()->id;
        $collect_list = Transport::query()
            ->where('collect_driver_id', '=', $expert_id)
            ->where('collect_time', '=', null)
            ->where('is_deposit',0)
            ->orderBy('created_at', 'desc')
            ->get();

        $delivery_list = Transport::query()
            ->where('delivery_driver_id', '=', $expert_id)
            ->where('delivery_time', '=', null)
            ->where('is_deposit',0)
            ->orderBy('created_at', 'desc')
            ->get();

        $title = __('transport.drivers_tasks');
        return view('transport.drivers_tasks', compact('collect_list', 'delivery_list', 'title'));
    }

    public function driverDoneTasks() {
        $expert_id = auth('admin')->user()->id;
        $collect_list = Transport::query()
            ->where('collect_driver_id', '=', $expert_id)
            ->where('collect_time', '!=', null)
            ->orderBy('created_at', 'desc')
            ->get();

        $delivery_list = Transport::query()
            ->where('delivery_driver_id', '=', $expert_id)
            ->where('delivery_time', '!=', true)
            ->orderBy('created_at', 'desc')
            ->get();
        $title = __('transport.driver_done_tasks');
        return view('transport.driver_done_tasks', compact('collect_list', 'delivery_list', 'title'));
    }

    public function driversTaskInfo($id) {
        $single = Transport::query()->where('id', '=', $id)->first();
        $title = "مشاهده اطلاعات در خواست " . ($single->preinvoice->request->user->full_name ?? '');
        return view('transport.show_driver_task_info', compact('title', 'single'));
    }

    public function uploadChargeReceipts($id) {
        $single = Transport::query()->where('id', '=', $id)->first();
        $title = " بارگزاری رسید شارژ " . $single->preinvoice->request->user->full_name;
        return view('transport.upload_charge_receipts', compact('title', 'single'));
    }

    public function updateChargeReceipts(Request $request) {

        $single = Transport::query()->where('id', '=', $request->id)->first();

        $single->collect_description = $request->collect_description;

        if (isset($request->is_cancel) && $request->is_cancel == 'on') {
            $single->cancel_time = Carbon::now()->toDateTimeString();
        } else {
            if (!is_null($request->charge_receipt_file)) {
                $imagePath = $this->uploader->upload($request->charge_receipt_file);
                $single->charge_receipt_file = $imagePath;

                //$single->preinvoice->transport_status = 'uploadedChargeReceipt';
                //$single->preinvoice->save();
                $workshop = Workshop::query()->where('preinvoice_id', '=', $single->preinvoice_id)->firstOrCreate();
                $workshop->preinvoice_id = $single->preinvoice_id;
                $workshop->save();


            }
            $single->cancel_time = null;
            $single->collect_time = Carbon::now()->toDateTimeString();
        }

        $single->save();
        return redirect()->route('transport.driversTasks');
    }

    /*    public function viewCustomerRequest($id) {
            $single = UserRequest::with('admin', 'user', 'service')->where('id', '=', $id)->firstOrFail();
            $title = "مشاهده اطلاعات در خواست " . ($single->user->full_name ?? '');
            return view('transporter.view_customer_request', compact('title', 'single'));
        }*/

    /*    private function convertJalaliToGergorian($visit_date) {
            $v = Verta::parse($visit_date);
            return $v->formatGregorian('Y-m-d');
        }*/


    public function set_collector_status($id) {
        $single = Transport::where('id', '=', $id)->first();
        $title = "تنظیم وضعیت جمع آوری کننده";
        $drivers = Role::query()->with('admins')->where('title', '=', 'Driver')->firstOrFail()->admins;
        return view('transport.set_collector_status', compact('title', 'single', 'drivers'));

    }

    public function update_collector_status(Request $request) {
        $transport = Transport::query()->where('id', '=', $request->id)->first();
        $transport->collect_driver_id = $request->collect_driver_id;
        $transport->save();
        return redirect()->route('transports');
    }

    public function set_delivery_status($id) {
        $single = Transport::where('id', '=', $id)->first();
        $title = "تنظیم وضعیت تحویل دهنده";
        $drivers = Role::query()->with('admins')->where('title', '=', 'Driver')->firstOrFail()->admins;
        return view('transport.set_deliver_status', compact('title', 'single', 'drivers'));

    }

    public function update_delivery_status(Request $request) {
        $transport = Transport::query()->where('id', '=', $request->id)->first();
        $transport->delivery_driver_id = $request->delivery_driver_id;
        $transport->save();
        return redirect()->route('transports');
    }

    public function done_task($id) {
        $single = Transport::query()->where('id', '=', $id)->first();
        $title = " اتمام وظیفه تحویل به " . $single->preinvoice->request->user->full_name;
        return view('transport.done_task', compact('title', 'single'));
    }

    public function update_done_task(Request $request) {
        $single = Transport::query()->where('id', '=', $request->id)->first();
        if (isset($request->is_done) && $request->is_done == 'on') {
            $single->delivery_description = $request->delivery_description;
            $single->delivery_time = Carbon::now()->toDateTimeString();
            $single->save();
        }
        return redirect()->route('transport.driversTasks');
    }


}
