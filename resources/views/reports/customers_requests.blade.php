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
                        'prefix' => 'customers',
                        'cardTitle' => 'تعداد مشتریان جدید بر اساس ماه',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'customers']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'customers']),
                        'color' => '#3699FF',
                        'currentYear' => $currentYear,
                        'defaultYear1' => $currentYear,
                        'defaultMonth1' => null,
                        'defaultYear2' => $currentYear - 1,
                        'defaultMonth2' => null,
                    ])

                    @include('reports.partials.trend-compare-card', [
                        'prefix' => 'requests',
                        'cardTitle' => 'تعداد درخواست‌های مشتریان بر اساس ماه',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'requests']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'requests']),
                        'color' => '#8950FC',
                        'currentYear' => $currentYear,
                        'defaultYear1' => $currentYear,
                        'defaultMonth1' => null,
                        'defaultYear2' => $currentYear - 1,
                        'defaultMonth2' => null,
                    ])

                    <div class="col-12 p-2">
                        <div class="card card-stretch gutter-b">
                            <div class="card-header border-0">
                                <div class="card-title py-4">
                                    <h3 class="card-label">نوع آشنایی مشتریان با مجموعه</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="font-size-h4 font-weight-boldest mb-4">
                                    تعداد کل مشتریان: <span id="acquaintance-total">—</span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th>نوع آشنایی</th>
                                            <th>تعداد</th>
                                            <th>درصد</th>
                                        </tr>
                                        </thead>
                                        <tbody id="acquaintance-table-body">
                                        <tr>
                                            <td colspan="3" class="text-muted">در حال بارگذاری...</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('reports.partials.scripts')
    <script>
        fetch('{{ route('reports.data.acquaintance_breakdown') }}')
            .then(function (res) { return res.json(); })
            .then(function (data) {
                document.getElementById('acquaintance-total').innerText = data.total.toLocaleString('en-US');
                const tbody = document.getElementById('acquaintance-table-body');
                tbody.innerHTML = '';
                if (data.items.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-muted">داده‌ای موجود نیست</td></tr>';
                    return;
                }
                data.items.forEach(function (item) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + item.title + '</td><td>' + item.count.toLocaleString('en-US') + '</td><td>' + item.percent + '٪</td>';
                    tbody.appendChild(tr);
                });
            });
    </script>
@endsection
