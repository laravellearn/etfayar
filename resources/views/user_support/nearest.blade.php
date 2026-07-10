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


                            <x-Button permission="Access Users"
                                      :title="__('user.users')"
                                      btn-class="btn-success"
                                      url="{{route('users')}}"></x-Button>


                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_requests">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('user_support.user')</th>
                                <th>@lang('user_support.support_time')</th>
                                <th>@lang('user_support.create_description')</th>
                                <th>@lang('user_support.done_time')</th>
                                <th>@lang('user_support.done_description')</th>
                                <th>@lang('common.status')</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)

                                <tr>
                                    <td nowrap>{{$loop->iteration}}</td>
                                    <td nowrap>{{$item->user->full_name??''}}</td>
                                    <td nowrap>{{$item->persianSupportTime??''}}</td>
                                    <td nowrap>{{$item->create_description??''}}</td>
                                    <td nowrap>{{$item->persianDoneTime??''}}</td>
                                    <td nowrap>{{$item->done_description??''}}</td>
                                    <td nowrap>
                                        <div class="{{$item->statusValue->class}}">{{$item->statusValue->title}}</div>
                                    </td>
                                    <td nowrap>{{$item->persianDateTime}}</td>
                                    <td nowrap>

                                        <x-FormButton permission="Show User"
                                                      url="{{route('user.show',$item->user->id)}}"
                                                      :icon="__('icon.user_icon')"
                                                      :title="__('common.show')"
                                                      click="null">

                                        </x-FormButton>

                                        <x-FormButton permission="Edit User Support"
                                                      url="{{route('user_support.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')"
                                                      :title="__('common.edit')"
                                                      click="null">

                                        </x-FormButton>


                                        <x-FormButton permission="Delete User Support" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/user_support/delete/{{$item->id}}')">
                                        </x-FormButton>

                                    </td>
                                </tr>
                            @empty


                            @endforelse
                            </tbody>

                        </table>

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
