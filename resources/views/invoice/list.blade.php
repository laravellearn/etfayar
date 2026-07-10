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

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped"
                               id="kt_datatable_invoice">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>@lang('invoice.code')</th>
                                <th>@lang('invoice.customer')</th>
                                <th>@lang('invoice.invoice_title')</th>
                                <th>تعداد آیتم ها</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('invoice.general_status')</th>
                                <th>@lang('invoice.transport_status')</th>
                                <th>@lang('invoice.workshop_status')</th>
                                <th>@lang('user.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)

                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->request->user->full_name??''}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{count($item->items) + count($item->workshop->items??[]) }}</td>
                                    <td>{{$item->persianDateTime}}</td>
                                    <td>
                                        <div
                                            class="text-nowrap {{ $item->generalStatusValue->class }}">{{ $item->generalStatusValue->title }}
                                        </div>
                                    </td>

                                    <td class="text-justify">

                                        @foreach($item->transportStatusValue as $value)
                                            <span
                                                class="{{$value->class}}">{{$value->title}}</span>
                                        @endforeach
                                    </td>


                                    <td>
                                        @foreach($item->workshopStatusValue as $value)
                                            <span
                                                class="{{$value->class}}">{{$value->title}}</span>
                                        @endforeach
                                    </td>

                                    <td>

                                        <x-FormButton permission="Create Charge Card"
                                                      url="{{route('invoice.create_charge_card',$item->id)}}"
                                                      :icon="__('icon.charge_card_icon')"
                                                      :title="__('invoice.create_charge_card')" click="null"
                                                      target="_blank"></x-FormButton>


                                        <x-FormButton permission="Create Custom Invoice"
                                                      url="{{route('custom_invoice.invoice.create',$item->id)}}"
                                                      :icon="__('icon.percent_icon')"
                                                      :title="__('invoice.create_custom_invoice')" click="null"
                                                      target="_blank"></x-FormButton>


                                        @if(isset($item->information) && $item->information->header_type==1)

                                            <x-FormButton permission="Download Official Invoice"
                                                          url="{{route('invoice.official.download',$item->id)}}"
                                                          :icon="__('icon.official_invoice_icon')"
                                                          :title="__('invoice.download_official_invoice')" click="null"
                                                          target="_blank"></x-FormButton>

                                        @endif

                                        @if(isset($item->information) && $item->information->header_type==0)

                                            <x-FormButton permission="Download Unofficial Invoice"
                                                          url="{{route('preinvoice.unofficial.custom.download',$item->id)}}"
                                                          :icon="__('icon.unofficial_invoice_icon')"
                                                          :title="__('invoice.download_unofficial_invoice')"
                                                          click="null"
                                                          target="_blank"></x-FormButton>
                                        @endif
                                        <x-FormButton permission="Show Invoice"
                                                      url="{{route('invoice.show',$item->id)}}"
                                                      :icon="__('icon.show_icon')" :title="__('preinvoice.show')"
                                                      click="null" target="_blank"></x-FormButton>

{{--

                                        <x-FormButton permission="Change To Invoice"
                                                      url="javascript:;"
                                                      :icon="__('icon.invoice_icon')"
                                                      :title="__('invoice.agree')"
                                                      click="changeDialog('{{__('invoice.agree')}}','{{__('invoice.are_you_sure')}}','/admin/preinvoice/change_to_factor/{{$item->id}}')"></x-FormButton>
--}}


                                        <x-FormButton permission="Access Payments"
                                                      url="{{route('payments',$item->id)}}"
                                                      :icon="__('icon.payment_icon')"
                                                      :title="__('payment.title')" click="null"></x-FormButton>

                                        <x-FormButton permission="Edit Invoice"
                                                      url="{{route('invoice.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null"></x-FormButton>

                                        <x-FormButton permission="Delete Invoice" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/invoice/delete/{{$item->id}}')"></x-FormButton>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
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
