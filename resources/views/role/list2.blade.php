@extends('layout.main')
@section('title', $title)
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-9">
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>مدیریت</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::کاربران-->
                            <div class="fw-bolder text-gray-600 mb-5">مجموع سمت های دسترسی  5</div>
                            <!--end::کاربران-->
                            <!--begin::مجوزها-->
                            <div class="d-flex flex-column text-gray-600">
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>همه کنترل های ادمین</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش خلاصه امور مالی</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>فعال انبوه گزارشات</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش و  پرداخت ها</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش و  اختلاف نظرات</div>
                                <div class='d-flex align-items-center py-2'>
                                    <span class='bullet bg-primary me-3'></span>
                                    <em>و 7 more...</em>
                                </div>
                            </div>
                            <!--end::مجوزها-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-0">
                            <a href="apps/user-management/roles/view.html" class="btn btn-light btn-active-primary my-1 me-2">نمایش سطح دسترسی</a>
                            <button type="button" class="btn btn-white btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">سطح دسترسی</button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>توسعه دهنده</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::کاربران-->
                            <div class="fw-bolder text-gray-600 mb-5">مجموع سمت های دسترسی  14</div>
                            <!--end::کاربران-->
                            <!--begin::مجوزها-->
                            <div class="d-flex flex-column text-gray-600">
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>برخی از کنترل های سرپرست</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش فقط خلاصه های مالی</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش و  کنترل های کلید دسترسی</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش پرداخت ها </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش و  اختلاف نظرات</div>
                                <div class='d-flex align-items-center py-2'>
                                    <span class='bullet bg-primary me-3'></span>
                                    <em>و 3 more...</em>
                                </div>
                            </div>
                            <!--end::مجوزها-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-0">
                            <a href="apps/user-management/roles/view.html" class="btn btn-light btn-active-primary my-1 me-2">نمایش سطح دسترسی</a>
                            <button type="button" class="btn btn-white btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">سطح دسترسی</button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>تحلیلگر</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::کاربران-->
                            <div class="fw-bolder text-gray-600 mb-5">مجموع سمت های دسترسی  4</div>
                            <!--end::کاربران-->
                            <!--begin::مجوزها-->
                            <div class="d-flex flex-column text-gray-600">
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>بدون کنترل ادمین</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش خلاصه امور مالی</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>فعال انبوه گزارشات</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش پرداخت ها </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش اختلاف نظرات</div>
                                <div class='d-flex align-items-center py-2'>
                                    <span class='bullet bg-primary me-3'></span>
                                    <em>و 2 more...</em>
                                </div>
                            </div>
                            <!--end::مجوزها-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-0">
                            <a href="apps/user-management/roles/view.html" class="btn btn-light btn-active-primary my-1 me-2">نمایش سطح دسترسی</a>
                            <button type="button" class="btn btn-white btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">سطح دسترسی</button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>پشتیبانی</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::کاربران-->
                            <div class="fw-bolder text-gray-600 mb-5">مجموع سمت های دسترسی  23</div>
                            <!--end::کاربران-->
                            <!--begin::مجوزها-->
                            <div class="d-flex flex-column text-gray-600">
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>بدون کنترل ادمین</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش فقط خلاصه های مالی</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش پرداخت ها </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش و  اختلاف نظرات</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نظرات مشتریان</div>
                            </div>
                            <!--end::مجوزها-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-0">
                            <a href="apps/user-management/roles/view.html" class="btn btn-light btn-active-primary my-1 me-2">نمایش سطح دسترسی</a>
                            <button type="button" class="btn btn-white btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">سطح دسترسی</button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>آزمایش</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::کاربران-->
                            <div class="fw-bolder text-gray-600 mb-5">مجموع سمت های دسترسی  546</div>
                            <!--end::کاربران-->
                            <!--begin::مجوزها-->
                            <div class="d-flex flex-column text-gray-600">
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>بدون کنترل ادمین</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش فقط خلاصه های مالی</div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش گزارشات </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش پرداخت ها </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>نمایش اختلاف نظرات</div>
                            </div>
                            <!--end::مجوزها-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-0">
                            <a href="apps/user-management/roles/view.html" class="btn btn-light btn-active-primary my-1 me-2">نمایش سطح دسترسی</a>
                            <button type="button" class="btn btn-white btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">سطح دسترسی</button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Add new card-->
                <div class="ol-md-4">
                    <!--begin::Card-->
                    <div class="card h-md-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                <!--begin::Illustration-->
                                <img src="assets/media/illustrations/user-role.png" alt="" class="mw-100 mh-150px mb-7" />
                                <!--end::Illustration-->
                                <!--begin::برچسب-->
                                <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">سطح دسترسی جدید</div>
                                <!--end::برچسب-->
                            </button>
                            <!--begin::Button-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                    <!--begin::Card-->
                </div>
                <!--begin::Add new card-->
            </div>
            <!--end::Row-->
            <!--begin::مودال ها-->
            <!--begin::Modal - Add role-->
            <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">افزودن سطح دسترسی</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                                <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
																<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
																<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
															</g>
														</svg>
													</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-lg-5 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_add_role_form" class="form" action="#">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::برچسب-->
                                        <label class="fs-5 fw-bolder form-label mb-2">
                                            <span class="required">نام سطح دسترسی</span>
                                        </label>
                                        <!--end::برچسب-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="سطح دسترسی خود را وارد نمایید" name="role_name" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::مجوزها-->
                                    <div class="fv-row">
                                        <!--begin::برچسب-->
                                        <label class="fs-5 fw-bolder form-label mb-2">سطح دسترسی مجوزها</label>
                                        <!--end::برچسب-->
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-bold">
                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">مدیریت دسترسی
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="همهows a full access to the system"></i></td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                            <span class="form-check-label" for="kt_roles_select_all">انتخاب همه</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">کاربر مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">مدیریت محتوا</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">مدیریت مالی</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">گزارشات</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="reporting_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="reporting_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="reporting_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">حقوق و دستمزد</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="payroll_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="payroll_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="payroll_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">اختلاف نظرات مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="اختلاف نظرات_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="اختلاف نظرات_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="اختلاف نظرات_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">کنترل های کلید دسترسی</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="api_controls_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="api_controls_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="api_controls_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">دیتابیس مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="database_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="database_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="database_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">مخزن مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::تنظیمات-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="repository_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="repository_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="repository_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::تنظیمات-->
                                                </tr>
                                                <!--end::Table row-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::مجوزها-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::عملیات-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-white me-3" data-kt-roles-modal-action="cancel">لغو</button>
                                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                        <span class="indicator-label">ثبت</span>
                                        <span class="indicator-progress">لطفا صبر کنید...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::عملیات-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add role-->
            <!--begin::Modal - بروزرسانی role-->
            <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">بروزرسانی سطح دسترسی</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                                <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
																<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
																<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
															</g>
														</svg>
													</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_update_role_form" class="form" action="#">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::برچسب-->
                                        <label class="fs-5 fw-bolder form-label mb-2">
                                            <span class="required">نام سطح دسترسی</span>
                                        </label>
                                        <!--end::برچسب-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="سطح دسترسی خود را وارد نمایید" name="role_name" value="توسعه دهنده" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::مجوزها-->
                                    <div class="fv-row">
                                        <!--begin::برچسب-->
                                        <label class="fs-5 fw-bolder form-label mb-2">سطح دسترسی مجوزها</label>
                                        <!--end::برچسب-->
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-bold">
                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">مدیریت دسترسی
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="همهows a full access to the system"></i></td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                            <span class="form-check-label" for="kt_roles_select_all">انتخاب همه</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">کاربر مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">مدیریت محتوا</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">مدیریت مالی</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">گزارشات</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="reporting_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="reporting_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="reporting_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">حقوق و دستمزد</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="payroll_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="payroll_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="payroll_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">اختلاف نظرات مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="اختلاف نظرات_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="اختلاف نظرات_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="اختلاف نظرات_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">کنترل های کلید دسترسی</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="api_controls_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="api_controls_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="api_controls_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">دیتابیس مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="database_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="database_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="database_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::برچسب-->
                                                    <td class="text-gray-800">مخزن مدیریت</td>
                                                    <!--end::برچسب-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="repository_management_read" />
                                                                <span class="form-check-label">خواندن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="repository_management_write" />
                                                                <span class="form-check-label">نوشتن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="repository_management_create" />
                                                                <span class="form-check-label">ساختن</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                                <!--end::Table row-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::مجوزها-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::عملیات-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-white me-3" data-kt-roles-modal-action="cancel">لغو</button>
                                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                        <span class="indicator-label">ثبت</span>
                                        <span class="indicator-progress">لطفا صبر کنید...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::عملیات-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - بروزرسانی role-->
            <!--end::مودال ها-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
