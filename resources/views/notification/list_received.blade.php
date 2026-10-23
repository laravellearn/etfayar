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

                        @foreach([
                            ['key' => 'unread', 'items' => $unread_list, 'tid' => 'kt_datatable_requests'],
                            ['key' => 'read', 'items' => $read_paginator, 'tid' => 'kt_datatable_requests_read'],
                        ] as $group)
                            <h4 class="mb-4 {{ $group['key'] == 'unread' ? '' : 'mt-10' }}" @if($group['key'] == 'read') id="read-list" @endif>
                                @if($group['key'] == 'unread')
                                    <span class="label label-lg label-light-danger label-inline font-weight-bold">
                                        @lang('notification.unread_list') ({{ count($group['items']) }})
                                    </span>
                                @else
                                    <span class="label label-lg label-light-success label-inline font-weight-bold">
                                        @lang('notification.read_list') ({{ $read_paginator->total() }})
                                    </span>
                                @endif
                            </h4>

                            <!--begin: جدول داده ها-->
                            <table class="table table-separate table-head-custom table-bordered table-striped"
                                   id="{{ $group['tid'] }}">
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
                                @forelse($group['items'] as $item)
                                    <tr class="{{ $group['key'] == 'unread' ? 'font-weight-bolder' : '' }}">
                                        <td nowrap>{{$item->id}}</td>
                                        <td nowrap>{{$item->sender->full_name??''}}</td>
                                        <td nowrap>{{$item->title??''}}</td>
                                        <td>{{$item->body??''}}</td>
                                        <td nowrap>
                                            @if($group['key'] == 'unread')
                                                <div class="label label-lg font-weight-bold label-light-danger label-inline">@lang('notification.unread')</div>
                                            @else
                                                <div class="label label-lg font-weight-bold label-light-success label-inline">@lang('notification.read')</div>
                                            @endif
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
                            @if($group['key'] == 'read' && $read_paginator->hasPages())
                                <div class="d-flex justify-content-center mt-5">
                                    {{ $read_paginator->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                            @if(count($group['items']) == 0)
                                <div class="text-center text-muted mb-5">
                                    {{ $group['key'] == 'unread' ? __('notification.no_unread') : __('notification.no_read') }}
                                </div>
                            @endif
                            <!--end: جدول داده ها-->
                        @endforeach
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
