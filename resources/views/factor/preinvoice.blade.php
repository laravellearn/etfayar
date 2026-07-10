<html lang="fa" dir="rtl">
<head>
    {{--   <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}

    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap.min.css') }}>

    {{--<link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap-reboot.css') }}>
    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap.css') }}>
    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap-grid.css') }}>--}}

    <title>پیش فاکتور</title>
    <style>
        /** {
             border: red solid 1px!important;
        }*/

        body {
            font-family: primary_font, sans-serif;
            margin: 0!important;
            /*display: flex;
            flex-direction: column;
            justify-content: center;*/

        }

        .tac {
            text-align: center;
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

        .mt-4 {
            margin-top: 1.5rem !important
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

        /*  .table-bordered {
              border: 1px solid #ddd;
          }


          .table-bordered > :not(caption) > * {
              border-width: 1px 0
          }

          .table-bordered > :not(caption) > * > * {
              border-width: 0 1px
          }*/

        .p-0 {
            padding: 0 !important
        }

        .p-1 {
            padding: .25rem !important
        }

        .p-2 {
            padding: .5rem !important
        }

        .p-3 {
            padding: 1rem !important
        }

        .p-4 {
            padding: 1.5rem !important
        }

        .p-5 {
            padding: 3rem !important
        }

        .text-start {
            text-align: left !important
        }

        .text-end {
            text-align: right !important
        }

        .text-center {
            text-align: center !important
        }

        .m-auto {
            margin: auto !important;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }


        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>
<body>
<htmlpageheader name="page-header">
    @if(!is_null($header))
        <img style="width: 100%;background-color: #ffffff;margin-bottom: 10px;"
             src="{{asset('storage/'.$header)}}" alt="">
    @endif
</htmlpageheader>
<div style="height:80px;margin-top: 700px;">
    <div style="float:right; width: 33%;height:80px;background-color: #ffffff;text-align: center">
        @if(!is_null($logo))
            <img style="height: 75px;margin-bottom: 20px" class="img-fluid h-50 m-auto"
                 src="{{asset('storage/'.$logo)}}" alt="">
        @endif
    </div>
    <div class="col-md-3 " style="float:right; width: 33%;background-color: #fff;">
        <h1 style="font-size: large;font-weight: bold;" class="tac">پیش فاکتور</h1>
        <h5 class="tac m-auto">{{$title}}</h5>
    </div>

    <div class="tac" style="float: left; width: 33%; background-color: #ffffff;padding-top: 20px;">
        <div style="margin-right: 50px;" class="text-end"><small> تاریخ : {{$created_at}}</small></div>
        <div style="margin-right: 50px;" class="text-end"><small> شماره : {{$code}}</small></div>
    </div>

</div>

<div style="border:0.01em solid #ccc;border-radius: 2px;padding:8px;margin-top: 60px;">
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

<div class="mt-2">
    <div class="">
        <table class="table">
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
                    colspan="2">{{number_format($totalPrice, 0, '.', ',')}} @lang('common.pricePrefix')</td>
            </tr>
            <tr class="">
                <td class="text-center p-2" colspan="3"><span
                        class="font-size-lg font-weight-bolder mb-1">مالیات : </span></td>
                <td class="text-center p-2" colspan="2">{{$tax}} درصد</td>
            </tr>
            <tr class="">
                <td class="text-center p-2" colspan="3"><span class="font-size-lg font-weight-bolder mb-1">مبلغ قابل پرداخت : </span>
                </td>
                <td class="text-center p-2"
                    colspan="2">{{number_format($paymentPrice, 0, '.', ',')}} @lang('common.pricePrefix')</td>
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
            <img style="float: left; width: 20%;background-color: #ffffff;"
                 src="{{asset('storage/'.$sign)}}" alt="">
        @endif
    </div>


</div>


<htmlpagefooter name="page-footer">
    @if(!is_null($footer))
        <img style="width: 100%;background-color: #ffffff;margin-bottom: 10px;"
             src="{{asset('storage/'.$footer)}}" alt="">
    @endif
</htmlpagefooter>
</body>

</html>
