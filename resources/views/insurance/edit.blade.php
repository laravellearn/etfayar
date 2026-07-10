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
            <form class="form" action="{{route('insurance.update')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$single->id}}">

                    <x-InputRow title="شماره" name="number" id="number" :value="$single->number" caption=""
                                type="number" :min="0" icon="bx bx-calculator"/>

                    <div id="title_block" class="form-group row">
                        <label class="col-3">انتخاب فروشنده <strong>*</strong></label>
                        <div class="col-9">
                            <select id="information_id" class="form-control form-control" name="information_id"
                                    onchange="fir(this)">
                                <option value="" disabled selected hidden>انتخاب فروشنده...</option>
                                @foreach($informations as $item)
                                    <option
                                        {{$item->id==$single->information_id?'selected':''}}  value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("request.choose_user") <strong>*</strong></label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="user_id" data-size="5"
                                    data-live-search="true"
                                    data-fv-not-empty="true"
                                    data-fv-not-empty___message="@lang('request.choose_user')..."
                                    required>
                                <option value="" disabled selected hidden>@lang('request.choose_user')...</option>
                                @foreach($users as $item)
                                    <option {{ $single->user_id==$item->id?'selected':'' }} value="{{ $item->id }}">
                                        #{{ $item->customer_code }}     {{ $item->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <x-InputRow title="تاریخ شارژ" name="charge_time" id="charge_time"
                                :value="$single->persianChargeTime"
                                caption="" type="text"
                                icon="bx bx-calendar">
                    </x-InputRow>

                    <x-InputRow title="تاریخ شارژ مجدد" name="recharge_time" id="recharge_time"
                                :value="$single->persianRechargeTime"
                                caption="" type="text"
                                icon="bx bx-calendar">
                    </x-InputRow>
                    <hr>
                    <div id="kt_repeater_4">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>انتخاب کپسول ها</label>
                            </div>
                            <div data-repeater-list="group_items" class="col-md-9">
                                @if(isset($single->items) && count($single->items)>0)
                                    @foreach($single->items as $item)
                                        <div data-repeater-item="item-item" class="form-group row">

                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <select class="form-control" name="product_id">
                                                            <option value="null" disabled selected hidden>انتخاب محصول...
                                                            </option>
                                                            @foreach($products as $product)
                                                                <option
                                                                    {{$item->product_id==$product->id?'selected':''}}  value="{{$product->id}}">{{$product->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="input-group">
                                                        <input type="number" name="number" id="number" class="form-control"
                                                               value="{{$item->number}}" min="0"
                                                               placeholder="شماره">
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <a href="javascript:;" data-repeater-delete=""
                                                       class="btn font-weight-bold btn-danger btn-icon">
                                                        <i class="la la-remove"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div data-repeater-item="item-item" class="form-group row">

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <select class="form-control" name="product_id">
                                                        <option value="null" disabled selected hidden>انتخاب محصول...
                                                        </option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="input-group">
                                                    <input type="number" name="number" id="number" class="form-control"
                                                           value="{{$item->number}}" min="0"
                                                           placeholder="شماره">
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <a href="javascript:;" data-repeater-delete=""
                                                   class="btn font-weight-bold btn-danger btn-icon">
                                                    <i class="la la-remove"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif



                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9"></div>
                            <div class="col">
                                <div data-repeater-create="" class="btn font-weight-bold btn-primary btn-block">
                                    <i class="la la-file-text"></i> @lang('description.add')
                                </div>
                                <span class="form-text text-muted"></span>

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
        kamaDatepicker('charge_time', customOptions);
        kamaDatepicker('recharge_time', customOptions);
    </script>
@endsection
