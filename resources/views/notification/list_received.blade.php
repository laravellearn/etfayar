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

                        {{-- باگ ۹: بخش جداگانه برای اعلان‌های نخوانده --}}
                        <h5 class="font-weight-bold text-danger mb-3">
                            اعلان‌های نخوانده
                            <span class="label label-danger label-inline ml-2">{{ count($unreadList) }}</span>
                        </h5>
                        <table class="table table-separate table-head-custom table-bordered table-striped mb-10"
                               id="kt_datatable_unread">
                            <thead>
                            <tr>
                                <th>@lang('notification.id')</th>
                                <th>@lang('notification.sender')</th>
                                <th>@lang('notification.title')</th>
                                <th>@lang('notification.body')</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($unreadList as $item)
                                <tr class="table-warning">
                                    <td nowrap>{{$item->id}}</td>
                                    <td nowrap>{{$item->sender->full_name??''}}</td>
                                    <td nowrap><strong>{{$item->title??''}}</strong></td>
                                    <td>{{$item->body??''}}</td>
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
                                <tr><td colspan="6" class="text-center text-muted">اعلان نخوانده‌ای وجود ندارد</td></tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{-- باگ ۹: بخش جداگانه برای اعلان‌های خوانده‌شده --}}
                        <h5 class="font-weight-bold text-muted mb-3">
                            اعلان‌های خوانده‌شده
                            <span class="label label-secondary label-inline ml-2">{{ count($readList) }}</span>
                        </h5>
                        <table class="table table-separate table-head-custom table-bordered table-striped"
                               id="kt_datatable_read">
                            <thead>
                            <tr>
                                <th>@lang('notification.id')</th>
                                <th>@lang('notification.sender')</th>
                                <th>@lang('notification.title')</th>
                                <th>@lang('notification.body')</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($readList as $item)
                                <tr>
                                    <td nowrap>{{$item->id}}</td>
                                    <td nowrap>{{$item->sender->full_name??''}}</td>
                                    <td nowrap>{{$item->title??''}}</td>
                                    <td>{{$item->body??''}}</td>
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
                                <tr><td colspan="6" class="text-center text-muted">اعلان خوانده‌شده‌ای وجود ندارد</td></tr>
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
