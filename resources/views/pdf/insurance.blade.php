<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap.min.css') }}>
    <title>بیمه کپسول | {{$full_name}}</title>
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
        }

        #title_container {
            text-align: center;
            padding-top: 10px !important;
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
            margin-top: 10px;
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
            border-bottom: 0.01em solid #000000 !important;
            border-left: 0.01em solid #000000 !important;
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
        <h1 id="title"></h1>
        <h5></h5>
    </div>
    <div id="number_container">
        <div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="">
        <table style="text-align: center">
            <thead>
            {{-- <tr>
                 <th class="text-center p-2">نام مشتری</th>
                 <th class="text-center p-2">تلفن</th>
             </tr>--}}
            </thead>

            <tbody>
            <tr style="padding:5px">
                <td style="padding:20px;font-size: 12px" colspan="3"><h1>{{$information_name}}</h1></td>
                <td style="display:inline-block;padding:8px 20px;font-size: 12px;text-align: center!important;"
                    colspan="1">
                    <div><strong>شماره:</strong>&nbsp;ب{{$number}}</div>
                    <div>&nbsp;</div>
                    <div><strong>تاریخ :</strong> {{$persianDate}}</div>
                    <div>&nbsp;</div>
                    <div><strong>پیوست :</strong> ندارد</div>

                </td>
            </tr>

            <tr>
                <td style="padding:8px;font-size: 12px;line-height: 30px;" colspan="1"><strong>نام
                        مشتری:</strong>&nbsp;{{$full_name}}</td>
                <td style="padding:8px;text-align: right;font-size: 12px;line-height: 30px;" colspan="3">
                    <strong>آدرس:</strong>&nbsp;{{$address}}</td>

            </tr>

            <tr>
                <td style="padding:8px;text-align: right;font-size: 12px" colspan="2"><strong>تاریخ
                        شارژ:</strong>&nbsp;{{$persianChargeTime}}</td>
                <td style="padding:8px;text-align: right;font-size: 12px" colspan="2"><strong>تاریخ شارژ مجدد:</strong>&nbsp;{{$persianRechargeTime}}
                </td>
            </tr>


            </tbody>
        </table>

    </div>
    <div id="items_container" class="">
        <table style="margin: 0 40px" class="table table-striped">
            <thead>
            <tr class="p-4">
                <th style="width: 40px;padding: 5px;text-align: center;" class="text-center p-1">ردیف</th>
                <th style="padding: 5px;text-align: center;" class="text-center p-1">نوع کپسول</th>
                <th style="padding: 5px;text-align: center;" class="text-center p-1">شماره کپسول</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="font-weight-boldest font-size-small p-1">
                    <td style="padding: 6px;text-align: center;" class="text-center p-1">{{$loop->iteration }}</td>
                    <td style="padding: 6px;text-align: center;" class="text-end p-1">
                        <small>{{$item->product->title}}</small></td>
                    <td style="padding: 6px;text-align: center;" class="text-end p-1"><small>{{$item->number}}</small>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>


</body>
</html>
