@extends('layout.main')@section('title', $title.' ' .$single->title)
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Card-->
                <div class="card card-custom overflow-hidden">
                    <div class="card-body p-0">
                        <!-- begin: فاکتور-->

                        {{--     @if(!is_null($single->header))
                                 <img style="width: 100%;margin-bottom: 10px;"
                                      src="{{asset('storage/'.$single->header)}}" alt="">
                             @endif--}}


                        <!-- begin: فاکتور header-->
                        <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-4 px-8 py-md-10 px-md-0"
                             {{--style="background-image: url({{asset('storage/'.$single->header)??''}});">--}}
                             style="background-image: url({{asset('media/bg/bg-6.jpg')}});">
                            <div class="col-md-11">
                                <div class=" d-flex justify-content-center pb-10 pb-md-20 flex-column">
                                    <h1 class="display-4 font-weight-boldest mb-5 text-black mt-10">پیش
                                        فاکتور</h1>
                                    <h4 class=" mb-3 text-black-50">{{$single->title}}</h4>
                                    <div class="d-flex flex-column align-items-md-end px-0">
                                        <!--begin::Logo-->
                                        <a href="#" class="mb-5">
                                            <img src="{{asset('storage/'.$single->logo)}}" alt=""> </a>
                                        <!--end::Logo-->
                                        <span class="text-white d-flex flex-column align-items-md-end opacity-70"></span>
                                    </div>
                                </div>
                                <div class="border-bottom w-100 opacity-20"></div>
                                <div class="d-flex justify-content-between text-white text-center pt-6">
                                    <div class="d-flex flex-column flex-root">
                                        <span class="font-weight-bolder mb-2 text-black-50">تاریخ</span>
                                        <span class="opacity-70 text-black-50">{{$single->persianDateTime}}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-root">
                                        <span class="font-weight-bolder mb-2 text-black-50">شماره فاکتور</span>
                                        <span class="opacity-70 text-black-50">{{$single->code}}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-root">
                                        <span class="font-weight-bolder mb-2 text-black-50">آدرس خریدار</span>
                                        @if(isset($single->request->user->address))
                                            <span
                                                class="opacity-70 text-black-50">{{$single->request->user->address->city->province->name}} {{$single->request->user->address->city->name}}</span>
                                            <span class="opacity-70 text-black-50">{{$single->request->user->address->area}}</span>
                                            <span class="opacity-70 text-black-50">{{$single->request->user->address->address}}</span>
                                            <span
                                                class="opacity-70 text-black-50"> کد پستی : {{$single->request->user->address->postal_code}}</span>
                                        @else
                                            <span class="opacity-70 text-black-50">ثبت نشده است</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: فاکتور header-->
                        <!-- begin: فاکتور body-->
                        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="pl-0 font-weight-bold text-muted  text-uppercase">شرح کالا</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">تعداد</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">قیمت واحد
                                                ( @lang('common.pricePrefix'))
                                            </th>
                                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">قیمت
                                                کل ( @lang('common.pricePrefix'))
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($itemList as $item)
                                            <tr class="font-weight-boldest font-size-lg">
                                                <td class="pl-0 pt-7">{{$item['title']}}</td>
                                                <td class="text-right pt-7">{{$item['count']}}</td>
                                                <td class="text-right pt-7">{{number_format($item['price'], 0, '.', ',')}}</td>
                                                <td class="text-danger pr-0 pt-7 text-right">{{number_format($item['count']*$item['price'], 0, '.', ',')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end: فاکتور body-->

                        <!-- begin: فاکتور footer-->
                        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-9">
                                <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
                                    <div class="d-flex flex-column mb-10 mb-md-0">
                                        <div class="font-weight-bolder font-size-lg mb-3">مشخصات خریدار</div>

                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="mr-15 font-weight-bold">نام خریدار:</span>
                                            <span class="text-right">{{$single->request->user->full_name??''}}</span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="mr-15 font-weight-bold">شماره خریدار:</span>
                                            <span
                                                class="text-right">{{$single->request->user->customer_code??''}}</span>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <span class="mr-15 font-weight-bold">کد پیش فاکتور:</span>
                                            <span class="text-right">{{$single->code}}</span>
                                        </div>
                                    </div>


                                    <div class="d-flex flex-column text-md-right">
                                        <span class="font-size-lg font-weight-bolder mb-1">مبلغ کل فاکتور</span>
                                        <span
                                            class="font-size-h4 font-weight-light text-success mb-1">{{number_format($totalPrice, 0, '.', ',')}} @lang('common.pricePrefix')</span>
                                        <span>مالیات : {{$single->tax}} @lang('common.taxSuffix')</span>
                                    </div>


                                    <div class="d-flex flex-column text-md-right">
                                        <span class="font-size-lg font-weight-bolder mb-1">مبلغ قابل پرداخت  با احتساب مالیات</span>
                                        <span
                                            class="font-size-h2 font-weight-boldest text-danger mb-1">{{number_format($paymentPrice, 0, '.', ',')}} @lang('common.pricePrefix')</span>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <!-- end: فاکتور footer-->

                        <div class="d-flex justify-content-evenly  py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <ul>
                                    @foreach($descriptions as $desc)
                                        <li class="p-1 font-weight-bolder">{{$desc->description->description}}</li>
                                    @endforeach
                                    <li class="p-1 font-weight-bolder">{{$single->description??''}}</li>
                                </ul>

                            </div>
                        </div>


                        <img style="float: left; width: 20%;background-color: #ffffff;margin-bottom: 10px;"
                             src="{{asset('storage/'.$single->sign)}}" alt="">

                        <!-- begin: فاکتور action-->
                        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 d-print-none">
                            <div class="col-md-9">
                                <div class="d-flex justify-content-between">
                                    {{--<button type="button" class="btn btn-light-primary font-weight-bold"
                                            onclick="window.print();">دانلود فاکتور
                                    </button>--}}
                                    <button type="button" class="btn btn-primary font-weight-bold"
                                            onclick="window.print();">چاپ فاکتور
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end: فاکتور action-->


                        <img style="float: left; width: 100%;background-color: #ffffff;margin-bottom: 10px;"
                             src="{{asset('storage/'.$single->footer)}}" alt="">


                        <!-- end: فاکتور-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection
