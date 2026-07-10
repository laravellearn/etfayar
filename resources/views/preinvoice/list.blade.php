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

                            <x-Button permission="Add Preinvoice" :title="__('preinvoice.add')"
                                      url="{{route('preinvoice.create')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table
                            class="table table-separate table-head-custom table-responsive-sm  table-bordered table-striped"
                            id="kt_datatable_invoice">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>@lang('preinvoice.code')</th>
                                <th>@lang('preinvoice.customer')</th>
                                <th>@lang('preinvoice.title')</th>
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
                                    <td><p class="font-size-xs">{{$item->persianDateTime}}</p></td>
                                    <td>
                                        <div
                                            class="{{ $item->generalStatusValue->class }}">{{ $item->generalStatusValue->title }}
                                        </div>
                                    </td>

                                    <td>
                                        @foreach($item->transportStatusValue as $value)
                                            <span
                                                class="{{$value->class}}">{{$value->title}}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($item->workshopStatusValue as $value)
                                            <span
                                                class="text-nowrap {{$value->class}}">{{$value->title}}</span>
                                        @endforeach
                                    </td>

                                    <td>

                                       {{-- @include('partials.invoice_actions_buttons')--}}

                                        <x-FormButton permission="Create Charge Card"
                                                      url="{{route('preinvoice.create_charge_card',$item->id)}}"
                                                      :icon="__('icon.charge_card_icon')"
                                                      :title="__('preinvoice.create_charge_card')" click="null"
                                                      target="_blank"></x-FormButton>

                                        <x-FormButton permission="Create Custom PreInvoice"
                                                      url="{{route('custom_invoice.preinvoice.create',$item->id)}}"
                                                      :icon="__('icon.percent_icon')"
                                                      :title="__('preinvoice.create_custom_preinvoice')" click="null"
                                                      target="_blank"></x-FormButton>
                                        @if(isset($item->information) && $item->information->header_type==1)
                                            <x-FormButton permission="Download Official PreInvoice"
                                                          url="{{route('preinvoice.official.download',$item->id)}}"
                                                          :icon="__('icon.official_invoice_icon')"
                                                          :title="__('invoice.download_official_invoice')" click="null"
                                                          target="_blank"></x-FormButton>
                                        @endif

                                        @if(isset($item->information) && $item->information->header_type==0)
                                            <x-FormButton permission="Download Unofficial PreInvoice"
                                                          url="{{route('preinvoice.unofficial.download',$item->id)}}"
                                                          :icon="__('icon.unofficial_invoice_icon')"
                                                          :title="__('invoice.download_unofficial_invoice')"
                                                          click="null"
                                                          target="_blank"></x-FormButton>
                                        @endif

                                        <x-FormButton permission="Show Preinvoice"
                                                      url="{{route('preinvoice.show',$item->id)}}"
                                                      :icon="__('icon.show_icon')" :title="__('preinvoice.show')"
                                                      click="null" target="_blank"></x-FormButton>


                                        <x-FormButton permission="Send To Financial"
                                                      url="javascript:;"
                                                      :icon="__('icon.send_to_financial_icon')"
                                                      :title="__('preinvoice.send_to_financial')"
                                                      click="changeDialog('{{__('preinvoice.send_to_financial')}}','{{__('common.are_you_sure')}}','/admin/preinvoice/send_to_financial/{{$item->id}}')"></x-FormButton>


                                        <x-FormButton permission="Edit Preinvoice"
                                                      url="{{route('preinvoice.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null"></x-FormButton>

                                        <x-FormButton permission="Delete Preinvoice" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/preinvoice/delete/{{$item->id}}')"></x-FormButton>

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
