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
                                  url="{{route('payments',$invoice_id)}}">
                        </x-Button>


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form autocomplete="off" class="form" action="{{route('payment.store')}}" method="post"
                  enctype="multipart/form-data">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="invoice_id" value="{{$invoice_id}}">

                    @php($title=__("transport.payment_receipts"))
                    @php($caption='')
                    @php($value=$single->upload_customer_payment_receipt)
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
                                        {{old('bank_id')==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("payment.price"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="price" id="price" :value="$value" type="number" :min="0"
                                :caption="$caption" disabled="" icon="bx bx-money"/>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label>@lang('payment.is_deposit') : </label>
                            </div>
                            <div class="col-md-9">
                                <div class="">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="is_deposit">
                                        <span></span>

                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    @php($title=__("payment.description"))
                    @php($caption=__(""))
                    @php($value='')
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
