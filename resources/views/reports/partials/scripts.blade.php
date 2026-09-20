{{--
    توابع کمکیِ مشترکِ جاوااسکریپت برای همه‌ی صفحات داشبورد گزارشات.
    این partial باید فقط یک بار، در انتهای هر صفحه‌ی گزارش، include بشه.

    از Chart.js (نسخه‌ی سبک، از CDN) برای رسم نمودارها استفاده می‌کنیم؛ چون
    هیچ کتابخانه‌ی نموداری در پروژه از قبل نصب نبود (ویجت نمودار قدیمیِ
    داشبورد هم اصلاً کار نمی‌کرد، چون فایلِ جاوااسکریپتش وجود نداشت).
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.1/chart.umd.min.js"></script>
<script>
    const REPORT_MONTH_NAMES = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];

    function reportNumberFormat(n) {
        n = Math.round(n * 10) / 10;
        return n.toLocaleString('en-US');
    }

    // ------------------------------------------------------------------
    // نمودار روند ماهانه (بار چارت)
    // ------------------------------------------------------------------
    function renderReportTrendChart(canvasId, dataUrl, color) {
        const ctx = document.getElementById(canvasId);
        if (!ctx) return;
        fetch(dataUrl)
            .then(function (res) { return res.json(); })
            .then(function (data) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: '',
                            data: data.values,
                            backgroundColor: color || '#3699FF',
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {legend: {display: false}},
                        scales: {y: {beginAtZero: true, ticks: {precision: 0}}}
                    }
                });
            })
            .catch(function () {
                ctx.parentElement.insertAdjacentHTML('beforeend', '<div class="text-danger small mt-2">خطا در دریافت اطلاعات نمودار</div>');
            });
    }

    // ------------------------------------------------------------------
    // ویجتِ مقایسه‌ی دو دوره (هرکدوم: یک سال کامل یا یک ماهِ مشخص از یک سال)
    // prefix: پیشوندِ id عناصر HTML مربوط به این ویجت (مثلاً "customers")
    // compareUrl: آدرس endpoint (بدونِ کوئری‌استرینگ)
    // ------------------------------------------------------------------
    function initReportCompareWidget(prefix, compareUrl) {
        const btn = document.getElementById(prefix + '-compare-btn');
        if (!btn) return;

        function run() {
            const year1 = document.getElementById(prefix + '-year1').value;
            const month1 = document.getElementById(prefix + '-month1').value;
            const year2 = document.getElementById(prefix + '-year2').value;
            const month2 = document.getElementById(prefix + '-month2').value;

            const params = new URLSearchParams({year1: year1, month1: month1, year2: year2, month2: month2});

            fetch(compareUrl + '?' + params.toString())
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    document.getElementById(prefix + '-label1').innerText = data.period1.label;
                    document.getElementById(prefix + '-value1').innerText = reportNumberFormat(data.period1.value);
                    document.getElementById(prefix + '-label2').innerText = data.period2.label;
                    document.getElementById(prefix + '-value2').innerText = reportNumberFormat(data.period2.value);

                    const diffEl = document.getElementById(prefix + '-diff');
                    if (data.diff_percent === null) {
                        diffEl.innerText = '—';
                        diffEl.className = 'font-weight-bold text-muted';
                    } else {
                        const sign = data.diff_percent > 0 ? '+' : '';
                        diffEl.innerText = sign + data.diff_percent + '٪';
                        diffEl.className = 'font-weight-bold ' + (data.diff_percent >= 0 ? 'text-success' : 'text-danger');
                    }
                });
        }

        btn.addEventListener('click', run);
        run();
    }

    // پرکردنِ select های سال/ماه برای یک ویجتِ مقایسه
    function fillReportYearMonthSelects(prefix, currentYear, defaultYear1, defaultMonth1, defaultYear2, defaultMonth2) {
        const years = [];
        for (let y = currentYear; y >= currentYear - 6; y--) years.push(y);

        function fillYearSelect(id, selected) {
            const el = document.getElementById(id);
            years.forEach(function (y) {
                const opt = document.createElement('option');
                opt.value = y;
                opt.text = y;
                if (y === selected) opt.selected = true;
                el.appendChild(opt);
            });
        }

        function fillMonthSelect(id, selected) {
            const el = document.getElementById(id);
            const optAll = document.createElement('option');
            optAll.value = '';
            optAll.text = 'کل سال';
            el.appendChild(optAll);
            REPORT_MONTH_NAMES.forEach(function (name, idx) {
                const opt = document.createElement('option');
                opt.value = idx + 1;
                opt.text = name;
                if ((idx + 1) === selected) opt.selected = true;
                el.appendChild(opt);
            });
        }

        fillYearSelect(prefix + '-year1', defaultYear1);
        fillMonthSelect(prefix + '-month1', defaultMonth1);
        fillYearSelect(prefix + '-year2', defaultYear2);
        fillMonthSelect(prefix + '-month2', defaultMonth2);
    }
</script>
