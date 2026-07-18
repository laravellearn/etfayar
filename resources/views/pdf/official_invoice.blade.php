<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap.min.css') }}>
    <title>فاکتور | {{$full_name}}</title>
    <style>
        body {
            font-family: primary_font, sans-serif;
        }

        #container {
            width: 100%;
            height: 100%;
            padding: 5px 20px;
        }

        #title_container {

            text-align: center;
            padding-top: 10px !important;
        }

        #title {
            display: inline-block;
            font-size: large;
            font-weight: bold;
        }

        #number_container {
            position: absolute;
            overflow: visible;
            left: 0;
            clear: both;
            text-align: right;
            float: left;
            width: 200px; /* you must specify a width */
            margin-left: auto;
        }

        #seller_title_container {
            text-align: center;
            padding: 3px;
            font-weight: bold;
            background-color: #FDE9D9;
        }

        #information_container {
            border: 0.1em solid #000;
            padding: 3px 10px;
        }

        #buyer_title_container {
            text-align: center;
            padding: 2px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 10px;
            background-color: #FDE9D9;
        }

        #items_title_container {
            text-align: center;
            padding: 2px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 14px;
            background-color: #FDE9D9;
        }

        table {
            border-left: 0.01em solid #ccc;
            border-right: 0.01em solid #ccc;
            border-top: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
            border-spacing: 0;
        }

        table tbody td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }

        table tbody tr {
            border-right: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
        }

        table tbody {
            border-right: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
        }

        table thead tr {
            border-right: 0.01em solid #ccc;
            border-bottom: 0.01em solid #ccc;
        }


        table tfoot tr {
            border-bottom: none !important;
            border-left: 0.01em solid #ccc;
        }

        table tfoot {
            border-left: 0.01em solid #ccc !important;
            border-right: 0.01em solid #ccc !important;
        }

        .p-2 {
            padding: .25rem !important
        }

        .p-1 {
            padding: .25rem !important
        }

        table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6
        }


    </style>
</head>
<body>

