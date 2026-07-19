@extends('layout.main')@section('title', $title)
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                {{$title}}
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">

                            {{--
                                                        <x-Button permission="Add Preinvoice" :title="__('preinvoice.add')" url="{{route('preinvoice.create')}}"></x-Button>
                            --}}

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <div class="example mb-10">
                            <div class="example-preview">
                                <ul class="nav nav-pills nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-4" data-toggle="tab" href="#home-4">
                                            <span class="nav-icon"><i class="flaticon2-layers-1"></i></span>
                                            <span class="nav-text">وظایف جمع آوری</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-4" data-toggle="tab" href="#profile-4"
                                           aria-controls="profile">
                                            <span class="nav-icon"><i class="flaticon2-send-1"></i></span>
                                            <span class="nav-text">وظایف تحویل دادن</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-5" id="myTabContent4">
                                    <div class="tab-pane fade active show" id="home-4" role="tabpanel"
                                         aria-labelledby="home-tab-4">

                                        <!--begin: جدول داده ها-->
                                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                                               id="kt_datatable_collect_driver">
                                            <thead>
                                            <tr>
                                                <th>@lang('transport.customer_name')</th>
                                                <th>@lang('user.address')</th>
                                                <th>@lang('common.created_at')</th>
                                                <th>@lang('transport.collect_time')</th>
                                                <th>@lang('transport.status_charge_receipts')</th>
                                                <th>@lang('common.actions')</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($collect_list as $item)

                                                <tr>
                                                    <td>{{$item->preinvoice->request->user->full_name??''}}</td>
                                                    <td>{{$item->preinvoice->request->user->address->toStringAddress??''}}</td>
                                                    <td>{{$item->persianDateTime}}</td>
                                                    <td nowrap>{{$item->persianCollectTime??'-'}}</td>
                                                    <td>
                                                        <div
                                                            class="{{$item->transportChargeReceiptStatusValue['class']}}">{{$item->transportChargeReceiptStatusValue['title']}}
                                                        </div>

                                                    </td>

                                                    <td>

                                                        <x-FormButton permission="Upload Charge Receipts"
                                                                      url="{{route('transport.uploadChargeReceipts',$item->id)}}"
                                                                      :icon="__('icon.upload_icon')"
                                                                      :title="__('transport.upload_charge_receipts')"
                                                                      click="null"></x-FormButton>


                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>

                                        </table>
                                        <!--end: جدول داده ها-->


                                    </div>
                                    <div class="tab-pane fade" id="profile-4" role="tabpanel"
                                         aria-labelledby="profile-tab-4">

                                        <!--begin: جدول داده ها-->
                                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                                               id="kt_datatable_delivery_driver">
                                            <thead>
                                            <tr>
                                                <th>@lang('transport.customer_name')</th>
                                                <th>@lang('user.address')</th>
                                                <th>@lang('common.created_at')</th>
                                                <th>@lang('transport.delivery_time')</th>
                                                <th>@lang('payment.add')</th>
                                                <th>@lang('common.actions')</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($delivery_list as $item)

                                                <tr>
                                                    <td>{{$item->preinvoice->request->user->full_name??''}}</td>
                                                    <td>{{$item->preinvoice->request->user->address->toStringAddress??''}}</td>
                                                    <td>{{$item->persianDateTime}}</td>
                                                    <td nowrap>{{$item->persianDeliveryTime??'-'}}</td>
                                                    <td>
                                                        <x-FormButton permission="Add Payment"
                                                                      url="{{route('payment.create',$item->preinvoice->id)}}"
                                                                      :icon="__('icon.upload_icon')"
                                                                      :title="__('payment.add')"
                                                                      click="null"></x-FormButton>

                                                    </td>
                                                    <td>


                                                        <x-FormButton permission="Set Collector Status"
                                                                      :title="__('transport.done_delivery_task')"
                                                                      url="javascript:;"
                                                                      btn-class="btn-sm btn-success"
                                                                      :icon="__('icon.agree_icon')"
                                                                      click="changeDialog('{{__('transport.done_delivery_task')}}','{{__('transport.are_you_sure_done_delivery_task')}}','/admin/transport/done_task/{{$item->id}}')">
                                                        </x-FormButton>


                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>

                                        </table>
                                        <!--end: جدول داده ها-->


                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end: جدول داده ها-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection
