<!DOCTYPE html>
<html direction="rtl" dir="rtl" lang="fa" style="direction: rtl">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>@lang('auth.login_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <link rel="stylesheet" href="{{ asset('css/login/login-5.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.bundle.rtl.css') }}">
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>

</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
             style="background-image: url({{ asset('media/bg/bg-2.jpg') }});">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="https://er123.ir/">
                        <img src="{{ asset('media/logos/rayan_etfa_logo3.png') }}" class="max-h-75px" alt=""/>
                    </a>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3 class="opacity-40 font-weight-normal">@lang('auth.enter_to_admin_panel')</h3>
                        <p class="opacity-40">@lang('auth.enter_username_and_password')</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form class="form" id="kt_login_signin_form" method="post" action="{{route("submit")}}">

                        @csrf

                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                   type="text" placeholder="@lang('auth.username')" name="username" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                   type="password" placeholder="@lang('auth.password')" name="password"/>
                        </div>
                        <div
                            class="form-group d-flex flex-wrap justify-content-center align-items-center px-8 opacity-60">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                    <input type="checkbox" name="remember"/>
                                    <span></span>
                                    @lang('auth.remember_me')
                                </label>
                            </div>
                        </div>
                        <div class="form-group text-center mt-10">
                            <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">
                                ورود
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Login Sign in form-->

            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
</body>
<!--end::Body-->
</html>
