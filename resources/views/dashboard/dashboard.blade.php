@extends('layout.main')@section('title', $title)
@section('content')

    <div class="row">

        <x-CountBox permission="Access Requests" color="bg-danger bg-hover-state-danger" :title="__('request.requests')"
                    caption="تعداد درخواست ها : {{$requestCount}}" :icon="__('icon.requests_icon')"
                    url="{{route('requests')}}"></x-CountBox>
        <x-CountBox permission="Access Preinvoice" color="bg-primary bg-hover-state-primary"
                    :title="__('preinvoice.preinvoices')" caption="تعداد پیش فاکتورها : {{$preinvoiceCount}}"
                    :icon="__('icon.invoice_icon3')" url="{{route('preinvoices')}}"></x-CountBox>
        <x-CountBox permission="Access Users" color="bg-success bg-hover-state-success" :title="__('user.users')"
                    caption="تعداد مشتریان : {{$userCount}}" :icon="__('icon.users_icon')"
                    url="{{route('users')}}"></x-CountBox>

    </div>

   <div class="row">

        <x-CountBox permission="Access Pending Invoices" color="bg-info bg-hover-state-info" :title="__('invoice.pending')"
                    caption="تعداد فاکتورهای تایید نشده : {{$invoiceCount}}" :icon="__('icon.invoice_icon2')"
                    url="{{route('invoice.pending')}}"></x-CountBox>

        <x-CountBox permission="Access Transports" color="bg-warning bg-hover-state-warning"
                    :title="__('transport.transporter')" caption="وظایف ترابری : {{$transportCount}}"
                    :icon="__('icon.transport_icon')" url="{{route('transports')}}"></x-CountBox>

        <x-CountBox permission="Access Users" color="bg-dark bg-hover-state-dark" :title="__('product.title')"
                    caption="تعداد محصولات : {{$productCount}}" :icon="__('icon.product_icon')"
                    url="{{route('products')}}"></x-CountBox>

    </div>

 <div class="row">

        <x-CountBox permission="Access Insurances" color="bg-success bg-hover-state-success" :title="__('insurance.title')"
                    caption="تعداد بیمه کپسول : {{$insuranceCount}}" :icon="__('icon.extinguisher_icon')"
                    url="{{route('insurances')}}"></x-CountBox>

     <x-CountBox permission="Access My Message Reports" color="bg-danger bg-hover-state-danger" :title="__('message_report.my_list')"
                 caption="تعداد پیام های ارسالی من : {{$myMessageCount}}" :icon="__('icon.sms_icon')"
                 url="{{route('my_message_reports')}}"></x-CountBox>

     <x-CountBox permission="Access FireExtinguisherPart" color="bg-primary bg-hover-state-primary"
                 :title="__('fireExtinguisherPart.fireExtinguisherPart')" caption="تعداد قطعات داغی : {{$fireExtinguisherPartsCount}}"
                 :icon="__('icon.fireExtinguisherPart_icon')" url="{{route('fireExtinguisherParts')}}"></x-CountBox>
    </div>




    <div class="row">

        <x-ChartRequests permission="Access Requests"></x-ChartRequests>

    </div>

    <div class="row">

        <x-LatestPreinvoiceList permission="Access Preinvoice" :list="$preinvoice_list"></x-LatestPreinvoiceList>
        <x-PendingInvoiceList permission="Access Pending Invoices" :list="$pending_list"></x-PendingInvoiceList>

    </div>

    <div class="row">

        {{--<div style="width: 100%" class="calender"></div>--}}
    </div>


    {{--<script>
        $(document).ready(function(){
            $(".calender").datepicker({
                altField : "#calenderSelector",
                altSecondaryField : "#calenderSecondarySelector",
                format : "long",
                date   : "{{$today}}",
            });
        });
    </script>--}}
@endsection
