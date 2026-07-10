@extends('layout.main')@section('title', $title)
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

                            <x-Button permission="Add Information" :title="__('information.add')"
                                      url="{{route('information.create')}}"></x-Button>

                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_informations">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('information.name')</th>
                                <th>@lang('information.economic_code')</th>
                                <th>@lang('information.postal_code')</th>
                                <th>@lang('information.national_code')</th>
                                <th>@lang('information.registration_number')</th>
                                <th>@lang('information.city_id')</th>
                                <th>@lang('information.bank_id')</th>
                                <th>@lang('information.location')</th>
                                <th>@lang('information.telephone')</th>
                                <th>@lang('information.type')</th>
                                <th>پیش فاکتور/فاکتور</th>
                                <th>@lang('user.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list as $item)
                                @if(!is_null($item->name))
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td nowrap>{{$item->name}}</td>
                                        <td>{{$item->economic_code}}</td>
                                        <td>{{$item->postal_code}}</td>
                                        <td>{{$item->national_code}}</td>
                                        <td>{{$item->registration_number}}</td>
                                        <td>{{$item->city->name}}</td>
                                        <td>{{$item->bank->name}}</td>
                                        <td>{{$item->location}}</td>
                                        <td>{{$item->telephone}}</td>
                                        <td>{{ $item->headerTypeValue->title }}</td>
                                        <td>
                                            <div
                                                class="text-nowrap {{ $item->typeValue->class }}">{{ $item->typeValue->title }}
                                            </div>
                                        </td>
                                        <td nowrap>

                                            <x-FormButton permission="Edit Information"
                                                          url="{{route('information.edit',$item->id)}}"
                                                          :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                          click="null"></x-FormButton>

                                            <x-FormButton permission="Delete Information" url="javascript:;"
                                                          :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                          click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/information/delete/{{$item->id}}')"></x-FormButton>

                                            {{-- <x-FormButton permission="Edit Information"
                                                           url="{{route('information.show',$item->id)}}"
                                                           :icon="__('icon.list_icon')" :title="__('preinvoice.show')"
                                                           click="null">
                                             </x-FormButton>--}}

                                        </td>
                                    </tr>
                                @endif

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
