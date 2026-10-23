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
                    <x-InputRow dir="ltr" :title="$title" name="price" id="price" :value="$value" type="text"
                                :caption="$caption" icon="bx bx-money"/>

                    @if(auth('admin')->user()->hasAnyRole(\App\Http\Controllers\PaymentController::FINANCIAL_ROLES))
                        @php($title=__("payment.payment_date"))
                        @php($caption=__("payment.payment_date_hint"))
                        @php
                            $value = old('payment_date') ?: \Hekmatinasser\Verta\Verta::now()->format('Y/m/d');
                        @endphp
                        <x-InputRow :title="$title" name="payment_date" id="payment_date" :value="$value"
                                    caption="" type="text" icon="bx bx-calendar"/>
                        <div class="form-group row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <span class="text-muted font-size-sm">{{$caption}}</span>
                            </div>
                        </div>
                    @endif

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
    <script>
        // تاریخ واریزی: انتخاب با datepicker شمسی، مقدار پیش‌فرض = تاریخ امروز
        (function () {
            var paymentDateOptions = {
                placeholder: "روز / ماه / سال"
                , twodigit: true
                , closeAfterSelect: true
                , nextButtonIcon: "fa fa-arrow-circle-right"
                , previousButtonIcon: "fa fa-arrow-circle-left"
                , buttonsColor: "blue"
                , forceFarsiDigits: false
                , pastYearsCount: 5
                , futureYearsCount: 1
                , markToday: true
                , markHolidays: false
                , highlightSelectedDay: false
                , sync: true
                , gotoToday: true
            };
            if (document.getElementById('payment_date') && typeof kamaDatepicker === 'function') {
                kamaDatepicker('payment_date', paymentDateOptions);
            }

            // مبلغ: جداکننده‌ی سه رقم سه رقم هنگام تایپ
            var priceInput = document.getElementById('price');
            if (priceInput) {
                var persianDigits = {'۰': '0', '۱': '1', '۲': '2', '۳': '3', '۴': '4', '۵': '5', '۶': '6', '۷': '7', '۸': '8', '۹': '9',
                    '٠': '0', '١': '1', '٢': '2', '٣': '3', '٤': '4', '٥': '5', '٦': '6', '٧': '7', '٨': '8', '٩': '9'};

                function rawNumber(v) {
                    v = String(v).replace(/[۰-۹٠-٩]/g, function (d) {
                        return persianDigits[d];
                    });
                    v = v.replace(/[\u066B]/g, '.');          // ممیز عربی
                    return v.replace(/[^0-9.]/g, '');
                }

                function formatNumber(v) {
                    v = rawNumber(v);
                    var parts = v.split('.');
                    var intPart = parts[0].replace(/^0+(?=\d)/, '');
                    intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    if (parts.length > 1) {
                        return intPart + '.' + parts.slice(1).join('').substring(0, 2);
                    }
                    return intPart;
                }

                priceInput.setAttribute('inputmode', 'decimal');
                priceInput.setAttribute('autocomplete', 'off');
                priceInput.addEventListener('input', function () {
                    var pos = priceInput.selectionStart;
                    var before = priceInput.value.length;
                    priceInput.value = formatNumber(priceInput.value);
                    var after = priceInput.value.length;
                    try {
                        priceInput.setSelectionRange(pos + (after - before), pos + (after - before));
                    } catch (e) {
                    }
                });

                // قبل از ارسال فرم، کاماها حذف می‌شوند تا مقدار خام (بدون جداکننده) ذخیره شود
                var form = priceInput.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        priceInput.value = rawNumber(priceInput.value);
                    });
                }
            }
        })();
    </script>
@endsection
