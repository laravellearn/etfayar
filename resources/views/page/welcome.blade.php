<!DOCTYPE html>
<html direction="rtl" dir="rtl" lang="fa" style="direction: rtl" >
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>@lang('common.rayan_etfa')</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <link rel="stylesheet" href="{{ asset('css/login/login-5.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.bundle.rtl.css') }}">
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>

</head>
<!--end::Head-->

<!--begin::Body-->
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(media/bg/bg-2.jpg);">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{{ asset('media/logos/rayan_etfa_logo3.png') }}" class="max-h-75px" alt=""/>
                    </a>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3 class="opacity-40 font-weight-normal">@lang('common.rayan_group')</h3>
                        <p class="opacity-40"></p>
                    </div>
                   <div>
                       <p>
                       @lang('common.rayan_group_description')

                       </p>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
</body>
<!--end::Body-->
</html>
