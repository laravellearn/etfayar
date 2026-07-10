<?php

namespace App\Services\Pdf;

use App\Models\CustomInvoice;
use App\Models\Information;
use App\Models\Bank;
use App\Models\Preinvoice;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Number2Word;

class CreatePdf {

    public static function unofficial($id, $title) {
        $itemList = [];
        $single = Preinvoice::with('items', 'workshop.items.fireExtinguisherPart', 'descriptions.description', 'information')->where('id', '=', $id)->firstOrFail();

        foreach ($single->items as $item) {
            $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $item->price, 'sum_price' => $item->count * $item->price,];
        }

        $workshopItems = $single->workshop->items ?? null;
        if (!is_null($workshopItems)) {
            foreach ($workshopItems as $item) {
                $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $item->price, 'sum_price' => $item->count * $item->price,];
            }
        }

        $totalPrice = collect($itemList)->sum('sum_price');


        $tax = $single->tax;
        $data = [
            'title' => $single->title,
            'code' => $single->code,
            'created_at' => $single->persianDate,
            'full_name' => $single->request->user->full_name ?? '',
            'telephone' => $single->request->user->telephone ?? '',
            'address' => $single->request->user->address->toStringAddress ?? '',
            'items' => $itemList,
            'descriptions' => $single->descriptions,
            'description' => $single->description,
            'totalPrice' => $totalPrice,
            'tax' => $single->tax,
            'paymentPrice' => $totalPrice + ($totalPrice * $tax / 100),
            'sign' => $single->information->sign ?? null,
            'logo' => $single->information->logo ?? null,
            'header' => $single->information->header ?? null,
            'footer' => $single->information->footer ?? null,
        ];
        
        $pdf = PDF::loadView('pdf.unofficial_invoice', $data);
        $name = $title . ($single->request->user->full_name ?? '') . ' به شماره ' . $single->code . '.pdf';
        return $pdf->stream($name);


    }

    public static function official($id, $title) {
        $itemList = [];
        $single = Preinvoice::with('items.product', 'workshop.items.fireExtinguisherPart', 'descriptions.description', 'information')->where('id', '=', $id)->firstOrFail();

        foreach ($single->items as $item) {
            $itemList[] = [
                'title' => $item->title,
                'code' => $item->product->code ?? '',
                'count' => $item->count,
                'price' => $item->price,
                'sum_price' => $item->count * $item->price,
                'discount' => 0,
                'sum_price_with_discount' => $item->count * $item->price,
                'tax_price' => ($item->count * $item->price) * $single->tax / 100,
                'sum_price_with_tax' => ($item->count * $item->price) + (($item->count * $item->price) * $single->tax / 100),
            ];
        }


        $workshopItems = $single->workshop->items ?? null;
        if (!is_null($workshopItems)) {
            foreach ($workshopItems as $item) {
                $itemList[] = [
                    'title' => $item->title,
                    'code' => '',
                    'count' => $item->count,
                    'price' => $item->price,
                    'sum_price' => $item->count * $item->price,
                    'discount' => 0,
                    'sum_price_with_discount' => $item->count * $item->price,
                    'tax_price' => ($item->count * $item->price) * $single->tax / 100,
                    'sum_price_with_tax' => ($item->count * $item->price) + (($item->count * $item->price) * $single->tax / 100),
                ];
            }
        }

        $total_sum_price = collect($itemList)->sum('sum_price');

        $total_sum_price_with_discount = collect($itemList)->sum('sum_price_with_discount');
        $total_tax_price = collect($itemList)->sum('tax_price');
        $total_sum_price_with_tax = collect($itemList)->sum('sum_price_with_tax');

        $tax = $single->tax;


        //shuffle($itemList);
        require_once app_path() . '/Helpers/Number2Word.php';
        $number = new Number2Word();
        $payment_price = round($total_sum_price + ($total_sum_price * $tax / 100));
        
        $address_atfa = Information::where('id',9)->pluck('address');
        $telephone_atfa = Information::where('id',9)->pluck('telephone');

        $data = [
            'title' => $single->title,
            'code' => $single->code,
            'invoice_counter' => $single->invoice_counter,
            'created_at' => $single->persianDate,
            'user' => $single->request->user,
            'full_name' => $single->request->user->full_name ?? '',
            'telephone' => $single->request->user->telephone ?? '',
            'telephone_atfa' => $telephone_atfa[0],
            'address' => $single->request->user->address->toStringAddress ?? '',
            'address_atfa' => $address_atfa[0],
            'city' => $single->request->user->address->city->name ?? '',
            'province' => $single->request->user->address->city->province->name ?? '',
            'postal_code' => $single->request->user->address->postal_code ?? '',
            'registration_number' => $single->request->user->registration_number ?? '',
            'items' => $itemList,
            'descriptions' => $single->descriptions,
            'description' => $single->description,
            'totalPrice' => $total_sum_price,
            'stringTotalPrice' => $number->numberToWords(round($total_sum_price)),
            'total_sum_price_with_discount' => $total_sum_price_with_discount,
            'total_tax_price' => $total_tax_price,
            'total_sum_price_with_tax' => $total_sum_price_with_tax,
            'tax' => $single->tax,
            'paymentPrice' => $total_sum_price + ($total_sum_price * $tax / 100),
            'stringPaymentPrice' => $number->numberToWords($payment_price),
            'information' => $single->information ?? null,
            'sign' => $single->information->sign ?? null,
            'logo' => $single->information->logo ?? null,
            'header' => $single->information->header ?? null,
            'footer' => $single->information->footer ?? null,
        ];

        $pdf = PDF::loadView('pdf.official_invoice', $data, [], [
            'format' => 'A4',
            'orientation' => 'L',
        ]);
        $name = $title . ($single->request->user->full_name ?? '') . ' به شماره ' . $single->code . '.pdf';
        return $pdf->stream($name);


    }
    
    
        public static function unofficialCustomGoodBoom($id, $title) {
        $itemList = [];
        $single = Preinvoice::with('items', 'workshop.items.fireExtinguisherPart', 'descriptions.description', 'information')->where('id', '=', $id)->firstOrFail();

        foreach ($single->items as $item) {
            $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $item->price, 'sum_price' => $item->count * $item->price,];
        }

        $workshopItems = $single->workshop->items ?? null;
        if (!is_null($workshopItems)) {
            foreach ($workshopItems as $item) {
                $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $item->price, 'sum_price' => $item->count * $item->price,];
            }
        }

        $totalPrice = collect($itemList)->sum('sum_price');

        $bank = Bank::where('id', 4)->first();

        $tax = $single->tax;
        $data = [
            'title' => $single->title,
            'code' => $single->code,
            'created_at' => $single->persianDate,
            'full_name' => $single->request->user->full_name ?? '',
            'telephone' => $single->request->user->telephone ?? '',
            'address' => $single->request->user->address->toStringAddress ?? '',
            'items' => $itemList,
            'descriptions' => $single->descriptions,
            'description' => $single->description,
            'totalPrice' => $totalPrice,
            'tax' => $single->tax,
            'paymentPrice' => $totalPrice + ($totalPrice * $tax / 100),
            'sign' => $single->information->sign ?? null,
            'logo' => $single->information->logo ?? null,
            'header' => $single->information->header ?? null,
            'footer' => $single->information->footer ?? null,
            'bank_account_sheba' => $bank->sheba ?? '',   // <-- جدید
            'bank_account_owner'  => $bank->name ?? '',
            'bank_account_cart_code'  => $bank->cart_code ?? '',
            'bank_account_account'  => $bank->account ?? '',
        ];
        
        // $bank = Bank::where('id',4)->first();
        // dd($bank->name);

        $pdf = PDF::loadView('pdf.unofficial_invoice_custom', $data);
        $name = $title . ($single->request->user->full_name ?? '') . ' به شماره ' . $single->code . '.pdf';
        return $pdf->stream($name);


    }


    public static function custom($id, $title) {
        $itemList = [];
        $single = Preinvoice::with('items', 'workshop.items.fireExtinguisherPart', 'descriptions.description', 'information')->where('id', '=', $id)->firstOrFail();
        $customInvoice = CustomInvoice::where('preinvoice_id', $single->id)->first();

        foreach ($single->items as $item) {
            $increase_price = $item->price + (($item->price * $customInvoice->increase_percent_per_item) / 100);
            $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $increase_price, 'sum_price' => $item->count * $increase_price,];
        }

        $workshopItems = $single->workshop->items ?? null;
        if (!is_null($workshopItems)) {
            foreach ($workshopItems as $item) {
                $increase_price2 = $item->price + (($item->price * $customInvoice->increase_percent_per_item) / 100);
                $itemList[] = ['title' => $item->title, 'count' => $item->count, 'price' => $increase_price2, 'sum_price' => $item->count * $increase_price2,];
            }
        }

        $totalPrice = collect($itemList)->sum('sum_price');
        $tax = $single->tax;

        shuffle($itemList);
        require_once app_path() . '/Helpers/Number2Word.php';
        $number = new Number2Word();

        $payment_price = round($totalPrice + ($totalPrice * $tax / 100));

        $data = [
            'title' => $customInvoice->title,
            'code' => $single->code,
            'created_at' => $single->persianDate,
            'full_name' => $single->request->user->full_name ?? '',
            'telephone' => $single->request->user->telephone ?? '',
            'address' => $single->request->user->address->toStringAddress ?? '',
            'items' => $itemList,
            'descriptions' => $single->descriptions,
            'description' => $customInvoice->description,
            'totalPrice' => $totalPrice,
            'stringTotalPrice' => $number->numberToWords(round($totalPrice)),
            'tax' => $single->tax,
            'paymentPrice' => $totalPrice + ($totalPrice * $tax / 100),
            'stringPaymentPrice' => $number->numberToWords($payment_price),
            'sign' => $single->information->sign ?? null,
            'logo' => $single->information->logo ?? null,
            'header' => $customInvoice->header ?? null,
            'footer' => $single->information->footer ?? null,
        ];

        //dd($number->numberToWords($totalPrice));
        $view = $customInvoice->type == 2 ? 'pdf.unofficial_custom_invoice02' : 'pdf.unofficial_custom_invoice';
        $pdf = PDF::loadView($view,$data, [], [
            'format' => 'A4',
            'orientation' => 'P',
        ]);
        $name = $title . ($single->request->user->full_name ?? '') . ' به شماره ' . $single->code . '.pdf';
        return $pdf->stream($name);


    }
}
