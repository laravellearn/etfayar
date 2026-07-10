<div id="kt_header_mobile" class="header-mobile align-items-center  header-mobile-fixed bg-white">
    <!--begin::Logo-->
    {{-- <a href=""> <img alt="Logo" src="{{ asset('media/logos/rayan_etfa_logo2.png') }}"/> </a>--}}
    <!--end::Logo-->

    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left d-print-none" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->

        <!--begin::Header Menu Mobile Toggle-->
        {{-- <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
             <span></span>
         </button>--}}
        <!--end::Header Menu Mobile Toggle-->

        <!--begin::Topbar Mobile Toggle-->
        {{-- <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
             <span class="svg-icon svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/عمومی/User.svg-->
                 <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
         <polygon points="0 0 24 0 24 24 0 24"/>
         <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
         <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
     </g>
 </svg><!--end::Svg Icon--></span></button>
         <!--end::Topbar Mobile Toggle-->--}}
    </div>
    <!--end::Toolbar-->

    <!--begin::اعلان ها-->
    @include('layout.notification')
    <!--end::اعلان ها-->
    <div class="justify-content-around d-print-none">

        <div class="dropdown show"></div>
        <!--begin::Toggle-->
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
            {{--Mobile Menu Icon--}}
            <span
                class="text-dark-50 font-weight-bolder font-size-base d-md-inline d-sm-inline mr-3">{{auth('admin')->user()->full_name}}</span>
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
