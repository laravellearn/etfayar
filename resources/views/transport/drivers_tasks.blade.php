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
                                        <table
                                            class="table table-separate table-head-custom table-bordered table-striped text-center"
                                            id="kt_datatable_collect_driver">
                                            <thead>
                                            <tr>
                                                <th>@lang('transport.customer_name')</th>
                                                <th>@lang('user.address')</th>
                                                <th>@lang('common.created_at')</th>
                                                <th>@lang('transport.status_charge_receipts')</th>
                                                <th>@lang('common.actions')</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($collect_list as $item)
                                            @if($item->preinvoice->is_deposit==0)

                                                <tr>
                                                    <td>{{ $item->preinvoice->is_deposit }}{{$item->preinvoice->request->user->full_name??''}}</td>
                                                    <td>{{$item->preinvoice->request->user->address->toStringAddress??''}}</td>
                                                    <td>{{$item->persianDateTime}}</td>
                                                    <td>
                                                        <div
                                                            class="{{$item->transportChargeReceiptStatusValue['class']}}">{{$item->transportChargeReceiptStatusValue['title']}}
                                                        </div>

                                                    </td>

                                                    <td nowrap>

                                                        <x-form-button permission="Show Transport For Driver"
                                                                       :title="__('transport.show_information')"
                                                                       url="{{route('transport.show_for_driver',$item->id)}}"
                                                                       :icon="__('icon.show_icon')"
                                                                       btn-class="btn-sm btn-success">
                                                        </x-form-button>


                                                        <x-FormButton permission="Upload Charge Receipts"
                                                                      url="{{route('transport.uploadChargeReceipts',$item->id)}}"
                                                                      :icon="__('icon.upload_icon')"
                                                                      :title="__('transport.upload_charge_receipts')"
                                                                      click="null"></x-FormButton>


                                                    </td>
                                                </tr>
                                                @endif

                                            @endforeach
                                            </tbody>

                                        </table>
                                        <!--end: جدول داده ها-->


                                    </div>
                                    <div class="tab-pane fade" id="profile-4" role="tabpanel"
                                         aria-labelledby="profile-tab-4">

                                        <!--begin: جدول داده ها-->
                                        <table
                                            class="table table-separate table-head-custom table-bordered table-striped text-center"
                                            id="kt_datatable_delivery_driver">
                                            <thead>
                                            <tr>
                                                <th>@lang('transport.customer_name')</th>
                                                <th>@lang('user.address')</th>
                                                <th>@lang('common.created_at')</th>
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
                                                    <td>

                                                        <x-form-button permission="Show Transport For Driver"
                                                                       :title="__('transport.show_information')"
                                                                       url="{{route('transport.show_for_driver',$item->id)}}"
                                                                       :icon="__('icon.show_icon')"
                                                                       btn-class="btn-sm btn-success">
                                                        </x-form-button>


                                                        <x-FormButton permission="Add Payment"
                                                                      url="{{route('payment.create',$item->preinvoice->id)}}"
                                                                      :icon="__('icon.upload_icon')"
                                                                      :title="__('payment.add')"
                                                                      click="null"></x-FormButton>

                                                    </td>
                                                    <td nowrap>


                                                        <x-FormButton permission="Set Delivery Status"
                                                                      :title="__('transport.done_delivery_task')"
                                                                      url="{{route('transport.done_task',$item->id)}}"
                                                                      btn-class="btn-sm btn-success"
                                                                      :icon="__('icon.agree_icon')">
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
