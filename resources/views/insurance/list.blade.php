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

                            <x-Button permission="Add Insurance" :title="__('insurance.add')"
                                      url="{{route('insurance.create')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_insurances">
                            <thead>
                          {{--  <tr>

                                <div class="row p-3">
                                    <form action="{{route('insurance.filter')}}" method="post">
                                        @csrf
                                        <div class="col-4"><input type="number" class="form-control" name="min" id="min"
                                                                  placeholder="از شماره" min="0"></div>
                                        <div class="col-4"><input type="number" class="form-control" name="max" id="max"
                                                                  placeholder="تا شماره" min="0"></div>
                                        <div class="col-4">
                                            <button type="submit"
                                                    class="btn btn-primary mr-2">@lang('insurance.filter')</button>

                                        </div>
                                    </form>
                                </div>


                            </tr>--}}
                            <tr>
                                <th>#</th>
                                <th>@lang('insurance.information_id')</th>
                                <th>@lang('insurance.user_id')</th>
                                <th>@lang('insurance.number')</th>
                                <th>@lang('insurance.charge_time')</th>
                                <th>@lang('insurance.recharge_time')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td nowrap>{{$item->information->name}}</td>
                                    <td nowrap>{{$item->user->full_name}}</td>
                                    <td nowrap>ب{{$item->number}}</td>
                                    <td nowrap>{{$item->persianChargeTime}}</td>
                                    <td nowrap>{{$item->persianRechargeTime}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Access Insurance Pdf"
                                                      url="{{route('insurance.show_pdf',$item->id)}}"
                                                      :icon="__('icon.official_invoice_icon')" :title="__('insurance.show_pdf')"
                                                      click="null"></x-FormButton>

                                        <x-FormButton permission="Edit Insurance"
                                                      url="{{route('insurance.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null"></x-FormButton>

                                        <x-FormButton permission="Delete Insurance" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/insurance/delete/{{$item->id}}')"></x-FormButton>

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
