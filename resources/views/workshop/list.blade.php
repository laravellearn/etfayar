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
                        <table class="table table-separate table-head-custom  table-bordered table-striped text-center"
                               id="kt_datatable_workshop">
                            <thead>
                            <tr>
                                <th>@lang('user.code')</th>
                                <th>@lang('preinvoice.customer')</th>
                                <th>@lang('transport.charge_receipts')</th>
                                <th nowrap>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)

                                <tr>
                                    <td>{{$item->preinvoice->request->user->customer_code??''}}</td>
                                    <td>{{$item->preinvoice->request->user->full_name??''}}</td>
                                    <td>
                                        @if(isset($item->preinvoice->transport->charge_receipt_file))
                                            <x-FormButton permission="Show Charge Receipt"
                                                          url="{{asset('storage/'.$item->preinvoice->transport->charge_receipt_file)??''}}"
                                                          :icon="__('icon.show_icon')" :title="__('preinvoice.show')"
                                                          click="null"></x-FormButton>
                                        @else
                                            ندارد
                                        @endif
                                    </td>
                                    <td nowrap>{{$item->persianDate??''}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Edit Workshop"
                                                      url="{{route('workshop.edit',$item->id)}}"
                                                      :icon="__('icon.fire_icon')"
                                                      :title="__('common.add_fireExtinguisherPart')"
                                                      click="null" target="">

                                        </x-FormButton>

                                        <x-FormButton permission="Edit Workshop"
                                                      url="javascript:;"
                                                      :icon="__('icon.close_icon')"
                                                      :title="__('workshop.exit_from_workshop_tasks')"
                                                      click="changeDialog('{{__('workshop.exit_from_workshop_tasks')}}','{{__('workshop.are_you_sure_to_close')}}','/admin/workshop/exit_from_workshop_tasks/{{$item->id}}')"
                                                      target="">

                                        </x-FormButton>


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
