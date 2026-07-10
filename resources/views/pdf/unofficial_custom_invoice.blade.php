<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap.min.css') }}>
    <title>پیش فاکتور | {{$full_name}}</title>
    <style>
        body {
            font-family: primary_font, sans-serif;
        }

        #container {
            width: 100%;
            height: 100%;
            padding: 10px 40px;
            background-position: 0% 0%;
            background-size: 100% 100%;
            background: url({{asset('/storage/'.$header)}}) no-repeat;
        }

        #title_container {
            text-align: center;
            padding-top: 100px !important;
        }

        #title {
            font-size: large;
            font-weight: bold;
        }

        #number_container {
            text-align: left !important;
            float: left;
            padding-bottom: 20px;
        }

        #information_container {
            border: 0.01em solid #000000;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            padding: 5px 10px;
        }

        #items_container {

        }

        table {
            margin-top: 20px;
            border-left: 0.01em solid #000000;
            border-right: 0.01em solid #000000;
            border-top: 0.01em solid #000000;
            border-bottom: 0.01em solid #000000;
            border-spacing: 0;
        }

        table tbody td,
        table th {
            border-left: 0.01em solid #000000;
            border-right: 0.01em solid #000000;
            border-top: 0.01em solid #000000;
            border-bottom: 0.01em solid #000000;
        }

        table tbody tr {
            border-right: 0.01em solid #000000;
            border-bottom: 0.01em solid #000000;
        }

        table tbody {
            border-right: 0.01em solid #000000;
            border-bottom: 0.01em solid #000000;
        }

        table thead tr {
            border-right: 0.01em solid #000000;
            border-bottom: 0.01em solid #000000;
        }


        table tfoot tr {
            border-bottom:  0.01em solid #000000!important;
            border-left: 0.01em solid #000000!important;
        }

        table tfoot {
            border-left: 0.01em solid #000000 !important;
            border-right: 0.01em solid #000000 !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important
        }
        .p-2 {
            padding: .5rem !important
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
        }

    </style>
</head>
<body>

<div id="container">
    <div id="title_container">
        <h1 id="title">پیش فاکتور</h1>
        <h5>{{$title}}</h5>
    </div>
    <div id="number_container">
        <div>
            <div><small> تاریخ : {{$created_at}}</small></div>
            <div><small> شماره : {{$code}}</small></div>
        </div>
    </div>
    <div id="information_container">
        <div>
            <span> <strong>نام مشتری :</strong> <small>{{$full_name}}</small></span>
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            <span> <strong>تلفن :</strong> <small>{{$telephone}}</small></span>
        </div>
        <div>
            <span> <strong>آدرس :</strong> <small>{{$address}}</small></span>
            {{--   &nbsp;&nbsp;
               &nbsp;&nbsp;
               <span>کد پستی: تهران،1967563214</span>--}}
        </div>

    </div>
    <div id="items_container" class="">
        <table class="table table-striped">
            <thead>
            <tr class="p-4">
                <th style="width: 40px;" class="text-center p-2">ردیف</th>
                <th class="text-center p-2">شرح کالا</th>
                <th class="text-center p-2">تعداد</th>
                <th class="text-center p-2">قیمت واحد
                    <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>
                </th>
                <th class="text-center p-2">قیمت کل
                    <small style="font-weight: normal"> (@lang('common.pricePrefix'))</small>

                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="font-weight-boldest font-size-small p-4">
                    <td style="width: 40px;" class="text-center p-2">{{$loop->iteration }}</td>
                    <td class="text-end p-2"><small>{{$item['title']}}</small></td>
                    <td class="text-center p-2"><small>{{$item['count']}}</small></td>
                    <td class="text-center p-2"><small>{{number_format($item['price'], 0, '.', ',')}}</small></td>
                    <td class="text-center p-2">
                        <small>{{number_format($item['count']*$item['price'], 0, '.', ',')}}</small></td>
                </tr>
            @endforeach


            </tbody>
            <tfoot>
            <tr class="">
                <td class="text-center p-2" colspan="3"><span
                        class="font-size-lg font-weight-bolder mb-1">جمع مبلغ کل :

                       <span style="font-size: 10px"> {{$stringTotalPrice??''}} @lang('common.pricePrefix')</span>

                    </span></td>
                <td class="text-center p-2"
                    colspan="2">{{number_format($totalPrice, 0, '.', ',')}} @lang('common.pricePrefix')</td>
            </tr>
            <tr class="">
                <td class="text-center p-2" colspan="3"><span
                        class="font-size-lg font-weight-bolder mb-1">مالیات : </span></td>
                <td class="text-center p-2" colspan="2">{{$tax}} درصد</td>
            </tr>
            <tr class="">
                <td class="text-center p-2" colspan="3"><span class="font-size-lg font-weight-bolder mb-1">مبلغ قابل پرداخت :

                        <span style="font-size: 10px">  {{$stringPaymentPrice??''}} @lang('common.pricePrefix')</span>
                        </span>
                </td>
                <td class="text-center p-2"
                    colspan="2">{{number_format($paymentPrice, 0, '.', ',')}} @lang('common.pricePrefix')</td>
            </tr>


            </tfoot>

        </table>

        <ul style="padding: 0;margin: 0;margin-right: 16px">
            <li style="font-size: 12px;" class="p-1 font-weight-bolder">{{$description??''}}</li>
        </ul>

    </div>
</div>


</body>
</html>
