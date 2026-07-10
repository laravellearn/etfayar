<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('common.rayan_etfa') | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('media/logos/rayan_etfa_logo2.png') }}"/>
    <meta name="robots" content="noindex, nofollow">

    <!--begin::Fonts-->
{{--
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>        <!--end::Fonts-->
--}}
    <link rel="stylesheet" href={{ asset('css/wizard/wizard-4.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/datatable/datatables.bundle.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/plugins.bundle.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/aside/dark.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/style.bundle.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/menu/light.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/base/light.rtl.css') }}>
    <link rel="stylesheet" href={{ asset('css/common/jquery-confirm.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/common/toastr.css') }}>
    <link rel="stylesheet" href="{{asset('css/datetimepicker/jquery.md.bootstrap.datetimepicker.style.css')}}">
    <link rel="stylesheet" href="{{asset('css/datetimepicker/kamadatepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datetimepicker/datepicker.css')}}">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
   {{-- <script src="{{ asset('js/datetimepicker/jquery.md.bootstrap.datetimepicker.js') }}"></script>--}}
    <script src="{{ asset('js/datetimepicker/kamadatepicker.min.js') }}"></script>

</head>
