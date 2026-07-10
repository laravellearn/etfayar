@extends('layout.main')@section('title', $title)
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <style>
            table.dataTable td {
                font-size: 0.4em;
            }

            th {
                font-size: 10px!important;
                padding: 7px!important;
            }
            td {
                font-size: 12px!important;
                padding: 7px!important;
            }

            td div{
                font-size: 10px!important;
                /*padding: 5px!important;*/
            }


        </style>

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

                            <x-Button permission="Add Message" :title="__('message_report.add')"
                                      url="{{route('message.create')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_message_reports">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>@lang('message_report.user_id')</th>
                                <th>@lang('message_report.admin_id')</th>
                                <th>@lang('message_report.text')</th>
                                <th>@lang('message_report.receiver_mobile')</th>
                                <th>@lang('message_report.type')</th>
                                <th>@lang('message_report.status')</th>
                                <th>@lang('message_report.created_at')</th>
                                 <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$item->user->full_name??''}}</td>
                                    <td>{{$item->admin->full_name??''}}</td>
                                    <td>{{$item->text??''}}</td>
                                    <td>{{$item->receiver_mobile??''}}</td>
                                    <td nowrap>
                                        <div class="{{ $item->typeValue->class }}">{{ $item->typeValue->title }}</div>
                                    </td>
                                    <td class="btn-text-dark-65"><p>{{$item->response??''}}</p></td>
                                    <td>{{$item->persianDateTime}}</td>
                                    <td>

                                        <x-FormButton permission="Delete Message Report" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/message_report/delete/{{$item->id}}')"></x-FormButton>

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
