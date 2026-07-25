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

                            <x-Button permission="Add Payment"
                                      :title="__('payment.add')"
                                      url="{{route('payment.create',$invoice_id)}}">
                            </x-Button>


                            {{--           <x-FormButton permission="Add Payment"
                                                     url="{{route('payment.create',$invoice_id)}}"
                                                     :icon="__('icon.payment_icon')"
                                                     :title="__('payment.create')" click="null"></x-FormButton>
           --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom" id="kt_datatable_role">
                            <thead>
                            <tr>
                                <th>@lang('payment.payment_receipt')</th>
                                <th>@lang('payment.bank')</th>
                                <th>@lang('payment.description')</th>
                                <th>@lang('payment.price')</th>
                                <th>@lang('payment.is_deposit')</th>
                                <th>@lang('payment.payment_date')</th>
                                <th>@lang('common.status')</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)

                                <tr>
                                    <td>
                                        <a href="{{ asset('/storage/'. $item->payment_receipt) }}"> <img
                                                class="img-thumbnail w-100px h-100px"
                                                src="{{ asset('/storage/'. $item->payment_receipt) }}"
                                                {{-- src="{{ asset('/storage/'. $item->payment_receipt) }}"--}}
                                                {{--src="{{ asset('media\books\6.png') }}"--}}
                                                alt="">
                                        </a>
                                    </td>
                                    <td>{{ $item->bank->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ number_format($item->price , 0, '.', ',') }}</td>
                                    <td>
                                        <div class="{{ $item->deposit->class }}">{{ $item->deposit->title }}</div>
                                    </td>
                                    <td nowrap>{{ $item->persianPaymentDate??'-' }}</td>
                                    <td nowrap>
                                        <div class="{{ $item->approvalStatusValue->class }}">{{ $item->approvalStatusValue->title }}</div>
                                    </td>
                                    <td>{{ $item->persianDateTime }}</td>
                                    <td>

                                        <x-FormButton permission="Edit Payment"
                                                      url="{{route('payment.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')"
                                                      :title="__('common.edit')"
                                                      click="null"></x-FormButton>

                                        @if(!$item->is_agree)
                                            <x-FormButton permission="Agree Payment"
                                                          url="javascript:;"
                                                          :icon="__('icon.agree_icon')"
                                                          :title="__('payment.is_agree')"
                                                          click="changeDialog('{{__('payment.agree_payment')}}','{{__('payment.are_you_sure_to_agree')}}','/admin/payment/agree_payment/{{$item->id}}')"></x-FormButton>

                                        @else
                                            <x-FormButton permission="DisAgree Payment"
                                                          url="javascript:;"
                                                          :icon="__('icon.disagree_icon')"
                                                          :title="__('payment.disagree')"
                                                          type="danger"
                                                          click="changeDialog('{{__('payment.disagree_payment')}}','{{__('payment.are_you_sure_to_disagree')}}','/admin/payment/disagree_payment/{{$item->id}}')"></x-FormButton>

                                        @endif

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
