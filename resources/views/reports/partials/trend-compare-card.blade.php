{{--
    یک کارت کامل شامل: نمودارِ روند ۱۲ ماهِ اخیر + ویجتِ مقایسه‌ی دو دوره.
    پارامترها (از طریق @include با آرایه‌ی داده پاس داده می‌شن):
      - prefix: پیشوندِ یکتا برای id عناصر (مثلاً "customers")
      - cardTitle: عنوانِ کارت
      - trendUrl: آدرس endpoint نمودارِ روند
      - compareUrl: آدرس endpoint مقایسه
      - color: رنگ میله‌های نمودار (اختیاری)
      - currentYear, defaultYear1, defaultMonth1, defaultYear2, defaultMonth2
--}}
<div class="col-12 col-xl-6 p-2">
    <div class="card card-stretch gutter-b h-100">
        <div class="card-header border-0">
            <div class="card-title py-4">
                <h3 class="card-label">{{ $cardTitle }}</h3>
            </div>
        </div>
        <div class="card-body pt-0">
            <canvas id="{{ $prefix }}-chart" height="220"></canvas>

            <hr>

            <div class="font-weight-bold mb-3">مقایسه‌ی دو دوره</div>
            <div class="row align-items-end">
                <div class="col-6 col-md-3 mb-2">
                    <label class="font-size-sm">سال (۱)</label>
                    <select id="{{ $prefix }}-year1" class="form-control form-control-sm"></select>
                </div>
                <div class="col-6 col-md-3 mb-2">
                    <label class="font-size-sm">ماه (۱)</label>
                    <select id="{{ $prefix }}-month1" class="form-control form-control-sm"></select>
                </div>
                <div class="col-6 col-md-3 mb-2">
                    <label class="font-size-sm">سال (۲)</label>
                    <select id="{{ $prefix }}-year2" class="form-control form-control-sm"></select>
                </div>
                <div class="col-6 col-md-3 mb-2">
                    <label class="font-size-sm">ماه (۲)</label>
                    <select id="{{ $prefix }}-month2" class="form-control form-control-sm"></select>
                </div>
            </div>
            <button id="{{ $prefix }}-compare-btn" type="button" class="btn btn-sm btn-light-primary mb-3">مقایسه کن</button>

            <div class="row text-center">
                <div class="col-5">
                    <div class="font-size-h5 font-weight-boldest" id="{{ $prefix }}-value1">—</div>
                    <div class="text-muted font-size-sm" id="{{ $prefix }}-label1"></div>
                </div>
                <div class="col-2 d-flex align-items-center justify-content-center">
                    <span id="{{ $prefix }}-diff">—</span>
                </div>
                <div class="col-5">
                    <div class="font-size-h5 font-weight-boldest" id="{{ $prefix }}-value2">—</div>
                    <div class="text-muted font-size-sm" id="{{ $prefix }}-label2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        renderReportTrendChart('{{ $prefix }}-chart', '{{ $trendUrl }}', '{{ $color ?? "#3699FF" }}');
        fillReportYearMonthSelects(
            '{{ $prefix }}',
            {{ $currentYear }},
            {{ $defaultYear1 }}, {{ $defaultMonth1 ?? 'null' }},
            {{ $defaultYear2 }}, {{ $defaultMonth2 ?? 'null' }}
        );
        initReportCompareWidget('{{ $prefix }}', '{{ $compareUrl }}');
    })();
</script>
