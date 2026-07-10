@extends('layout.main')
@section('title', $title)
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">

                <!--begin::Filter Card-->
                <div class="card card-custom mb-5">
                    <div class="card-header">
                        <h3 class="card-title">فیلتر پیشرفته</h3>
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-sm btn-light" data-toggle="collapse" data-target="#filterCollapse">
                                <i class="flaticon2-search"></i> کلیک کنید
                            </a>
                        </div>
                    </div>
                    <div class="collapse" id="filterCollapse">
                        <div class="card-body">
                            <form method="GET" action="{{ route('users') }}">
                                <div class="row">
                                    <!-- نوع هویت -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.identity_type')</label>
                                        <select name="identity_type" class="form-control">
                                            <option value="">همه</option>
                                            <option value="natural" {{ request('identity_type') == 'natural' ? 'selected' : '' }}>حقیقی</option>
                                            <option value="legal" {{ request('identity_type') == 'legal' ? 'selected' : '' }}>حقوقی</option>
                                        </select>
                                    </div>

                                    <!-- نام / نام‌خانوادگی / نام رابط / شرکت -->
                                    <div class="col-md-3 mb-3">
                                        <label>نام و نام خانوادگی(رابط-شرکت)</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ request('name') }}">
                                    </div>

                                    <!-- کد ملی -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.national_code')</label>
                                        <input type="text" name="national_code" class="form-control"
                                               value="{{ request('national_code') }}">
                                    </div>

                                    <!-- تلفن همراه اصلی + رابط -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.mobile')</label>
                                        <input type="text" name="mobile" class="form-control"
                                               value="{{ request('mobile') }}">
                                    </div>
                                    <!-- شماره ثابت -->
                                    <div class="col-md-3 mb-3">
                                        <label>تلفن ثابت:</label>
                                        <input type="text" name="telephone" class="form-control"
                                               value="{{ request('telephone') }}">
                                    </div>
                                    <!-- پست الکترونیک -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.email')</label>
                                        <input type="text" name="email" class="form-control"
                                               value="{{ request('email') }}">
                                    </div>

                                    <!-- شهر -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.city')</label>
                                        <select class="form-control selectpicker" name="city_id" data-size="5"
                                            data-live-search="true">
                                            <option value="">همه</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- کد پستی -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.postal_code')</label>
                                        <input type="text" name="postal_code" class="form-control"
                                               value="{{ request('postal_code') }}">
                                    </div>

                                    <!-- آدرس -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.address')</label>
                                        <input type="text" name="address" class="form-control"
                                               value="{{ request('address') }}">
                                    </div>

                                    <!-- شماره مشتری -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.customer_code')</label>
                                        <input type="text" name="customer_code" class="form-control"
                                               value="{{ request('customer_code') }}">
                                    </div>

                                    <!-- کد اقتصادی -->
                                    <div class="col-md-3 mb-3">
                                        <label>@lang('user.economic_code')</label>
                                        <input type="text" name="economic_code" class="form-control"
                                               value="{{ request('economic_code') }}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="flaticon2-search"></i> جستجو
                                        </button>
                                        <a href="{{ route('users') }}" class="btn btn-secondary">
                                            پاک کردن
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Filter Card-->

                <!--begin::Card (جدول کاربران)-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                @lang('user.users')
                                <span class="d-block text-muted pt-2 font-size-sm"></span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <x-Button permission="Add User" :title="__('user.add_user')"
                                      url="{{route('user.add')}}"></x-Button>
                        </div>
                    </div>

                    <div class="card-body">
                        <!--begin: جدول داده ها-->
                        <table class="table table-separate table-head-custom table-bordered table-striped text-center"
                               id="kt_datatable_users">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('user.customer_code')</th>
                                <th>@lang('user.name_and_family')</th>
                                <th>@lang('service.services')</th>
                                <th>@lang('user.status')</th>
                                <th>@lang('user.actions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->customer_code}}</td>
                                    <td>{{$item->full_name}}</td>
                                    <td>
                                        @foreach($item->services as $service)
                                            <span
                                                class="text-left label label-lg label-light-dark label-inline m-1">{{ $service->title }}</span>
                                        @endforeach
                                    </td>
                                    <td nowrap>
                                        <div
                                            class="{{ $item->statusValue->class }}">{{ $item->statusValue->title }}</div>
                                    </td>
                                    <td nowrap>
    {{-- دکمه مشاهده درخواست‌ها --}}
    <a href="{{ route('user.requests', $item->id) }}" 
       class="btn btn-sm btn-icon btn-light-primary mr-1" 
       title="درخواست‌ها">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <line x1="8" y1="6" x2="21" y2="6"></line>
  <line x1="8" y1="12" x2="21" y2="12"></line>
  <line x1="8" y1="18" x2="21" y2="18"></line>
  <circle cx="4" cy="6" r="1.5"></circle>
  <circle cx="4" cy="12" r="1.5"></circle>
  <circle cx="4" cy="18" r="1.5"></circle>
</svg>
    </a>

    {{-- دکمه مشاهده پیش‌فاکتورها --}}
    <a href="{{ route('user.preinvoices', $item->id) }}" 
       class="btn btn-sm btn-icon btn-light-success mr-1" 
       title="پیش‌فاکتورها">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
  <polyline points="14 2 14 8 20 8"></polyline>
  <line x1="16" y1="13" x2="8" y2="13"></line>
  <line x1="16" y1="17" x2="8" y2="17"></line>
</svg>
    </a>

                                        {{-- دکمه‌های قبلی (بدون تغییر) --}}
                                        <x-FormButton permission="Access User Supports"
                                                      url="{{route('user_supports',$item->id)}}"
                                                      :icon="__('icon.user_support_icon')"
                                                      :title="__('user_support.list')"
                                                      click="null">
                                        </x-FormButton>

                                        <x-FormButton permission="Access Users"
                                                      url="https://wa.me/+98{{$item->mobile}}"
                                                      :icon="__('icon.whatsapp_icon')"
                                                      :title="__('common.show')"
                                                      click="null">
                                        </x-FormButton>

                                        <x-FormButton permission="Access Users"
                                                      url="{{route('user.show',$item->id)}}"
                                                      :icon="__('icon.show_icon')"
                                                      :title="__('common.show')"
                                                      click="null">
                                        </x-FormButton>

                                        <x-FormButton permission="Edit User" url="{{route('user.edit',$item->id)}}"
                                                      :icon="__('icon.edit_icon')" :title="__('common.edit')"
                                                      click="null">
                                        </x-FormButton>

                                        <x-FormButton permission="Delete User" url="javascript:;"
                                                      :icon="__('icon.delete_icon')" :title="__('common.delete')"
                                                      click="deleteDialog('{{__('common.delete')}}','{{__('common.areYouSureDelete')}}','/admin/user/delete/{{$item->id}}')">
                                        </x-FormButton>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">هیچ کاربری یافت نشد.</td>
                                </tr>
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