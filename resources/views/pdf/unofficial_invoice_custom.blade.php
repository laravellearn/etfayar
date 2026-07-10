

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
            padding: 10px 20px;
            background-position: 0% 0%;
            background-size: 100% 100%;
            background: url({{asset('/storage/'.$header)}}) no-repeat;
        }

        #title_container {
            text-align: center;
            padding-top: 0px !important;
        }

        #title {
            font-size: large;
            font-weight: bold;
        }

        #number_container {
            text-align: right !important;
            float: right;
            padding-bottom: 0px;
        }

        #information_container {
            border: 0.03em solid #3f3f3f;
            /*border-top-left-radius: 20px;*/
            /*border-top-right-radius: 20px;*/
            padding: 5px 10px;
        }

        #items_container {

        }

        table {
            border-left: 0.03em solid #3f3f3f;
            border-right: 0.03em solid #3f3f3f;
            border-top: 0.03em solid #3f3f3f;
            border-bottom: 0.03em solid #3f3f3f;
            border-spacing: 0;
        }

        table tbody td,
        table th {
            border-left: 0;
            border-right: 0.03em solid #3f3f3f;
            border-top: 0;
            border-bottom: 0.03em solid #3f3f3f;
        }

        table tbody tr {
            border-right: 0.03em solid #3f3f3f;
            border-bottom: 0.03em solid #3f3f3f;
        }

        table tbody {
            border-right: 0.03em solid #3f3f3f;
            border-bottom: 0.03em solid #3f3f3f;
        }

        table thead tr {
            border-right: 0.03em solid #3f3f3f;
            border-bottom: 0.03em solid #3f3f3f;
        }


        table tfoot tr {
            border-bottom: none !important;
            border-left: 0.03em solid #3f3f3f;
        }

        table tfoot {
            border-left: 0.03em solid #3f3f3f !important;
            border-right: 0.03em solid #3f3f3f !important;
        }

        .mt-4 {
            margin-top: 0rem !important
        }
        .p-2 {
            padding: .2rem !important
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

<div id="container">
    <div id="title_container">
        <h1 id="title">فاکتور فروش</h1>
        <h5>{{$title}}</h5>
    </div>
    <div id="number_container">
        <div>
            <div><small> تاریخ : {{$created_at}}</small>
            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <small> شماره : {{$code}}</small></div>
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
                        class="font-size-lg font-weight-bolder mb-1">جمع مبلغ کل : </span></td>
                <td class="text-center p-2"
                    colspan="1">{{number_format($totalPrice, 0, '.', ',')}} @lang('common.pricePrefix')</td>
            </tr>
            </tfoot>

        </table>

        <ul style="padding: 0;margin: 0;margin-right: 16px">
            @foreach($descriptions as $desc)
                <li style="font-size: 8pt;margin: 0;padding: 0"><span>{{$desc->description->description}}</span></li>
            @endforeach
            <li class="p-1 font-weight-bolder">{{$description??''}}</li>

        </ul>

        @if(!is_null($sign))
            <img style="float: left; width: 0%;background-color: #ffffff;"
                 src="{{asset('storage/'.$sign)}}" alt="">
        @endif
    </div>
    @if(!is_null($sign))
    <img style="float: left; width: 0%;background-color: #ffffff;"
         src="{{asset('storage/'.$sign)}}" alt="">
@endif

<div id="bank_info_container" style="clear: both; margin-top: 0px; border-top: 0.01em dashed #ccc; padding-top: 1px;">
    <span><strong>به نام :</strong> <small>{{$bank_account_owner}}</small></span>
    &nbsp;&nbsp;
    <span><strong>شماره شبا :</strong> <small>{{$bank_account_sheba}}</small></span>
        &nbsp;&nbsp;
    <span><strong>شماره کارت :</strong> <small>{{$bank_account_cart_code}}</small></span>
            &nbsp;&nbsp;
    <span><strong>شماره حساب :</strong> <small>{{$bank_account_account}}</small></span>

</div>

    <div style="width: 100%;margin-top:10px">

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
                <span style="display:inline-block;width: 200px;">
                    مهر و امضاء خریدار

                </span>

                </span>
    </div>
</div>


</body>
</html>
