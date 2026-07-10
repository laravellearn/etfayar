@permission($permission)
<div class=" col-12 p-1 h-auto">
    <!--begin::نمودار Widget 3-->
    <div class="card card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <div class="card-title py-5">
                <h3 class="card-label">
                    <span class="d-block text-dark font-weight-bolder">آمار درخواست های ماهانه</span>
                    {{-- <span class="d-block text-muted mt-2 font-size-sm">تعداد {{$requestCount}} درخواست در کل موجود می باشد</span>--}}
                </h3>
            </div>
        </div>
        <!--start::Body-->
        <div class="card-body">
            <div id="kt_charts_widget_3_chart"></div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::نمودار Widget 3-->

</div>


@endpermission