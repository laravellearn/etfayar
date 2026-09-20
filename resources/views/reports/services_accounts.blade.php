@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-xl-6 p-2">
                        <div class="card card-stretch gutter-b h-100">
                            <div class="card-header border-0">
                                <div class="card-title py-4">
                                    <h3 class="card-label">تعداد درخواست‌های مشتریان بر اساس نوع سرویس</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <canvas id="service-chart" height="260"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 p-2">
                        <div class="card card-stretch gutter-b h-100">
                            <div class="card-header border-0">
                                <div class="card-title py-4">
                                    <h3 class="card-label">موجودی واریزی مشتریان به تفکیک حساب</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="text-muted font-size-sm mb-3">
                                    فقط واریزی‌هایی که توسط واحد مالی تایید شده باشن محاسبه می‌شن.
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th>حساب بانکی</th>
                                            <th>مجموع واریزی (تومان)</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bank-table-body">
                                        <tr>
                                            <td colspan="2" class="text-muted">در حال بارگذاری...</td>
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
        fetch('{{ route('reports.data.requests_by_service') }}')
            .then(function (res) { return res.json(); })
            .then(function (data) {
                const ctx = document.getElementById('service-chart');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.items.map(function (i) { return i.title; }),
                        datasets: [{
                            data: data.items.map(function (i) { return i.count; }),
                            backgroundColor: '#3699FF',
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {legend: {display: false}},
                        scales: {x: {beginAtZero: true, ticks: {precision: 0}}}
                    }
                });
            });

        fetch('{{ route('reports.data.bank_balances') }}')
            .then(function (res) { return res.json(); })
            .then(function (data) {
                const tbody = document.getElementById('bank-table-body');
                tbody.innerHTML = '';
                if (data.items.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="2" class="text-muted">داده‌ای موجود نیست</td></tr>';
                    return;
                }
                data.items.forEach(function (item) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = '<td>' + item.title + '</td><td>' + Math.round(item.total).toLocaleString('en-US') + '</td>';
                    tbody.appendChild(tr);
                });
            });
    </script>
@endsection