<div style="text-align: center!important;" id="container">
    <span style="position: absolute" id="title_container">
        <div style="display: inline-block;float: left" id="number_container">
            <div>
                <div>
                    <small> <strong>شماره سریال:</strong>
                         &nbsp;&nbsp;
                        {{$invoice_counter}}-{{$code}}
                    </small>
                </div>
                <div><small> <strong>تاریخ :</strong>
                         &nbsp;&nbsp;
                         &nbsp;&nbsp;
                         &nbsp;&nbsp;
                         &nbsp;&nbsp;
                        {{$created_at}}
                    </small>
                </div>
            </div>
        </div>
    </span>
    <div
        style="display: inline-block;position:static;right:100px;text-align: center;width: 200px!important;margin: auto auto!important;"
        id="title">صورت حساب فروش کالا و خدمات
    </div>
    <br>
    <div>
        <div id="seller_title_container">مشخصات فروشنده</div>
        <div id="information_container">
            <div>
                <span> <strong>نام شخص حقیقی / حقوقی :</strong> <small>{{$seller_name??''}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>کد اقتصادی :</strong> <small>{{$seller_economic_code??''}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>کد پستی 10 رقمی :</strong> <small>{{$seller_postal_code??''}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>شناسه ملی :</strong> <small>{{$seller_national_code??''}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>شماره ثبت :</strong> <small>{{$seller_registration_number??''}}</small></span>


            </div>
            <div>
                <span> <strong>نشانی :</strong> <small>{{$address_atfa??''}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>تلفن / نمابر :</strong> <small>
                    {{ $telephone_atfa }}
                </small></span>
            </div>

        </div>
    </div>
    <div>
        <div id="buyer_title_container">مشخصات خریدار</div>
        <div id="information_container">
            <div>
                <span> <strong>نام شخص حقیقی / حقوقی :</strong> <small>{{$full_name}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>کد اقتصادی :</strong> <small>{{$user->economic_code}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>شناسه ملی :</strong> <small>{{$user->national_code}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
            </div>
            <div>
                <span> <strong>نشانی :</strong> <small>استان {{$province??''}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>شهرستان :</strong> <small>{{$city}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>کد پستی 10 رقمی :</strong> <small>{{$postal_code}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>شماره ثبت :</strong> <small>{{$registration_number}}</small></span>
            </div>
            <div>
                <span> <strong>نشانی :</strong> <small>{{$address}}</small></span>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span> <strong>تلفن / نمابر :</strong> <small>{{$telephone}}</small></span>
            </div>
        </div>
    </div>

    <div>
        <div id="items_title_container">مشخصات کالا یا خدمات مورد معامله</div>
        <div id="items_container" class="">
            <table class="table table-striped">
                <thead>
                <tr style="padding: 0;">
                    <th style="width: 20px!important;font-size:10px;font-weight: normal;padding: 4px;"
                        class="text-center">ردیف
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;"
                        class="text-center">کد کالا
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center" nowrap>شرح
                        کالا یا خدمات
                    </th>
                    <th style="width: 40px;font-size:10px;font-weight: normal;padding: 4px;" class="text-center">
                        تعداد/مقدار
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center">مبلغ
                        واحد
                        <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center">مبلغ کل
                        <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center">مبلغ
                        تخفیف
                        <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center">مبلغ کل
                        پس از تخفیف
                        <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center">جمع
                        مالیات و عوارض
                        <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                    </th>
                    <th style="font-size:10px;font-weight: normal;padding: 4px;" class="text-center">جمع
                        مبلغ کل به اضافه مالیات و عوارض
                        <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                    </th>


                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr class="font-weight-boldest font-size-small p-4">
                        <td style="width: 20px!important;" class="text-center p-2">{{$loop->iteration }}</td>
                        <td style="" class="text-end p-1"><small></small></td>
                        <td nowrap class="text-end p-2"><strong
                                style="font-size:12px;font-weight: bold;">{{$item['title']}}</strong></td>
                        <td style="text-align: center;font-size:12px;">{{$item['count']}}</td>
                        <td class="text-center p-1"><small>{{number_format($item['price'], 0, '.', ',')}}</small></td>
                        <td class="text-center p-1"><small>{{number_format($item['sum_price'], 0, '.', ',')}}</small>
                        </td>
                        <td style="text-align: center">{{number_format($item['discount'], 0, '.', ',')}}</td>
                        <td style="text-align: center;font-size:12px;">{{number_format($item['sum_price_with_discount'], 0, '.', ',')}}</td>
                        <td style="text-align: center">{{number_format($item['tax_price'], 0, '.', ',')}}</td>
                        <td style="text-align: center">{{number_format($item['sum_price_with_tax'], 0, '.', ',')}}</td>
                    </tr>
                @endforeach
                <tr class="font-weight-boldest font-size-small p-4">
                    <td colspan="5" class="p-2">
                        <strong>جمع کل :</strong>
                        <span style="font-size: 12px">  {{$stringPaymentPrice??''}} @lang('common.pricePrefix')</span>
                        {{-- <span>{{number_format($paymentPrice, 0, '.', ',')}} @lang('common.pricePrefix')</span>--}}
                    </td>
                    <td style="padding-top:5px;text-align: center;font-size:12px;"><strong>{{number_format($totalPrice, 0, '.', ',')}}</strong></td>
                    <td style="padding-top:5px;text-align: center;font-size:12px;"><strong>0</strong></td>
                    <td style="padding-top:5px;text-align: center;font-size:12px;"><strong>{{number_format($totalPrice, 0, '.', ',')}}</strong></td>
                    <td style="padding-top:5px;text-align: center;font-size:12px;"><strong>{{number_format($total_tax_price, 0, '.', ',')}}</strong></td>
                    <td style="padding-top:5px;text-align: center;font-size:12px;"><strong>{{number_format($total_sum_price_with_tax, 0, '.', ',')}}</strong></td>
                </tr>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10" style="padding-right: 10px;font-weight: bold;" class="text-center pr-1">
                        <span class="font-weight-bolder">شرایط و نحوه فروش :</span>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <span style="font-weight: normal;" class="font-weight-light">نقدی</span>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <span style="font-weight: normal;" class="font-weight-light">غیرنقدی</span>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        <span style="font-weight: bold;" class="font-weight-bolder">توضیحات :</span>
                    </td>
                </tr>
                <tr class="">
                    <td style="font-size: 12px;padding: 5px 10px;font-weight: bold;"
                        class="text-center p-1 font-size-small"
                        colspan="10">
                        حساب شرکت :
                        {{$bank_name??''}} ، &nbsp;
                        شماره حساب :
                        <span style="color: red;font-weight: normal">{{$bank_account??''}}</span> ، &nbsp;
                        شماره شبا :
                        <span style="color: red;font-weight: normal">{{$bank_sheba??''}}</span> ، &nbsp;
                        شماره کارت :
                        <span style="color: red;font-weight: normal">{{$bank_cart_code??''}}</span>


                    </td>
                </tr>

                </tfoot>

            </table>

            <div style="width: 100%;">
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span style="display:inline-block;width: 200px;">
                    مهر و امضاء فروشنده
&nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <span style="display:inline-block;width: 200px;">
                    مهر و امضاء خریدار

                </span>

                </span>
            </div>


        </div>
    </div>


</div>


</body>
</html>
