<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/bootstrap/bootstrap.min.css') }}>
    <title>کارت شارژ | {{$full_name}}</title>

    @php
        /*dd($request->name_padding_top)*/
    @endphp

    <style>
        body {
            font-size: 2em;
            font-family: primary_font, sans-serif;
        }

        #container {
            width: 100%;
            height: 100%;
            padding: 0;

            background-position: 0% 0%;
            background-size: 100% 100%;
           /*background: url({{asset('media/invoice/charge_card.jpg')}}) no-repeat;*/
        }

        #name_container {
            text-align: center;
            padding-top: {{$name_padding_top}}cm !important;
            padding-right: {{$name_padding_right}}cm;
        }

        #customer_code_container {
            text-align: center;
            padding-top: {{$customer_code_padding_top}}cm !important;
            padding-right: {{$customer_code_padding_right}}cm;
        }

        #date_container {
            text-align: center;
            padding-top: {{$date_padding_top}}cm !important;
            padding-right: {{$date_padding_right}}cm;
        }

        #weight_container {

            text-align: center;
            padding-top: {{$weight_padding_top}}cm !important;
            padding-right: {{$weight_padding_right}}cm;
        }

        #type_container {
            text-align: center;
            padding-top: {{$type_padding_top}}cm !important;
            padding-right: {{$type_padding_right}}cm;
        }

    </style>
</head>
<body>
@foreach($items as $item)
    @for($i=1;$i<=$item->count;$i++)

        <div id="container">
            <div id="name_container">
                <h3>{{$full_name}}</h3>
            </div>
            <div id="customer_code_container">
                <h3>{{$customer_code}}</h3>
            </div>
            <div id="date_container">
                <h3>{{$date}}</h3>
            </div>
            <div id="weight_container">
                <h3>{{$weight}}</h3>
            </div>

            <div id="type_container">
                <h3 style="font-family: Arial">&#x25A0;</h3>
            </div>

        </div>
    @endfor
@endforeach


</body>
</html>
