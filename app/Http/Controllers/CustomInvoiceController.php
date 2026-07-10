<?php

namespace App\Http\Controllers;

use App\Models\CustomInvoice;
use App\Models\Description;
use App\Models\FireExtinguisherPart;
use App\Models\Information;
use App\Models\Preinvoice;
use App\Models\Product;
use App\Models\Transport;
use App\Models\UserRequest;
use App\Services\Invoice\PreInvoiceStore;
use App\Services\Pdf\CreatePdf;
use App\Services\uploader\Uploader;
use Illuminate\Http\Request;

class CustomInvoiceController extends Controller {

    private $uploader;

    public function __construct(Uploader $uploader) {
        parent::__construct();
        $this->uploader = $uploader;
    }

    public function create_preinvoice($preinvoice_id) {
        $requests = UserRequest::with('admin', 'user', 'service')->get();
        $preinvoice = Preinvoice::with('items', 'descriptions', 'workshop')->where('id', '=', $preinvoice_id)->firstOrFail();
        $single = CustomInvoice::where('preinvoice_id', $preinvoice->id)->first();
        $title = "پیش فاکتور " . $preinvoice->code;
        $informations = Information::where('type', 0)->get();
        $code = PreInvoiceStore::generate_preinvoice_code($preinvoice->request->id);

        return view('custom_invoice.create_preinvoice', compact(
            'title',
            'preinvoice',
            'single',
            'requests',
            'informations',
            'code',
        ));

    }

    public function store_preinvoice(Request $request) {
        $preinvoice = Preinvoice::with('items', 'request')->where('id', $request->id)->firstOrFail();
        $single = CustomInvoice::where('preinvoice_id', $preinvoice->id)->firstOrCreate();
        $single->preinvoice_id = $preinvoice->id;
        $single->title = $request->title;
        $single->description = $request->description;
        $single->type = $request->type;
        $single->increase_percent_per_item = $request->increase_percent_per_item;
        if ($request->header) {
            $headerPath = $this->uploader->upload($request->header);
            $single->header = $headerPath;
        }
        if (isset($request->is_delete_header) && $request->is_delete_header == 'on') {
            $single->header = null;
        }

        $single->save();

        CreatePdf::custom($preinvoice->id, 'پیش فاکتور');


    }


    public function create_invoice($preinvoice_id) {
        $requests = UserRequest::with('admin', 'user', 'service')->get();
        $preinvoice = Preinvoice::with('items', 'descriptions', 'workshop')->where('id', '=', $preinvoice_id)->firstOrFail();
        $single = CustomInvoice::where('preinvoice_id', $preinvoice->id)->first();
        $title = "فاکتور" . $preinvoice->code;
        $informations = Information::where('type', 1)->get();
        $code = PreInvoiceStore::generate_preinvoice_code($preinvoice->request->id);

        return view('custom_invoice.create_invoice', compact(
            'title',
            'preinvoice',
            'single',
            'requests',
            'informations',
            'code',
        ));

    }

    public function store_invoice(Request $request) {
        $preinvoice = Preinvoice::with('items', 'request')->where('id', $request->id)->firstOrFail();
        $single = CustomInvoice::where('preinvoice_id', $preinvoice->id)->firstOrCreate();
        $single->preinvoice_id = $preinvoice->id;
        $single->title = $request->title;
        $single->description = $request->description;
        $single->type = $request->type;
        $single->increase_percent_per_item = $request->increase_percent_per_item;
        if ($request->header) {
            $headerPath = $this->uploader->upload($request->header);
            $single->header = $headerPath;
        }
        if (isset($request->is_delete_header) && $request->is_delete_header == 'on') {
            $single->header = null;
        }

        $single->save();

        CreatePdf::custom($preinvoice->id, 'فاکتور');


    }
}
