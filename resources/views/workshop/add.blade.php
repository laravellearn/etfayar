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
            <form class="form" action="{{route('workshop.store')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$id}}">

                    <div id="kt_repeater_3">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>@lang('preinvoice.product')</label>
                            </div>
                            <div data-repeater-list="group_item" class="col-md-9">
                                @if(!empty($workshopItems))
                                    @foreach($workshopItems as $workshopItem)
                                        <div data-repeater-item="item_item" class="form-group row">
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <select class="form-control" name="fireExtinguisherPart_id">
                                                        <option value="null" disabled selected hidden>انتخاب قطعه
                                                            داغی...
                                                        </option>
                                                        @foreach($fireExtinguisherParts as $item)
                                                            <option {{$item->id==$workshopItem['fire_extinguisher_part_id']?'selected':''}} value="{{$item->id}}">{{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="input-group">
                                                    <input type="number" name="count" id="count" class="form-control" value="{{$workshopItem['count']}}" min="0"
                                                           placeholder="@lang('preinvoice.count')">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                            </div>

                                            <div class="col-lg-2">
                                                <a href="javascript:;" data-repeater-delete=""
                                                   class="btn font-weight-bold btn-danger btn-icon">
                                                    <i class="la la-remove"></i> </a>
                                            </div>
                                        </div>
                                    @endforeach

                                @else
                                    <div data-repeater-item="item_item" class="form-group row">

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <select class="form-control" name="fireExtinguisherPart_id">
                                                    <option value="null" disabled selected hidden>انتخاب قطعه داغی...
                                                    </option>
                                                    @foreach($fireExtinguisherParts as $item)
                                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-group">
                                                <input type="number" name="count" id="count" min="0" class="form-control"
                                                       placeholder="@lang('preinvoice.count')">
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn font-weight-bold btn-danger btn-icon">
                                                <i class="la la-remove"></i> </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9">


                            </div>
                            <div class="col">
                                <div data-repeater-create="" class="btn font-weight-bold btn-primary btn-block">
                                    <i class="la la-product-hunt"></i> @lang('preinvoice.add_product')
                                </div>
                                <span class="form-text text-muted"></span>

                            </div>
                        </div>
                    </div>

                    @php($title=__("workshop.description"))
                    @php($value=$workshop->description??'')
                    <x-InputText :title="$title" name="description" id="description" :value="$value"
                                 caption="" type="text" icon="bx bx-text">
                    </x-InputText>

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <script>


    </script>
@endsection
