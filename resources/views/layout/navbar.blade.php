<!--begin::Header-->
<div id="kt_header" class="header  header-fixed ">

    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        <!--begin::Header Menu-->
        <div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default ">
            <!--begin::Header Nav-->
           {{-- <ul class="menu-nav">

                <li class="menu-item  menu-item-submenu menu-item-rel menu-item-active"></li>
                <li class="menu-item  menu-item-submenu menu-item-rel menu-item-active"></li>
                <li class="menu-item  menu-item-submenu menu-item-rel menu-item-active"></li>
                <li class="menu-item  menu-item-submenu menu-item-rel menu-item-active"></li>
                <li id="calendar" class="menu-item">
                    <a style="text-align: right;width: 350px!important;" href="javascript:;" class=""><span
                            class="text-body flex-nowrap">  <strong>امروز:</strong> {{$date}}</span><i
                            class="menu-arrow"></i></a>
                </li>
            </ul>--}}
            <!--end::Header Nav-->
        </div>
        <!--end::Header Menu-->
    </div>

    <div class="container-fluid  d-flex align-items-stretch justify-content-end">
        <div class="topbar justify-content-around">

            <div class="dropdown show"></div>

            <!--begin::اعلان ها-->
            @include('layout.notification')
            <!--end::اعلان ها-->


            <!--begin::Toggle-->
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
                {{--Large Screen Menu Icon--}}
                <span
                    class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{auth('admin')->user()->full_name}}</span>
                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                    <img class="h-20px w-20px rounded-sm svg-icon svg-icon-xl svg-icon-primary"
                         src="{{asset('media/svg/icons/General/User.svg')}}" alt="">
                </div>
            </div>
            <!--end::Toggle-->

            <!--begin::دراپ دان-->
            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right"
                 x-placement="bottom-end"
                 style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-117px, 65px, 0px);">
                <!--begin::Nav-->
                <ul class="navi navi-hover py-4">

                    <!--begin::Item-->
                    @permission('Access Admin Profile')

                    <li class="navi-item">
                        <a href="{{route('admin.profile')}}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{asset('media/svg/icons/General/User.svg')}}" alt="">
            </span> <span class="navi-text">@lang('common.profile')</span> </a>
                    </li>
                    @endpermission()
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="navi-item">
                        <a href="{{route('logout')}}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{asset('media/svg/icons/Home/Door-open.svg')}}" alt="">
            </span> <span class="navi-text">@lang('common.exit')</span> </a>
                    </li>
                    <!--end::Item-->


                </ul>
                <!--end::Nav-->
            </div>
            <!--end::دراپ دان-->
        </div>
    </div>
</div><!--end::Header-->
