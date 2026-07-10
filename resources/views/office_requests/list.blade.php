@extends('layout.main')
@section('title', $title)
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

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center" id="kt_datatable_officeRequests">
                            <thead>
                            <tr>
                                <th>@lang('office_request.title')</th>
                                <th>@lang('office_request.number')</th>
                                <th>@lang('office_request.applicant')</th>
                                <th>@lang('office_request.status')</th>
                                <th>@lang('office_request.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)

                                <tr>
                                    <td>{{$item->officeForm->title}}</td>
                                    <td>{{$item->number}}</td>
                                    <td>{{$item->applicant->fullname}}</td>
                                    <td nowrap>
                                        <div
                                            class="{{ $item->statusValue->class }}">{{ $item->statusValue->title }}
                                        </div>
                                    </td>
                                    <td nowrap>{{$item->persianDateTime}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Edit Office Request"
                                                      url="{{route('office_request.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')"
                                                      :title="__('office_request.edit')"
                                                      click="null">
                                        </x-FormButton>

                                    </td>
                                </tr>
                            @empty


                            @endforelse
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
