@extends('layout.main')@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        {{--   <span class="example-toggle" data-toggle="tooltip" title="" data-original-title="مشاهد کد"></span>
                           <span class="example-copy" data-toggle="tooltip" title="" data-original-title="کپی کد"></span>--}}

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form autocomplete="off" class="form" action="{{route('transport.updateChargeReceipts')}}" method="post"
                  enctype="multipart/form-data">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" value="{{$single->id}}">


                    @php($title=__("transport.collect_description"))
                    @php($caption=__(""))
                    @php($value=$single->collect_description??'')
                    <x-InputText :title="$title" name="collect_description" id="additional_description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>


                    @php($title=__("transport.charge_receipts"))
                    @php($caption='')
                    @php($value=$single->charge_receipt_file)

                    <x-InputRow :title="$title" name="charge_receipt_file" id="charge_receipt_file" :value="$value"
                                :caption="$caption" type="file"
                                icon="bx bx-tax">
                    </x-InputRow>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label>کنسل شدن : </label>
                            </div>
                            <div class="col-md-9">
                                <div class="">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="is_cancel">
                                        <span></span>

                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 mt-10">
                                <label>تصویر رسید شارژ : </label>
                            </div>
                            <div class="col-md-9">
                                <a href="{{ asset('/storage/'.$single->charge_receipt_file) }}" target="_blank">
                                    <img class="img-thumbnail w-100px"
                                         src="{{ asset('/storage/'.$single->charge_receipt_file) }}"
                                         alt="">
                                </a>
                            </div>

                        </div>
                    </div>


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <script>
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: true
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , pastYearsCount: 0
            , futureYearsCount: 3
            , markToday: true
            , markHolidays: false
            , highlightSelectedDay: false
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('visit_date', customOptions);
    </script>
@endsection
