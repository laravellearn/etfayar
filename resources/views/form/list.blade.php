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
                            {{--

                                                        <x-Button permission="Add Permission"  :title="__('user.add_permission')" url="{{route('permission.add')}}"></x-Button>
                            --}}

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_officeForms">
                            <thead>
                            <tr>
                                <th nowrap>@lang('form.title')</th>
                                {{--<th>@lang('common.actions')</th>--}}
                                <th nowrap>@lang('form.admins_received_request')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)

                                <tr>
                                    <td nowrap>{{$item->title}}</td>

                                   {{-- <td nowrap>
                                        <x-Button permission="Edit Permission"
                                                  url="{{route('form.create',$item->id)}}"
                                                  :title="__('form.add')"
                                                  click="null">
                                        </x-Button>
                                    </td>--}}

                                    <td nowrap>
                               {{--         <x-Button permission="Choose Form Received Admins"
                                                  url="{{route('form.admins',$item->id)}}"
                                                  :title="__('form.admins_received_request')"
                                                  btn-class="btn-warning"
                                                  click="null">
                                        </x-Button>
--}}
                                        <x-FormButton permission="Choose Form Received Admins"
                                                      url="{{route('form.admins',$item->id)}}"
                                                      :icon="__('icon.edit_icon')"
                                                      :title="__('form.admins_received_request')"
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
