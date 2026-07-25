@extends('layout.main')@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">

                        <x-Button permission="Access Invoices"
                                  :title="__('payment.title')"
                                  url="{{route('payments',$single->invoice_id)}}">
                        </x-Button>

                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form autocomplete="off" class="form" action="{{route('payment.update')}}" method="post"
                  enctype="multipart/form-data">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" value="{{$single->id}}">

                    @php($title=__("transport.payment_receipts"))
                    @php($caption='')
                    @php($value=$single->payment_receipt)
                    <x-InputRow :title="$title" name="upload_payment_receipt" id="upload_payment_receipt"
                                :value="$value" :caption="$caption" type="file"
                                icon="bx bx-tax">
                    </x-InputRow>

                    <div class="form-group row">
                        <label class="col-3">@lang("bank.name")</label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="bank_id" id="bank_id" data-size="5"
                                    data-live-search="true"
                                    data-fv-not-empty="true"
                                    data-fv-not-empty___message="لطفا بانک انتخاب نمایید"
                                    required>
                                <option value="null" disabled selected hidden>انتخاب بانک...</option>
                                @foreach($banks as $item)
                                    <option
                                        {{$single->bank_id==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("payment.price"))
                    @php($caption='')
                    @php($value=$single->price)
                    <x-InputRow :title="$title" name="price" id="price" :value="$value" type="number" :min="0"
                                :caption="$caption" icon="bx bx-money"/>

                    @if($canSetPaymentDate)
                        @php($title=__("payment.payment_date"))
                        @php($caption=__("payment.payment_date_hint"))
                        @php($value=$single->persianPaymentDate)
                        <x-InputRow dir="ltr" :title="$title" name="payment_date" id="payment_date" :value="$value"
                                    :caption="$caption" type="text" icon="bx bx-calendar">
                        </x-InputRow>
                    @else
                        @php($title=__("payment.payment_date"))
                        @php($value=$single->persianPaymentDate??'-')
                        <x-InputRow :title="$title" name="payment_date_display" id="payment_date_display"
                                    :value="$value" caption="" type="text" icon="bx bx-calendar" disabled="disabled">
                        </x-InputRow>
                    @endif

                    @php($title=__("payment.description"))
                    @php($caption=__(""))
                    @php($value=$single->description)
                    <x-InputText :title="$title" name="description" id="description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
