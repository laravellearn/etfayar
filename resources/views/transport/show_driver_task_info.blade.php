@extends('layout.main')@section('title', $title)
@section('content')
    <style>
        /**{
            border: red solid 1px!important;
        }*/
    </style>
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        {{--   <span class="example-toggle" data-toggle="tooltip" title="" data-original-title="مشاهد کد"></span>
                           <span class="example-copy" data-toggle="tooltip" title="" data-original-title="کپی کد"></span>--}}

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{route('transporter.preinvoice.update')}}" method="post">
                <div class="card-body justify-content-center">

                    @csrf

                    <input type="hidden" name="id" value="{{$single->id}}">
                    <br><br>
                    <h3 class="col-12 text-center text-nowrap m-auto"> @lang("user.contact_information")</h3>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">تلفن
                            مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg text-center">

                                <x-SimpleButton class="m-auto" permission="Access Transporter Preinvoice"
                                                :title="__('common.call_telephone')"
                                                url="tel:{{$single->preinvoice->request->user->telephone??''}}"></x-SimpleButton>


                                {{-- <div class="input-group-prepend"><span class="input-group-text"><i
                                                 class="la la-phone"></i></span></div>
                                 <input type="text" class="form-control form-control-lg form-control-solid"
                                        value="{{$single->preinvoice->request->user->telephone}}" placeholder="تلفن">

                            --}}

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">تلفن
                            همراه مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg">
                                <x-SimpleButton permission="Access Transporter Preinvoice"
                                                :title="__('common.call_mobile')"
                                                url="tel:{{$single->preinvoice->request->user->mobile??''}}"></x-SimpleButton>

                                {{--<div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-mobile"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{$single->preinvoice->request->user->mobile}}" placeholder="تلفن">--}}
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <h3 class="col-sm-12 text-center text-nowrap col-3 text-center m-auto"> @lang("user.customer_address")</h3>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">آدرس
                            مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-location-arrow"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{$single->preinvoice->request->user->address->toStringAddress??''}}"
                                       placeholder="تلفن">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">لوکیشن
                            مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg">
                                <x-SimpleButton permission="Access Transporter Preinvoice"
                                                :title="__('transporter.show_location')"
                                                url="{{$single->preinvoice->request->user->address->location??''}}"></x-SimpleButton>

                                {{--<div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-mobile"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{$single->preinvoice->request->user->mobile}}" placeholder="تلفن">--}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="col-sm-12 text-center text-nowrap col-3 text-center m-auto"> @lang("preinvoice.additional_description")</h3>
                    <br>
                    <p class="text-center"
                       id="additional_description">{{$single->preinvoice->transportMeta->additional_description ?? ''}}</p>

                    <br>
                    <h3 class="col-sm-12 text-center text-nowrap"> @lang("user.customer_orders_info")</h3>
                    <br>
                    <!--begin: جدول داده ها-->
                    <table class="table table-bordered table-vertical-center table-light-white table-head-custom"
                           id="kt_datatable_role">
                        <thead>
                        <tr>
                            <th>شرح کالا</th>
                            <th>تعداد</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($single->preinvoice->items as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->count}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <!--end: جدول داده ها-->

                    @if(!is_null($single->upload_customer_charge_receipt))
                        <br><br><br>
                        <h3 class="col-sm-12 text-center text-nowrap col-3 text-center m-auto"> @lang("transporter.charge_receipts")</h3>
                        <br><br>
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <div class="row">
                                    <span class="col-sm-8 text-nowrap">بارگذاری رسید شارژ</span>
                                    <div class="col-sm-4">
                                        <x-FormButton permission="Upload Charge Receipts"
                                                      url="{{route('transporter.uploadChargeReceipts',$single->id)}}"
                                                      :icon="__('icon.upload_icon')"
                                                      :title="__('transporter.upload_charge_receipts')"
                                                      click="null"></x-FormButton>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col-12 m-auto text-center"><img class="img-fluid mr-1 mt-2"
                                                                        src="{{ asset('/storage/'.$single->upload_customer_charge_receipt) }}"
                                                                        alt=""></div>
                        </div>
                    @endif


                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <script>


    </script>
@endsection
