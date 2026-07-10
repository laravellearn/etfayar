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

                            <x-Button permission="Add Product" :title="__('product.add')"
                                      url="{{route('product.create')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_banks">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('product.name')</th>
                                <th>نوع</th>
                                <th>@lang('product.code')</th>
                                <th>@lang('product.price')</th>
                                <th>@lang('product.quantity')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td nowrap>{{$item->title}}</td>
                                    <td nowrap>
                                    @if($item->type=="service")
                                    خدمت
                                    @elseif($item->type=="product")
                                    محصول
                                    @else
                                    تست
                                    @endif
                                    </td>
                                    <td nowrap>{{$item->code}}</td>
                                    <td nowrap>{{number_format($item->price)}}</td>
                                    <td nowrap>{{$item->quantity}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Edit Product"
                                                      url="{{route('product.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null"></x-FormButton>

                                        <x-FormButton permission="Delete Product" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/product/delete/{{$item->id}}')"></x-FormButton>


                                    </td>
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
