@extends('layout.main')@section('title', $title)
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Todo-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_todo_aside">
                        <!--begin::Card-->
                        <div class="card card-custom card-stretch">
                            <!--begin::Body-->
                            <div class="card-body px-5">
                                <!--begin:Nav-->
                                <div
                                    class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="#" class="navi-link active">
                    <span class="navi-icon mr-4">
                        <span class="svg-icon svg-icon-lg"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z"
            fill="#000000" opacity="0.3"/>
        <path
            d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>                    </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">انجام نشده</span>
                                            <span class="navi-label">
                        <span class="label label-rounded label-light-success font-weight-bolder">3</span>
                    </span>
                                        </a>
                                    </div>
                                    <!--end:Item-->

                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="#" class="navi-link">
                    <span class="navi-icon mr-4">
                        <span class="svg-icon svg-icon-lg"><!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z"
            fill="#000000" opacity="0.3"/>
        <path
            d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>                    </span>
                                            <span
                                                class="navi-text font-weight-bolder font-size-lg">جمع آوری شده</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->

                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="#" class="navi-link">
                    <span class="navi-icon mr-4">
                        <span class="svg-icon svg-icon-lg"><!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"></path>
        <path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"></path>
    </g>
</svg><!--end::Svg Icon--></span>                    </span>
                                            <span
                                                class="navi-text font-weight-bolder font-size-lg">تحویل داده شده</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->


                                </div>
                                <!--end:Nav-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Aside-->

                    <!--begin::List-->
                    <div class="flex-row-fluid ml-lg-8">
                        <div class="d-flex flex-column flex-grow-1">
                            <!--begin::Head-->
                            <div class="card card-custom gutter-b">
                                <!--begin::Body-->
                                <div class="card-body d-flex align-items-center justify-content-between flex-wrap py-3">
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center mr-2 py-2">
                                        <!--begin::Title-->
                                        <h3 class="font-weight-bold mb-0 mr-10">وظایف</h3>
                                        <!--end::Title-->

                                        <!--begin::Navigation-->
                                        <div class="d-flex mr-3">
                                            <!--begin::Navi-->
                                            <div
                                                class="navi navi-hover navi-active navi-link-rounded navi-bold d-flex flex-row">
                                                <!--begin::Item-->
                                                <div class="navi-item mr-2">
                                                    <a href="custom/apps/todo/tasks.html" class="navi-link active">
                                                        <span class="navi-text">جمع آوری</span>
                                                    </a>
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="navi-item mr-2">
                                                    <a href="custom/apps/todo/docs.html" class="navi-link ">
                                                        <span class="navi-text">تحویل دادن</span>
                                                    </a>
                                                </div>
                                                <!--end::Item-->

                                            </div>
                                            <!--end::Navi-->
                                        </div>
                                        <!--end::Navigation-->
                                    </div>
                                    <!--end::Info-->

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Head-->

                            <!--begin::Row-->
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
                                    <table class="table table-separate table-head-custom table-responsive"
                                           id="kt_datatable_role">
                                        <thead>
                                        <tr>
                                            <th>@lang('transporter.customer_name')</th>
                                            <th>@lang('user.address')</th>
                                            {{-- <th>@lang('transporter.collect_driver_name')</th>
                                             <th>@lang('transporter.delivery_driver_name')</th>--}}
                                            <th>@lang('common.created_at')</th>
                                            <th nowrap>@lang('transporter.status_charge_receipts')</th>
                                            <th nowrap>@lang('transporter.upload_payment_receipts')</th>
                                            <th nowrap>@lang('transporter.status')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($list as $item)

                                            <tr>
                                                <td nowrap>{{$item->preinvoice->request->user->full_name??''}}</td>
                                                <td>{{$item->preinvoice->request->user->address->toStringAddress??''}}</td>
                                                {{-- <td nowrap>{{$item->collect_driver->full_name??''}}</td>
                                                 <td nowrap>{{$item->delivery_driver->full_name??''}}</td>--}}
                                                <td nowrap>{{$item->persianDateTime}}</td>
                                                <td nowrap>
                                                    <div
                                                        class="{{$item->transportChargeReceiptStatusValue['class']}}">{{$item->transportChargeReceiptStatusValue['title']}}
                                                    </div>
                                                    <x-FormButton permission="Upload Charge Receipts"
                                                                  url="{{route('transporter.uploadChargeReceipts',$item->id)}}"
                                                                  :icon="__('icon.upload_icon')"
                                                                  :title="__('transporter.upload_charge_receipts')"
                                                                  click="null"></x-FormButton>

                                                    {{--@if(is_null($item->upload_customer_charge_receipt))

                                                    @endif--}}


                                                </td>
                                                <td nowrap>

                                                    {{--  <div
                                                          class="{{$item->transportPaymentReceiptStatusValue['class']}}">{{$item->transportPaymentReceiptStatusValue['title']}}
                                                      </div>--}}


                                                    {{-- @if(is_null($item->upload_customer_payment_receipt))
                                                         <x-FormButton permission="Upload Payment Receipts"
                                                                       url="{{route('transporter.uploadPaymentReceipts',$item->id)}}"
                                                                       :icon="__('icon.upload_icon')"
                                                                       :title="__('transporter.upload_payment_receipts')"
                                                                       click="null"></x-FormButton>
                                                     @endif--}}

                                                    {{--          <x-Button permission="Add Payment"
                                                                        :title="__('payment.add')"
                                                                        url="{{route('payment.create',$item->preinvoice->id)}}">
                                                              </x-Button>
                      --}}
                                                    <x-FormButton permission="Add Payment"
                                                                  url="{{route('payment.create',$item->preinvoice->id)}}"
                                                                  :icon="__('icon.upload_icon')"
                                                                  :title="__('payment.add')"
                                                                  click="null"></x-FormButton>

                                                </td>
                                                <td nowrap>
                                                    <div
                                                        class="{{ $item->transportStatusValue->class }}">{{ $item->transportStatusValue->title }}
                                                    </div>
                                                </td>

                                                <td nowrap>

                                                    <x-FormButton permission="Access Transporter Preinvoice"
                                                                  url="{{ $item->preinvoice->request->user->address->location??'' }}"
                                                                  :icon="__('icon.location_icon')"
                                                                  :title="__('transporter.show_location')"
                                                                  click="null"></x-FormButton>

                                                    <x-FormButton permission="Access Transporter Preinvoice"
                                                                  url="{{ route('transporter.driversTaskInfo',$item->id) }}"
                                                                  :icon="__('icon.show_icon')"
                                                                  :title="__('transporter.show_information')"
                                                                  click="null">

                                                    </x-FormButton>

                                                    <x-Button permission="Set Collector Status"
                                                              :title="__('transporter.done_delivery_task')"
                                                              url="javascript:;"
                                                              btn-class="btn-sm btn-success"
                                                              click="changeDialog('{{__('transporter.done_delivery_task')}}','{{__('transporter.are_you_sure_done_delivery_task')}}','/admin/transporter/done_task/{{$item->id}}')">
                                                    </x-Button>


                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>

                                    </table>
                                    <!--end: جدول داده ها-->
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                    <!--end::List-->
                </div>
                <!--end::Todo-->
            </div>
            <!--end::Container-->
        </div>
    </div>
    <!--end::لیست-->
    </div>
    <!--end::انجام دادن-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection
