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

                            <x-Button permission="Add Bank" :title="__('bank.add')"
                                      url="{{route('bank.create')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_banks">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('bank.name')</th>
                                <th>@lang('bank.account')</th>
                                <th>@lang('bank.cart_code')</th>
                                <th>@lang('bank.sheba')</th>
                                <th>@lang('user.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td nowrap>{{$item->name}}</td>
                                    <td nowrap>{{$item->account}}</td>
                                    <td nowrap>{{$item->cart_code}}</td>
                                    <td nowrap>{{$item->sheba}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Edit Bank"
                                                      url="{{route('bank.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null"></x-FormButton>

                                        <x-FormButton permission="Delete Bank" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/bank/delete/{{$item->id}}')"></x-FormButton>


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
