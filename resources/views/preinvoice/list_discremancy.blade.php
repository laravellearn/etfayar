@extends('layout.main')@section('title', $title)
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                {{$title}}
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <x-Button permission="Access Products" :title="__('preinvoice.go_to_products')"
                                 btnClass="btn-light-success"     url="{{route('products')}}"></x-Button>

                            <x-Button permission="Edit Preinvoice" :title="__('preinvoice.back_to_preinvoice')"
                                      url="{{route('preinvoice.edit',$id)}}"></x-Button>


                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-bordered table-head-custom datatable-head-bg text-center"
                               id="kt_datatable_choose_products">
                            <thead>
                            <tr>
                                <th class="text-black">@lang('product.name')</th>
                                <th class="text-black">@lang('product.code')</th>
                                <th class="text-black">@lang('product.preinvoice_product_count')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>
                                        {{$item->title}}
                                        <br>
                                        <span class="label label-secondary label-inline mr-3 ml-2 mt-3"> تعداد موجود در انبار :  <strong>&nbsp;{{$item->product->quantity}}&nbsp;</strong>  عدد  </span>
                                    </td>
                                    <td>{{$item->product->code}}</td>
                                    <td class="justify-content-center">
                                        {{$item->count}}
                                        {{-- <input type="number" name="count" id="count"
                                                class="form-control count"
                                                min="0"
                                                value="{{$item->count}}"
                                                --}}{{--max="{{$item->quantity}}"--}}{{--
                                                placeholder="@lang('preinvoice.count')">--}}
                                    </td>
                                    {{--<td>
                                        --}}{{-- {{number_format($item->price)}}--}}{{--
                                       --}}{{-- <input type="number" name="price" id="price"
                                               class="form-control price"
                                               min="0"
                                               value="{{$item->price}}">--}}{{--

                                    </td>--}}

                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                        <!--end: جدول داده ها-->

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
