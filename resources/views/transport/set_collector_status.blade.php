@extends('layout.main')@section('title', $title)
@section('content')
    <div class="col-lg-12">

        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات ثبت شده در
                    هنگام ثبت درخواست
                    :</h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">


                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-3">@lang('preinvoice.is_fiduciary')</label>
                    <div class="radio-inline">

                        @if(isset($single))

                            @if($single->is_fiduciary==0)
                                <label class="radio radio-lg">
                                    <input type="radio" value="0" checked="checked" name="is_fiduciary" disabled/>
                                    <span></span> خیر </label>

                                <label class="radio radio-lg">
                                    <input type="radio" value="1" name="is_fiduciary" disabled/>
                                    <span></span> بله </label>
                            @else
                                <label class="radio radio-lg">
                                    <input type="radio" value="0" name="is_fiduciary" disabled/>
                                    <span></span> خیر </label>

                                <label class="radio radio-lg">
                                    <input type="radio" value="1" checked="checked" name="is_fiduciary" disabled/>
                                    <span></span> بله </label>
                            @endif
                        @else
                            <label class="radio radio-lg">
                                <input type="radio" value="0" checked="checked" name="is_fiduciary" disabled/>
                                <span></span> خیر </label>

                            <label class="radio radio-lg">
                                <input type="radio" value="1" name="is_fiduciary" disabled/>
                                <span></span> بله </label>
                        @endif


                    </div>

                </div>

                @php($title=__("transport.description"))
                @php($caption=__(""))
                @php($value=$single->description)
                <x-InputText :title="$title" name="description" id="description" :value="$value" :caption="$caption"
                             type="text" icon="bx bx-text" disabled="disabled"></x-InputText>

                @php($title=__("preinvoice.visit_date"))
                @php($caption='')
                @php($value=$single->persianVisitDate??'')
                <x-InputRow :title="$title" name="visit_date" id="visit_date" :value="$value" :caption="$caption"
                            type="text"
                            icon="bx bx-calendar" disabled="disabled">
                </x-InputRow>


                @php($title=__("preinvoice.visit_time"))
                @php($caption='')
                @php($value=$single->visitTimeRangeText??'')
                <x-InputRow dir="ltr" :title="$title" name="visit_time" id="visit_time" :value="$value"
                            :caption="$caption" type="text"
                            icon="bx bx-time" disabled="disabled">
                </x-InputRow>


                @php($title=__("preinvoice.delivery_duration"))
                @php($caption='')
                @php($value=$single->delivery_duration??'')
                <x-InputRow :title="$title" name="delivery_duration" id="delivery_duration" :value="$value"
                            :caption="$caption"
                            type="number"
                            icon="bx bx-duration" disabled="disabled">
                </x-InputRow>

                <!--begin: جدول داده ها-->
                <table class="table table-bordered table-vertical-center table-light-white table-head-custom"
                       id="kt_datatable_role">
                    <thead>
                    <tr>
                        <th>شرح کالا</th>
                        <th>تعداد</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($single->preinvoice->items as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->count}}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <!--end: جدول داده ها-->


            </div>
        </div>
        <!--end::Card-->

        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">تعیین راننده جمع آوری کننده</h3>
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
            <form class="form" action="{{route('transport.update_collector_status')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$single->id}}">

                   {{-- <div id="collect_status_block" class="form-group row">
                        <label class="col-3">@lang("transport.collect_status") <strong>*</strong></label>
                        <div class="col-9">
                            @php($items=[
                                       ['title'=>'در انتظار تعیین راننده','value'=>'waiting_for_set_collector'],
                                       ['title'=>'در انتظار جمع آوری','value'=>'pending_collect'],
                                       ['title'=>'جمع آوری شده','value'=>'collected'],
                                       ['title'=>'لغو','value'=>'cancel'],
                                  ])
                            <select id="collect_status" class="form-control" name="collect_status">
                                @foreach($items as $item)
                                    <option
                                        {{$single->collect_status==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>--}}

                    <div id="collect_driver_block" class="form-group row">
                        <label class="col-3">@lang("transport.collect_driver_name") <strong>*</strong></label>
                        <div class="col-9">
                            <select id="collect_driver" class="form-control" name="collect_driver_id">
                                <option value="" disabled selected hidden>انتخاب راننده جمع آوری...</option>
                                @foreach($drivers as $driver)
                                    <option
                                        {{$single->collect_driver_id==$driver->id?'selected':''}} value="{{$driver->id}}">{{$driver->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
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
