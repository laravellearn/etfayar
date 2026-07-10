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
                                @lang('user.permissions')
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">

                            <x-Button permission="Add Permission" :title="__('user.add_permission')"
                                      url="{{route('permission.add')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">

                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom  table-bordered table-striped"
                               id="kt_datatable_permissions">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('user.persian_title')</th>
                                <th nowrap>@lang('user.title')</th>
                                <th nowrap>عنوان والد</th>
                                <th>@lang('user.status')</th>
                                <th>@lang('user.roles')</th>
                                <th>@lang('user.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)

                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$item->persian_title}}</td>
                                    <td nowrap>{{$item->title}}</td>
                                    <td nowrap>{{$item->parent_title}}</td>
                                    <td>
                                        <div
                                            class="text-nowrap {{ $item->statusValue->class }}">{{ $item->statusValue->title }}
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($item->roles as $role)
                                            <span
                                                class="label label-lg  label-light-dark label-inline">{{$role->persian_title}}</span>
                                        @endforeach
                                    </td>
                                    <td nowrap>

                                        <x-FormButton permission="Edit Permission"
                                                      url="{{route('permission.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null">
                                        </x-FormButton>

                                        <x-FormButton permission="Delete Permission" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/permission/delete/{{$item->id}}')">
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
