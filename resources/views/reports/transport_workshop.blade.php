@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">

                    @php
                        $currentYear = \App\Services\Report\ReportService::currentJalaliYear();
                        $defaults = [
                            'currentYear' => $currentYear,
                            'defaultYear1' => $currentYear, 'defaultMonth1' => null,
                            'defaultYear2' => $currentYear - 1, 'defaultMonth2' => null,
                        ];
                    @endphp

                    @include('reports.partials.trend-compare-card', array_merge($defaults, [
                        'prefix' => 'transport_ref',
                        'cardTitle' => 'تعداد درخواست‌های ارجاع‌شده به مسئول ترابری',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'transport_referrals']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'transport_referrals']),
                        'color' => '#3699FF',
                    ]))

                    @include('reports.partials.trend-compare-card', array_merge($defaults, [
                        'prefix' => 'driver_ref',
                        'cardTitle' => 'تعداد درخواست‌های ارجاع‌شده به راننده',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'driver_referrals']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'driver_referrals']),
                        'color' => '#8950FC',
                    ]))

                    @include('reports.partials.trend-compare-card', array_merge($defaults, [
                        'prefix' => 'driver_cancel',
                        'cardTitle' => 'تعداد درخواست‌های لغوشده توسط راننده',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'driver_cancellations']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'driver_cancellations']),
                        'color' => '#F64E60',
                    ]))

                    @include('reports.partials.trend-compare-card', array_merge($defaults, [
                        'prefix' => 'workshop_ref',
                        'cardTitle' => 'تعداد درخواست‌های ارجاع‌شده به مسئول کارگاه',
                        'trendUrl' => route('reports.data.trend', ['metric' => 'workshop_referrals']),
                        'compareUrl' => route('reports.data.compare', ['metric' => 'workshop_referrals']),
                        'color' => '#1BC5BD',
                    ]))

                </div>
            </div>
        </div>
    </div>

    @include('reports.partials.scripts')

    <div class="container">
        <div class="alert alert-light-warning">
            ⚠️ توجه: چون قبل از این تاریخی برای «کِی راننده تعیین شده» ذخیره نمی‌شد، نمودار «ارجاع به راننده» فقط
            ارجاع‌هایی رو نشون می‌ده که از تاریخ نصب همین آپدیت به بعد ثبت شدن؛ ارجاع‌های قدیمی‌تر توی این نمودار دیده نمی‌شن
            (چون تاریخ دقیقشون هرگز ثبت نشده بود).
        </div>
    </div>
@endsection
