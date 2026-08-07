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
                        <table class="table table-separate table-head-custom table-bordered table-striped"
                               id="kt_datatable_requests">
                            <thead>
                            <tr>
                                <th>@lang('notification.id')</th>
                                <th>@lang('notification.sender')</th>
                                <th>@lang('notification.title')</th>
                                <th>@lang('notification.body')</th>
                                <th>@lang('common.status')</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)

                                <tr>
                                    <td nowrap>{{$item->id}}</td>
                                    <td nowrap>{{$item->sender->full_name??''}}</td>
                                    <td nowrap>{{$item->title??''}}</td>
                                    <td>{{$item->body??''}}</td>
                                    <td>
                                        <div class="{{$item->statusValue->class}}">{{$item->statusValue->title}}</div>
                                    </td>
                                    <td nowrap>{{$item->persianDateTime}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Access Received Notifications"
                                                      url="{{route('notification.open',$item->id)}}"
                                                      :icon="__('icon.show_icon')"
                                                      :title="__('common.show')"
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

    {{--
        @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>

        @endif
    --}}

@endsection
