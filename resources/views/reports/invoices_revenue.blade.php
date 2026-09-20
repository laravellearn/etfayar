@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">

                    @php
                        $currentYear = \App\Services\Report\ReportService::currentJalaliYear();
                    @endphp

                    @include('reports.partials.trend-compare-card', [
                        'prefix' => 'preinvoices',
                        'cardTitle' => 'تعداد پیش‌فاکتورهای صادرشده بر اساس ماه',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'preinvoices']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'preinvoices']),
                        'color' => '#3699FF',
                        'currentYear' => $currentYear,
                        'defaultYear1' => $currentYear, 'defaultMonth1' => null,
                        'defaultYear2' => $currentYear - 1, 'defaultMonth2' => null,
                    ])

                    @include('reports.partials.trend-compare-card', [
                        'prefix' => 'invoices',
                        'cardTitle' => 'تعداد فاکتورهای صادرشده بر اساس ماه',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'invoices']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'invoices']),
                        'color' => '#1BC5BD',
                        'currentYear' => $currentYear,
                        'defaultYear1' => $currentYear, 'defaultMonth1' => null,
                        'defaultYear2' => $currentYear - 1, 'defaultMonth2' => null,
                    ])

                    {{-- درصد تبدیل پیش‌فاکتور به فاکتور --}}
                    <div class="col-12 col-xl-6 p-2">
                        <div class="card card-stretch gutter-b h-100">
                            <div class="card-header border-0">
                                <div class="card-title py-4">
                                    <h3 class="card-label">درصد تبدیل پیش‌فاکتور به فاکتور</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="text-muted font-size-sm mb-3">
                                    از بین پیش‌فاکتورهایی که در دوره‌ی انتخاب‌شده ثبت شدن، تا الان چند درصدشون به فاکتور تبدیل شدن.
                                </div>
                                <div class="row align-items-end mb-3">
                                    <div class="col-6">
                                        <label class="font-size-sm">سال</label>
                                        <select id="conv-year" class="form-control form-control-sm"></select>
                                    </div>
                                    <div class="col-6">
                                        <label class="font-size-sm">ماه</label>
                                        <select id="conv-month" class="form-control form-control-sm"></select>
                                    </div>
                                </div>
                                <button id="conv-btn" type="button" class="btn btn-sm btn-light-primary mb-4">نمایش</button>

                                <div class="text-center">
                                    <div class="display-4 font-weight-boldest text-primary" id="conv-percent">—</div>
                                    <div class="text-muted mt-2" id="conv-detail"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- درآمد شارژ --}}
                    <div class="col-12 p-2">
                        <div class="alert alert-light-warning">
                            ⚠️ توضیح مهم: چون در جدول ردیف‌های فاکتور، فیلد جداگانه‌ای برای «نوع» ردیف (محصول/تست/شارژ) وجود نداره،
                            این گزارش، «شارژ» رو بر اساس ردیف‌هایی حساب می‌کنه که <b>عنوانشون با کلمه‌ی «شارژ» شروع می‌شه</b>
                            (مثلاً «شارژ کپسول آتش‌نشانی ۶ کیلویی»). اگر عنوان‌های دیگه‌ای هم باید جزو شارژ حساب بشن، لطفاً به ما اطلاع بدید
                            تا قاعده رو تنظیم کنیم.
                        </div>
                    </div>

                    @include('reports.partials.trend-compare-card', [
                        'prefix' => 'charge',
                        'cardTitle' => 'درآمد شارژ (تومان) بر اساس ماه',
                        'trendUrl' => route('reports.data.charge_revenue.trend'),
                        'compareUrl' => route('reports.data.charge_revenue.compare'),
                        'color' => '#F64E60',
                        'currentYear' => $currentYear,
                        'defaultYear1' => $currentYear, 'defaultMonth1' => null,
                        'defaultYear2' => $currentYear - 1, 'defaultMonth2' => null,
                    ])

                </div>
            </div>
        </div>
    </div>

    @include('reports.partials.scripts')
    <script>
        (function () {
            const currentYear = {{ $currentYear }};
            const years = [];
            for (let y = currentYear; y >= currentYear - 6; y--) years.push(y);

            const yearEl = document.getElementById('conv-year');
            years.forEach(function (y) {
                const opt = document.createElement('option');
                opt.value = y; opt.text = y;
                if (y === currentYear) opt.selected = true;
                yearEl.appendChild(opt);
            });

            const monthEl = document.getElementById('conv-month');
            const optAll = document.createElement('option');
            optAll.value = ''; optAll.text = 'کل سال';
            monthEl.appendChild(optAll);
            REPORT_MONTH_NAMES.forEach(function (name, idx) {
                const opt = document.createElement('option');
                opt.value = idx + 1; opt.text = name;
                monthEl.appendChild(opt);
            });

            function loadConversion() {
                const params = new URLSearchParams({year: yearEl.value, month: monthEl.value});
                fetch('{{ route('reports.data.conversion_rate') }}?' + params.toString())
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        document.getElementById('conv-percent').innerText = data.percent + '٪';
                        document.getElementById('conv-detail').innerText =
                            data.converted.toLocaleString('en-US') + ' از ' + data.total.toLocaleString('en-US') + ' پیش‌فاکتور (' + data.label + ')';
                    });
            }

            document.getElementById('conv-btn').addEventListener('click', loadConversion);
            loadConversion();
        })();
    </script>
@endsection
