<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\FireExtinguisherPart;
use App\Models\Information;
use App\Models\Preinvoice;
use App\Models\PreinvoiceDescription;
use App\Models\PreinvoiceItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transport;
use App\Models\UserRequest;
use App\Models\Workshop;
use App\Services\Invoice\DescriptionStore;
use App\Services\Invoice\PreInvoiceItemStore;
use App\Services\Invoice\PreInvoiceStore;
use App\Services\Invoice\TransportStore;
use App\Services\Invoice\WorkshopItemStore;
use App\Services\Invoice\WorkshopStore;
use App\Services\Notification\SystemNotifier;
use App\Services\Notification\SmsSender;
use App\Services\Pdf\CreatePdf;
use App\Services\uploader\Uploader;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PreinvoiceController extends Controller {

    private $uploader;

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }

    public function index() {
        $title = __('preinvoice.preinvoices');
        // باگ ۱: پیش‌فاکتورها به‌جای فاکتورها نمایش داده می‌شدند (is_invoice=true)
        $list = Preinvoice::query()->with('request')
            ->where('is_invoice', false)
            ->where('status', '!=', 'financial')
            ->whereHas('request')
            ->orderBy('id', 'asc')
            ->get();
        return view('preinvoice.list', compact('list', 'title'));
    }

    public function create() {
        $title = __('preinvoice.add');
        $requests = UserRequest::with('admin', 'user', 'service')->doesntHave('preinvoice')->get();
        $descriptions = Description::all();
        $informations = Information::where('type', 0)->get();
        $products = Product::all();
        return view('preinvoice.add', compact('title', 'requests', 'informations', 'descriptions', 'products'));
    }

    public function store(Request $request) {
        //dd($request->all());
        $single = PreInvoiceStore::store($request);

        PreInvoiceItemStore::store($request->products, $single);

        if ($request->status == 'transport') {
            TransportStore::store($single, $request);
        }

        DescriptionStore::store($request->group_descriptions, $single);

        /* if ($request->status == 'financial') {
             $this->change_to_invoice($single->id);
         }*/
        return redirect()->route('preinvoices')->with('status', 'با موفقیت ثبت شد');
    }

    public function show($id) {
        $itemList = [];
        $single = Preinvoice::with('items', 'workshop.items.fireExtinguisherPart', 'descriptions.description')->where('id', '=', $id)->firstOrFail();

        foreach ($single->items as $item) {
            $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $item->price, 'sum_price' => $item->count * $item->price,];
        }

        $workshopItems = $single->workshop->items ?? null;
        if (!is_null($workshopItems)) {
            foreach ($workshopItems as $item) {
                if (!is_null($item->fireExtinguisherPart)) {
                    $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $item->price, 'sum_price' => $item->count * $item->price,];
                }
            }
        }

        $totalPrice = collect($itemList)->sum('sum_price');
        $title = "پیش فاکتور " . $single->code;
        $paymentPrice = $totalPrice + ($totalPrice * $single->tax / 100);
        $descriptions = $single->descriptions;
        return view('preinvoice.single', compact('title', 'single', 'totalPrice', 'itemList', 'paymentPrice', 'descriptions'));
    }

    public function edit($id) {
        $requests = UserRequest::with('admin', 'user', 'service')->get();
        $single = Preinvoice::with('items', 'descriptions', 'workshop')->where('id', '=', $id)->firstOrFail();
        $title = "پیش فاکتور " . $single->code;
        $totalPrice = collect($single->items)->sum('totalPrice');
        $informations = Information::where('type', 0)->get();
        $descriptions = Description::all();
        $products = Product::all();
        $transport = Transport::where('preinvoice_id', '=', $id)->first();
        $code = PreInvoiceStore::generate_preinvoice_code($single->request->id);

        $fire_extinguisher_parts = FireExtinguisherPart::all();
        $workshop_id = null;
        $workshop_items = null;
        if (isset($single->workshop)) {
            $workshop_id = $single->workShop->id;
            $workshop_items = $single->workshop->items->toArray();

        }

        //dd($workshop_id);

        return view('preinvoice.edit', compact(
            'title',
            'single',
            'totalPrice',
            'requests',
            'informations',
            'descriptions',
            'code',
            'products',
            'transport',
            'fire_extinguisher_parts',
            'workshop_id',
            'workshop_items',
        ));

    }

    public function update(Request $request) {

        $single = PreInvoiceStore::update($request);

        PreInvoiceItemStore::store($request->products, $single);

        DescriptionStore::store($request->description_items, $single);

        if ($request->status == 'transport') {
            TransportStore::store($single, $request);
        }

        if (isset($request->workshop_items) && (!is_null($request->workshop_items[0]['count'])) && (isset($request->workshop_items[0]['fireExtinguisherPart_id']))) {
            $workshop = WorkshopStore::store($request->workshop_id, $single->id);
            WorkshopItemStore::store($request->workshop_items, $workshop);
        }

        /* if ($request->status == 'financial') {
             return redirect()->route('preinvoice.change_to_factor', $single->id);
         }*/

        return redirect()->route('preinvoices')->with('status', 'با موفقیت ویرایش شد');
    }

    public function destroy($id) {
        $single = Preinvoice::with('items')->where('id', '=', $id)->firstOrFail();
        $single->delete();
        return redirect()->route('preinvoices');
    }

    public function download_unofficial($id) {
        CreatePdf::unofficial($id, 'پیش فاکتور');
    }

    public function unofficialCustomGoodBoom($id) {
        CreatePdf::unofficialCustomGoodBoom($id, 'پیش فاکتور');
    }

    public function download_official($id) {
        CreatePdf::official($id, 'پیش فاکتور');
    }

    public function change_to_invoice($id) {
        $result = PreInvoiceStore::change_to_invoice($id);
        if (is_null($result)) {
            $single = Preinvoice::where('id', $id)->first();
            SmsSender::invoice_registered($single);
            $invoice_counter = (int)Setting::getValue('invoice_counter');
            Setting::setValue('invoice_counter', $invoice_counter + 1);
            $single->invoice_counter = $invoice_counter + 1;
            $single->save();

            $expertId = $single->request->expert_id ?? null;
            $customerName = $single->request->user->full_name ?? '';
            SystemNotifier::toAdmin(
                $expertId,
                'صدور فاکتور',
                "فاکتور مشتری {$customerName} صادر شد.",
                route('invoices')
            );

            return redirect()->route('invoices');
        } else {
            $title = __('preinvoice.discrepancy_items');
            $list = $result;
            return view('preinvoice.list_discremancy', compact('id', 'list', 'title'));
        }
    }

    public function create_charge_card($id) {
        $title = __('preinvoice.create_charge_card');
        return view('preinvoice.create_charge_card', compact('title', 'id'));
    }

    public function download_charge_card(Request $request) {

        $single = Preinvoice::with('request.user', 'items', 'workshop.items')->where('id', $request->id)->first();
        $date = $request->date;
        $weight = $request->weight;
        $type = $request->type;
        $data = [
            'title' => $single->title,
            'code' => $single->code,
            'date' => $date,
            'weight' => $weight,
            'type' => $type,
            'items' => $single->items,
            'full_name' => $single->request->user->full_name ?? '',
            'customer_code' => $single->request->user->customer_code ?? '',
            "name_padding_top" => Setting::getValue('name_padding_top'),
            "name_padding_right" => Setting::getValue('name_padding_right'),
            "customer_code_padding_top" => Setting::getValue('customer_code_padding_top'),
            "customer_code_padding_right" => Setting::getValue('customer_code_padding_right'),
            "date_padding_top" => Setting::getValue('date_padding_top'),
            "date_padding_right" => Setting::getValue('date_padding_right'),
            "weight_padding_top" => Setting::getValue('weight_padding_top'),
            "weight_padding_right" => Setting::getValue('weight_padding_right'),
            "type_padding_top" => Setting::getValue('type_padding_top'),
            "type_padding_right" => Setting::getValue('type_padding_right'),
        ];
        $pdf = PDF::loadView('pdf.charge_card', $data, [], [
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);
        $name = "کارت شارژ" . ($single->request->user->full_name ?? '') . ' به شماره ' . $single->code . '.pdf';
        return $pdf->stream($name);
    }

    public function send_to_financial($id) {
        $single = Preinvoice::where('id', $id)->first();
        $single->status = 'financial';
        $single->save();

        $customerName = $single->request->user->full_name ?? '';
        SystemNotifier::toRoles(
            ['financial manager', 'Chief Financial Officer', 'Accountants', 'Accounting assistant'],
            'پیش‌فاکتور در انتظار تایید',
            "پیش‌فاکتور مشتری {$customerName} منتظر تایید و تبدیل به فاکتور است.",
            route('invoice.pending')
        );

        return redirect()->route('preinvoices');
    }

}
