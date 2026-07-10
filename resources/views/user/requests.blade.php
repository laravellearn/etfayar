@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                {{ $title }}
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('users') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> بازگشت به لیست کاربران
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-bordered table-striped"
                               id="kt_datatable_requests">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('request.code')</th>
                                    <th>@lang('request.user')</th>
                                    <th>@lang('request.service')</th>
                                    <th>@lang('request.expert')</th>
                                    <th>@lang('common.status')</th>
                                    <th>@lang('common.created_at')</th>
                                    <th>@lang('common.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td nowrap>{{ $item->code }}</td>
                                    <td nowrap>{{ $item->user->full_name ?? '' }}</td>
                                    <td nowrap>{{ $item->service->title ?? '' }}</td>
                                    <td nowrap>{{ $item->admin->full_name ?? '' }}</td>
                                    <td>
                                        <div class="{{ $item->statusValue->class }}">{{ $item->statusValue->title }}</div>
                                    </td>
                                    <td nowrap>{{ $item->persianDateTime }}</td>
                                    <td nowrap>
                                        <x-FormButton permission="Access Requests"
                                                      url="{{ route('request.show', $item->id) }}"
                                                      :icon="__('icon.show_icon')"
                                                      :title="__('common.show')"
                                                      click="null"/>
                                        <x-FormButton permission="Edit Request"
                                                      url="{{ route('request.edit', $item->id) }}"
                                                      :icon="__('icon.edit_icon')"
                                                      :title="__('common.edit')"
                                                      click="null"/>
                                        <x-FormButton permission="Delete Request"
                                                      url="javascript:;"
                                                      :icon="__('icon.delete_icon')"
                                                      :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/request/delete/{{$item->id}}')"/>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">هیچ درخواستی برای این کاربر یافت نشد.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection