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
                                @lang('user.roles')
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">

                            <x-Button permission="Add Role" :title="__('user.add_role')"
                                      url="{{route('role.add')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped"
                               id="kt_datatable_role">
                            <thead>
                            <tr>
                                <th>@lang('common.code')</th>
                                <th>@lang('user.persian_title')</th>
                                <th>@lang('user.title')</th>
                                <th>@lang('user.permission_count')</th>
                                <th>@lang('user.status')</th>
                                {{-- <th>@lang('user.permissions')</th>--}}
                                <th>@lang('user.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)

                                <tr>
                                    <td class="text-center">{{$item->code}}</td>
                                    <td>{{ $item->persian_title }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>

                                        <!-- دکمه trigger modal-->
                                        <a style="width: 70px;"
                                           data-toggle="modal"
                                           class="label label-{{$item->id!=1?'success':'danger'}} label-inline font-weight-lighter mr-2"
                                           href=""
                                           data-target="#exampleScrollable{{$item->id}}">{{ $item->id!=1?count($item->permissions).' مجوز ':'کل مجوزها' }}</a>

                                        <!-- مودال-->
                                        <div class="modal fade" id="exampleScrollable{{$item->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="staticdrop" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">مجوزها</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="نزدیک">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div data-scroll="true" data-height="300">
                                                            @foreach($item->permissions as $permission)
                                                                <span
                                                                    class="label label-lg  label-light-dark label-inline m-1">{{$permission->persian_title}}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap {{ $item->statusValue->class }}">{{ $item->statusValue->title }}
                                        </div>
                                    </td>
                                    {{--  <td>
                                          @foreach($item->permissions as $permission)
                                              <span
                                                  class="label label-lg  label-light-dark label-inline m-1">{{$permission->persian_title}}</span>
                                          @endforeach
                                      </td>--}}
                                    <td nowrap>

                                        @if($item->id != 1)
                                            <x-FormButton permission="Edit Role" url="{{route('role.edit',$item->id)}}"
                                                          :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                          click="null">
                                            </x-FormButton>
                                        @endif

                                        @if($item->id != 1)
                                            <x-FormButton permission="Delete Role" url="javascript:;"
                                                          :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                          click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/role/delete/{{$item->id}}')">
                                            </x-FormButton>
                                        @endif

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
