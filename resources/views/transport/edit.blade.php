@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-10 offset-lg-1">
        <form class="form" action="{{route('transport.update')}}" method="post" autocomplete="off">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif
            @include('partials.form_error')


            @csrf
            <input type="hidden" name="id" value="{{$single->id}}">

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">تعیین وضعیت
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="status_block" class="form-group row">
                        <label class="col-3">@lang("common.status") <strong>*</strong></label>
                        <div class="col-9">
                            @php($items=[
                                       ['title'=>'در انتظار تعیین وضعیت','value'=>'waiting'],
                                       ['title'=>'جمع آوری','value'=>'collect'],
                                       ['title'=>'تحویل به مشتری','value'=>'delivery'],
                                       ['title'=>'لغو','value'=>'cancel'],
                                  ])
                            <select id="transport_status" class="form-control" name="status">
                                @foreach($items as $item)
                                    <option
                                        {{$single->status==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="collect_driver_block" class="form-group row">
                        <label class="col-3">@lang("transport.collect_driver_name") <strong>*</strong></label>
                        <div class="col-9">
                            <select id="collect_driver_id" class="form-control" name="collect_driver_id">
                                <option value="" disabled selected hidden>انتخاب راننده جمع آوری...</option>
                                @foreach($drivers as $driver)
                                    <option
                                        {{$single->collect_driver_id==$driver->id?'selected':''}} value="{{$driver->id}}">{{$driver->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div id="delivery_driver_block" class="form-group row">
                        <label class="col-3">@lang("transport.delivery_driver_name") <strong>*</strong></label>
                        <div class="col-9">
                            <select id="delivery_driver_id" class="form-control" name="delivery_driver_id">
                                <option value="" disabled selected hidden>انتخاب راننده تحویل...</option>
                                @foreach($drivers as $driver)
                                    <option
                                        {{$single->delivery_driver_id==$driver->id?'selected':''}} value="{{$driver->id}}">{{$driver->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
            </div>

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

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات جمع
                        آوری</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @php($title=__("transport.collect_description"))
                    @php($caption=__(""))
                    @php($value=$single->collect_description)
                    <x-InputText :title="$title" name="collect_description" id="collect_description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text" disabled="disabled"></x-InputText>


                    <div class="form-group row">
                        <label class="col-3">@lang("transport.collect_driver_name")</label>
                        <div class="col-9">
                            <select id="collect_driver_id" class="form-control" name="collect_driver_id" disabled>
                                <option value="" disabled selected hidden>انتخاب راننده جمع آوری...</option>
                                @foreach($drivers as $driver)
                                    <option
                                        {{$single->collect_driver_id==$driver->id?'selected':''}} value="{{$driver->id}}">{{$driver->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("transport.collect_status")</label>
                        <div class="col-9">
                            <div
                                class="{{$single->transportCollectStatusValue->class}}">{{$single->transportCollectStatusValue->title}}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("transport.collect_time")</label>
                        <div class="col-9">
                            <div>{{$single->persianCollectTime??'-'}}</div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات تحویل</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @php($title=__("transport.delivery_description"))
                    @php($caption=__(""))
                    @php($value=$single->delivery_description)
                    <x-InputText :title="$title" name="delivery_description" id="delivery_description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text" disabled="disabled"></x-InputText>


                    <div class="form-group row">
                        <label class="col-3">@lang("transport.delivery_driver_name")</label>
                        <div class="col-9">
                            <select id="delivery_driver_id" class="form-control" name="delivery_driver_id" disabled>
                                <option value="" disabled selected hidden>انتخاب راننده تحویل...</option>
                                @foreach($drivers as $driver)
                                    <option
                                        {{$single->delivery_driver_id==$driver->id?'selected':''}} value="{{$driver->id}}">{{$driver->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("transport.delivery_status")</label>
                        <div class="col-9">
                            <div
                                class="{{$single->transportDeliveryStatusValue->class}}">{{$single->transportDeliveryStatusValue->title}}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("transport.delivery_time")</label>
                        <div class="col-9">
                            <div>{{$single->persianDeliveryTime??'-'}}</div>
                        </div>
                    </div>


                </div>
            </div>


            @include('partials.card_footer')

        </form>
    </div>
    <script>
        let transport_status = ['waiting', 'collect', 'delivery', 'cancel'];
        let preinvoice_status_value = document.getElementById("transport_status").options[document.getElementById("transport_status").selectedIndex].value;

        if (preinvoice_status_value === transport_status[0]) {
            document.getElementById("collect_driver_block").style.display = "none";
            document.getElementById("delivery_driver_block").style.display = "none";
        } else if (preinvoice_status_value === transport_status[1]) {
            document.getElementById("collect_driver_block").style.display = "flex";
            document.getElementById("delivery_driver_block").style.display = "none";
        } else if (preinvoice_status_value === transport_status[2]) {
            document.getElementById("collect_driver_block").style.display = "none";
            document.getElementById("delivery_driver_block").style.display = "flex";
        } else if (preinvoice_status_value === transport_status[3]) {
            document.getElementById("collect_driver_block").style.display = "none";
            document.getElementById("delivery_driver_block").style.display = "none";
        }


        document.getElementById("transport_status").addEventListener("change", function (event) {
            if (event.target.value === transport_status[0]) {
                document.getElementById("collect_driver_block").style.display = "none";
                document.getElementById("delivery_driver_block").style.display = "none";
            } else if (event.target.value === transport_status[1]) {
                document.getElementById("collect_driver_block").style.display = "flex";
                document.getElementById("delivery_driver_block").style.display = "none";
            } else if (event.target.value === transport_status[2]) {
                document.getElementById("collect_driver_block").style.display = "none";
                document.getElementById("delivery_driver_block").style.display = "flex";
            } else if (event.target.value === transport_status[3]) {
                document.getElementById("collect_driver_block").style.display = "none";
                document.getElementById("delivery_driver_block").style.display = "none";
            }
        });


    </script>
@endsection
