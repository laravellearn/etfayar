@extends('layout.main')
@section('title', $single->title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    {{$single->title}} </h3>
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
            <form class="" action="{{route($single->action)}}" method="{{$single->method}}"
                  enctype="{{$single->enctype}}">
                <div class="card-body">
                    @csrf

                    <input type="hidden" class="form-control" name="form_title" value="{{ $single->title }}">
                    <input type="hidden" class="form-control" name="office_form_id" value="{{ $single->form_id }}">
                    <input type="hidden" class="form-control" name="form_id" value="{{ $single->id }}">


                    @foreach($items as $item)

                        <div class="row mt-4">
                            @if($item->type!='hidden')

                                <div class="col-md-3">
                                    <label>{{$item->label}}</label>
                                </div>
                            @endif
                            <div class="col-md-9">

                                @if($item->element=='select')
                                    <select class="{{ $item->class }} form-control" name="{{ $item->name }}" id="{{ $item->element_id }}">
                                        @php
                                            echo $item->value;
                                        @endphp
                                    </select>
                                @endif

                                @if($item->element=='select2')
                                        <select class="{{ $item->class }} form-control selectpicker" name="{{ $item->name }}" id="{{ $item->element_id }}" data-size="5"
                                                data-live-search="true"
                                                data-fv-not-empty="true"
                                                data-fv-not-empty___message="لطفاانتخاب نمایید"
                                                required>
                                            <option value="null" disabled selected hidden>انتخاب ...</option>
                                            @foreach($admins as $item)
                                                <option value="{{$item->id}}">{{$item->fullname}}</option>
                                            @endforeach
                                        </select>
                                @endif

                                @if($item->element=='input')
                                    <div class="">
                                        <{{ $item->element }} type
                                        ="{{ $item->type }}" class="{{ $item->class }} form-control" name="{{ $item->name }}"
                                        id="{{ $item->element_id }}" placeholder="{{ $item->placeholder }}" min=
                                        0 {{($item->type=='file' && $item->is_multiple) ? 'multiple':''}}>
                                        <div class="form-control-position">
                                            @if( $item->type=='file' && isset($item->value) )
                                                <img class="rounded-circle" src="{{ asset($item->value) }}" alt="avatar"
                                                     height="32"
                                                     width="32">
                                            @else
                                                <i class="{{ $item->icon }}"></i>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($item->element=='textarea')
                                    <div class="">
                                            <textarea type="{{ $item->type }}" class="{{ $item->class }} form-control"
                                                      name="{{ $item->name }}"
                                                      id="{{ $item->element_id }}"
                                                      rows="5"
                                                      placeholder="{{ $item->placeholder }}"></textarea>

                                    </div>
                                @endif

                                @if($item->element=='input_date')
                                    <div class="">
                                        <input type="{{ $item->type }}" class="{{ $item->class }} form-control" name="{{ $item->name }}"
                                               id="{{ $item->element_id }}" placeholder="{{ $item->placeholder }}"
                                               min=0>
                                        <div class="form-control-position">
                                            @if( $item->type=='file' && isset($item->value) )
                                                <img class="rounded-circle" src="{{ asset($item->value) }}" alt="avatar"
                                                     height="32"
                                                     width="32">
                                            @else
                                                <i class="{{ $item->icon }}"></i>
                                            @endif
                                        </div>
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
                                        kamaDatepicker("{{ $item->element_id }}", customOptions);
                                    </script>
                                @endif
                            </div>


                        </div>

                    @endforeach


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
