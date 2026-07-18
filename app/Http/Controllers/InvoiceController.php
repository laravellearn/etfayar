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
use App\Services\Invoice\DescriptionStore;
use App\Services\Invoice\InvoiceItemStore;
use App\Services\Invoice\InvoiceStore;
use App\Services\Invoice\PreInvoiceItemStore;
use App\Services\Invoice\PreInvoiceStore;
use App\Services\Invoice\TransportStore;
use App\Services\Invoice\WorkshopItemStore;
use App\Services\Invoice\WorkshopStore;
use App\Services\Pdf\CreatePdf;
use App\Services\uploader\Uploader;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller {

    private $uploader;

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }

    public function index() {
        $title = __('invoice.invoices');
        $list = Preinvoice::query()
            ->where('is_invoice', '=', true)
            ->whereHas('request')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        return view('invoice.list', compact('list', 'title'));
    }

    public function pending() {
        $title = __('invoice.pending');
        $list = Preinvoice::query()
            ->where('is_invoice', false)
            ->where('status', 'financial')
            ->whereHas('request')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        return view('invoice.list_pending', compact('list', 'title'));
    }

    public function edit($id) {
        $requests = UserRequest::with('admin', 'user', 'service')->get();
        $single = Preinvoice::with('items', 'descriptions')->where('id', '=', $id)->firstOrFail();
        $title = " فاکتور " . $single->code;
        $totalPrice = collect($single->items)->sum('totalPrice');
        $informations = Information::where('type', 1)->get();
        $descriptions = Description::all();
        $products = Product::all();
        $transport = Transport::where('preinvoice_id', '=', $id)->first();
        $code = InvoiceStore::generate_invoice_code($single->request->id);
        $fire_extinguisher_parts = FireExtinguisherPart::all();
        $workshop_id = null;
        $workshop_items = null;
        if (isset($single->workshop)) {
            $workshop_id = $single->workShop->id;
            $workshop_items = $single->workshop->items->toArray();

        }

        return view('invoice.edit', compact(
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
            'workshop_items',));

    }

    public function update(Request $request) {

        $single = InvoiceStore::store($request);

        InvoiceItemStore::store($request->products, $single);

        DescriptionStore::store($request->group_descriptions, $single);

        if ($request->status == 'transport') {
            TransportStore::store($single, $request);
        }

        if (isset($request->workshop_items) && (!is_null($request->workshop_items[0]['count'])) && (isset($request->workshop_items[0]['fireExtinguisherPart_id']))) {
            $workshop = WorkshopStore::store($request->workshop_id, $single->id);
            WorkshopItemStore::store($request->workshop_items, $workshop);
        }

        return redirect()->route('invoices');
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
        $title = " فاکتور " . $single->code;
        $paymentPrice = $totalPrice + ($totalPrice * $single->tax / 100);
        $descriptions = $single->descriptions;
        return view('invoice.single', compact('title', 'single', 'totalPrice', 'itemList', 'paymentPrice', 'descriptions'));
    }

    public function download_unofficial($id) {
        CreatePdf::unofficial($id, 'فاکتور');
    }

    public function download_unofficial_custom($id) {
        CreatePdf::unofficialCustomGoodBoom($id, 'فاکتور');
    }

    public function download_official($id) {
        CreatePdf::official($id, 'فاکتور');
    }

    public function destroy($id) {
        $single = Preinvoice::with('items')->where('id', '=', $id)->firstOrFail();
        $single->delete();
        return redirect()->route('invoices');
    }

    public function create_charge_card($id) {
        $title = __('invoice.create_charge_card');
        $list = Setting::query()->where('type', 'charge_card')->get();
        return view('invoice.create_charge_card', compact('title', 'id', 'list'));
    }

    public function download_charge_card(Request $request) {
        //dd($request->all());
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


}
