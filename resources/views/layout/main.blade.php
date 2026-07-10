<!DOCTYPE html>
<html direction="rtl" dir="rtl">
<!--begin::Head-->
@include('layout.head')
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading-non-block">

<!--begin::Main-->
<!--begin::Header Mobile-->
@include('layout.header_mobile')
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">

        <!--begin::Aside-->
        @include('layout.sidebar')
        <!--end::Aside-->

        <!--begin::Wrapper-->
        <div  style="direction: rtl!important;overflow:auto!important;max-height: 100vh!important;"  class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed ">
                <!--begin::Container-->
                @include('layout.navbar')
                <!--end::Container-->
            </div>
            <!--end::Header-->

            <!--begin::Content-->
            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::زیر هدر-->
                @include('layout.subheader')
                <!--end::زیر هدر-->

                <!--begin::Entry-->
                <div  class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        @yield('content')
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            @include('layout.footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->

</body>
<!--end::Body-->
</html>
