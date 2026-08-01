@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-10 offset-lg-1">
        <form class="form" action="{{route('transport.update')}}" method="post" autocomplete="off">

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

                    <br><br>
                    <h3 class="col-12 text-center text-nowrap m-auto"> @lang("user.contact_information")</h3>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">تلفن
                            مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg text-center">

                                <x-SimpleButton class="m-auto" permission="Access User Telephone"
                                                :title="__('common.call_telephone')"
                                                url="tel:{{$single->preinvoice->request->user->telephone??''}}"></x-SimpleButton>


                                {{-- <div class="input-group-prepend"><span class="input-group-text"><i
                                                 class="la la-phone"></i></span></div>
                                 <input type="text" class="form-control form-control-lg form-control-solid"
                                        value="{{$single->preinvoice->request->user->telephone}}" placeholder="تلفن">

                            --}}

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">تلفن
                            همراه مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg">
                                <x-SimpleButton permission="Access User Mobile"
                                                :title="__('common.call_mobile')"
                                                url="tel:{{$single->preinvoice->request->user->mobile??''}}"></x-SimpleButton>

                                {{--<div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-mobile"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{$single->preinvoice->request->user->mobile}}" placeholder="تلفن">--}}
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <h3 class="col-sm-12 text-center text-nowrap col-3 text-center m-auto"> @lang("user.customer_address")</h3>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">آدرس
                            مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="la la-location-arrow"></i></span></div>
                                <textarea type="text" class="form-control form-control-lg form-control-solid"
                                          placeholder="آدرس مشتری">{{$single->preinvoice->request->user->address->toStringAddress??''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 text-center text-nowrap col-xl-3 col-lg-3 col-form-label text-right">لوکیشن
                            مشتری</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg">
                                {{-- باگ ۴: لینک لوکیشن باید با https:// شروع شود تا در مرورگر به‌عنوان URL باز شود --}}
                                @php
                                    $rawLoc = $single->preinvoice->request->user->address->location ?? '';
                                    $locationUrl = (!empty($rawLoc) && !str_starts_with($rawLoc, 'http'))
                                        ? 'https://' . $rawLoc
                                        : $rawLoc;
                                @endphp
                                <x-SimpleButton permission="Access User Location"
                                                :title="__('transport.show_location')"
                                                target="_blank"
                                                url="{{$locationUrl}}"></x-SimpleButton>

                                {{--<div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-mobile"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       value="{{$single->preinvoice->request->user->mobile}}" placeholder="تلفن">--}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
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

        </form>
    </div>
@endsection
