<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column d-print-none" id="kt_footer">
    <!--begin::Container-->
    <div class=" container-fluid  d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::کپی رایت-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2022&copy;</span>
            <a href="#" target="_blank" class="text-dark-75 text-hover-primary">@lang('common.development')</a>
        </div>
        <!--end::کپی رایت-->

        <!--begin::Nav-->
        <div class="nav nav-dark">
            <a href="" target="_blank" class="nav-link pl-0 pr-5"></a>
            <a href="" target="_blank" class="nav-link pl-0 pr-5"></a>
            <a href="" target="_blank" class="nav-link pl-0 pr-0"></a>
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->

{{--
<script src="{{ asset('js/global/plugins.bundle.js') }}"></script>
--}}
{{--<script src="{{ asset('js/custom/prismjs.bundle.js') }}"></script>--}}{{--

<script src="{{ asset('js/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/datatable/datatables.bundle.js') }}"></script>
<script src="{{ asset('js/form/widget/form-repeater.js') }}"></script>
<script src="{{ asset('js/datatable/html.js') }}"></script>
<script src="{{ asset('js/common/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/common/toastr.min.js') }}"></script>
<script src="{{ asset('js/common/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('js/inputmask/input-mask.js') }}"></script>
<script src="{{ asset('js/charts/widgets.js') }}"></script>
<script src="{{ asset('js/common/common.js') }}"></script>
--}}
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script src="{{ asset('js/charts/plugins.bundle.js_v=7.0.6') }}"></script>
<script src="{{ asset('js/charts/prismjs.bundle.js_v=7.0.6') }}"></script>
<script src="{{ asset('js/charts/scripts.bundle.js_v=7.0.6') }}"></script>
<script src="{{ asset('js/charts/widgets.js') }}"></script>
<script src="{{ asset('js/datatable/datatables.bundle.js') }}"></script>
<script src="{{ asset('js/form/widget/form-repeater.js') }}"></script>
<script src="{{ asset('js/datatable/html.js') }}"></script>
<script src="{{ asset('js/common/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/common/toastr.min.js') }}"></script>
<script src="{{ asset('js/common/loadingoverlay.min.js') }}"></script>
{{--<script src="{{ asset('js/wizard/wizard-4.js') }}"></script>--}}
<script src="{{ asset('js/datetimepicker/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('js/form/validation/form-controls.js') }}"></script>
<script src="{{ asset('js/datetimepicker/jquery.md.bootstrap.datetimepicker.js') }}"></script>
<script src="{{ asset('js/datetimepicker/datepicker.js') }}"></script>

<script src="{{ asset('js/common/common.js') }}"></script>

<script>
// این کد را در یک فایل js عمومی قرار دهید یا در <script> انتهای layout
(function() {
    function toggleSubmitButtons(disable) {
        // تمام دکمه‌های submit و buttonهای داخل form را هدف می‌گیرد
        var buttons = document.querySelectorAll('form button[type="submit"], form input[type="submit"]');
        buttons.forEach(function(btn) {
            btn.disabled = disable;
            // (اختیاری) تغییر استایل یا نمایش tooltip
            if (disable) {
                btn.setAttribute('title', 'ارسال به دلیل قطع اینترنت ممکن نیست');
                btn.style.opacity = '0.6';
                btn.style.cursor = 'not-allowed';
            } else {
                btn.removeAttribute('title');
                btn.style.opacity = '';
                btn.style.cursor = '';
            }
        });
    }

    // وضعیت اولیه
    toggleSubmitButtons(!navigator.onLine);

    // گوش دادن به قطع و وصل شدن
    window.addEventListener('offline', function() {
        toggleSubmitButtons(true);
    });

    window.addEventListener('online', function() {
        toggleSubmitButtons(false);
    });
})();
</script>

{{-- نمایش سراسری پیغام‌های موفقیت/خطا با toastr روی همه‌ی صفحات --}}
@if(session('status') || session('success') || session('error') || (isset($errors) && $errors->any()))
<script>
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-left",
            "rtl": true,
            "timeOut": "5000",
            "newestOnTop": true
        };

        @if(session('status'))
            toastr.success(@json(session('status')));
        @endif

        @if(session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if(session('error'))
            toastr.error(@json(session('error')));
        @endif

        @if(isset($errors) && $errors->any())
            @foreach($errors->all() as $validationError)
                toastr.error(@json($validationError));
            @endforeach
        @endif
    }
</script>
@endif

@stack("addUserForm")
@stack("addProductForm")
