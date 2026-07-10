<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\FireExtinguisherPart;
use App\Models\Insurance;
use App\Models\MessageReport;
use App\Models\OfficeForm;
use App\Models\OfficeRequest;
use App\Models\Preinvoice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Transport;
use App\Models\User;
use App\Models\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller {

    public function index() {

        //dd(Setting::getValue('melipayamak_sms_number'));

        //Artisan::call("migrate:refresh --path=/database/migrations/2022_05_30_134817_create_insurances_table.php");
        //Artisan::call("migrate");
        /* $roles = auth('admin')->user()->roles->toArray();
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
        $officeRequests = OfficeRequest::query()
            ->whereIn('office_form_id', $forms_ids)
            ->where('status', '=', 'not_seen')
            ->get();*/
        //dump($officeRequests);
        //dd('finish');
        // dump($str_roles_id);
        //DB::enableQueryLog();


        //dd(DB::getQueryLog());
        //dd($officeForms);
        //dd($roles_id->pluck('id'));

        $title = __('title.dashboard');
        $admin_id = auth('admin')->id();

        $requestCount = UserRequest::query()->count();
        $preinvoiceCount = Preinvoice::query()->where('is_invoice', 0)->count();
        $userCount = User::query()->count();
        $serviceCount = Service::query()->count();
        $fireExtinguisherPartCount = FireExtinguisherPart::query()->count();
        $invoiceCount = Preinvoice::query()
            ->where('is_invoice', false)
            ->where('status', 'financial')
            ->whereHas('request')
            ->count();
        $transportCount = Transport::query()->count();
        $productCount = Product::query()->count();
        $insuranceCount = Insurance::query()->count();
        $myMessageCount = MessageReport::query()->where('admin_id', $admin_id)->orderByDesc('created_at')->count();
        $fireExtinguisherPartsCount = FireExtinguisherPart::query()->count();
        $preinvoice_list = Preinvoice::query()
            ->where('is_invoice', false)
            ->where('status', '!=', 'financial')
            ->whereHas('request')
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();

        $pending_list = Preinvoice::query()
            ->where('is_invoice', false)
            ->where('status', 'financial')
            ->whereHas('request')
            ->orderBy('created_at', 'desc')
            ->get();


        $today=Carbon::now()->format('Y-m-d');
//dd($today);
        return view('dashboard.dashboard', compact(
            'title',
            'requestCount',
            'preinvoiceCount',
            'userCount',
            'serviceCount',
            'fireExtinguisherPartCount',
            'invoiceCount',
            'transportCount',
            'productCount',
            'insuranceCount',
            'myMessageCount',
            'fireExtinguisherPartsCount',
            'today',
            'preinvoice_list',
            'pending_list',
        ));
    }

    public function requests() {
        $data = [];
        //$requests = UserRequest::query()->distinct()->get()->toArray();
        $requests = UserRequest::select('id', 'created_at')
            ->orderBy('created_at')
            ->get()
            ->groupBy(function ($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Verta(Carbon::parse($date->created_at))->format('F'); // grouping by months
            })->toArray();
        $data['keies'] = array_keys($requests);
        $values = [];
        foreach ($data['keies'] as $key) {
            $value = (count($requests[$key]));
            $values[] = $value;
        }
        $data['values'] = $values;
        return response($data);
    }

    public function test() {
        $expert_id = auth('admin')->user()->id;
        $list2 = Transport::query()
            //->where('upload_customer_charge_receipt', '=', null)
            ->where('is_done_task', '=', false)
            ->where(function ($query) {
                $query->where('status', '=', 'collect')
                    ->where('collect_status', '=', 'pending_collect');
            })
            ->OrWhere(function ($query) {
                $query->where('status', '=', 'delivery')
                    ->Where('delivery_status', '=', 'pending_delivery');
            })
            ->Where(function ($query) use ($expert_id) {
                $query->where('collect_driver_id', '=', $expert_id)
                    ->orWhere('delivery_driver_id', '=', $expert_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($list);
        $list = Transport::query()
            //->where('upload_customer_charge_receipt', '=', null)
            ->where('is_done_task', '=', false)
            ->where(function ($query) {
                $query->where('status', '=', 'collect')
                    ->where('collect_status', '=', 'pending_collect');
            })
            ->Where(function ($query) use ($expert_id) {
                $query->where('collect_driver_id', '=', $expert_id)
                    ->orWhere('delivery_driver_id', '=', $expert_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();


        $title = __('transporter.drivers_tasks');
        //return Excel::download(new UsersExport, 'users-collection.xlsx');
        return view('dashboard.test2', compact('list', 'title'));

    }

}
