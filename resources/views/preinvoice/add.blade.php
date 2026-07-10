@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-8 offset-lg-2">
        <form class="form" action="{{route('preinvoice.store')}}" method="post" id="add_user_form" autocomplete="off"
              enctype="multipart/form-data">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif
            @include('partials.form_error')


            @csrf

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات کلی
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div id="request_id_block" class="form-group row">
                        <label class="col-3">@lang("preinvoice.save_preinvoice_for_request")</label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="request_id" data-size="5"
                                    data-live-search="true">
                                <option value="" disabled selected hidden>@lang('preinvoice.choose_request')...</option>
                                @foreach($requests as $item)
                                    <option value=" {{$item->id}}">{{$item->service->title??''}} به شماره
                                        درخواست {{$item->code}} برای {{$item->user->fullname??''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="title_block" class="form-group row">
                        <label class="col-3">@lang("preinvoice.title")</label>
                        <div class="col-9">
                            <select id="information_id" class="form-control form-control" name="information_id"
                                    onchange="fir(this)">
                                <option value="" disabled selected hidden>انتخاب عنوان...</option>
                                @foreach($informations as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="input-group col-9">
                         <div class="input-group-prepend show">
                             <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                     aria-haspopup="true" aria-expanded="true">
                                 انتخاب عنوان
                             </button>
                             <div id="dropdown-menu" class="dropdown-menu">
                                 @foreach($informations as $item)
                                     <a onclick="getSelected(this,{{$item}})" class="dropdown-item"
                                        href="#">{{$item->name}}</a>
                                 @endforeach
                             </div>
                         </div>
                         <input id="title" name="title" placeholder="انتخاب عنوان" type="text" class="form-control"
                                aria-label="input with dropdown button" readonly>


                       --}}{{--  <input type="hidden" id="header" name="header" value="">
                         <input type="hidden" id="sign" name="sign" value="">
                         <input type="hidden" id="information_id" name="information_id" value="">
--}}{{--
                     </div>--}}


                    @php($title=__("preinvoice.tax"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="tax" id="tax" :value="$value" :caption="$caption" type="number"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("preinvoice.description"))
                    @php($caption='')
                    @php($value=(old('description')))
                    <x-InputText :title="$title" name="description" id="description" :value="$value" :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>

                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">وضعیت پیش فاکتور
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-3">@lang("common.status") <strong>*</strong></label>
                        <div class="col-9">
                            @php($items=[['title'=>'معلق بودن','value'=>'pending'],['title'=>' ارسال به واحد ترابری','value'=>'transport'],['title'=>'ارسال به واحد مالی','value'=>'financial']])
                            <select id="preinvoice_status" class="form-control form-control" name="status"
                                    onchange="fir(this)">
                                <option value="" disabled selected hidden>انتخاب وضعیت پیش فاکتور...</option>
                                @foreach($items as $item)
                                    <option
                                        {{old('identity_type')==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @include('preinvoice.transport_question')


                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">انتخاب محصولات
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <a type="button" class="btn btn-light-success font-weight-bold mr-2"
                               data-toggle="modal" data-target="#addProductModal">انتخاب محصولات از انبار
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="col-10 offset-1" id="productsContainer">

                    </div>

                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">توضیحات
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="kt_repeater_4">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>@lang('preinvoice.choose_description')</label>
                            </div>
                            <div data-repeater-list="group_descriptions" class="col-md-9">
                                @if(!is_null(old('PreinvoiceDescription')))
                                    @foreach(old('PreinvoiceDescription')->PreinvoiceDescription as $description)
                                        <div data-repeater-item="item-description" class="form-group row">

                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <select class="form-control" name="description_id">
                                                        <option value="null" disabled selected hidden>انتخاب توضیحات...
                                                        </option>
                                                        @foreach($descriptions as $item)
                                                            <option
                                                                {{$item->id==$description->description_id ?'selected':''}}  value="{{$item->id}}">{{$item->description}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <a href="javascript:;" data-repeater-delete=""
                                                   class="btn font-weight-bold btn-danger btn-icon">
                                                    <i class="la la-remove"></i> </a>
                                            </div>
                                        </div>
                                    @endforeach

                                @else
                                    <div data-repeater-item="item-description" class="form-group row">

                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <select class="form-control" name="description_id">
                                                    <option value="null" disabled selected hidden>انتخاب توضیحات...
                                                    </option>
                                                    @foreach($descriptions as $item)
                                                        <option value="{{$item->id}}">{{$item->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn font-weight-bold btn-danger btn-icon">
                                                <i class="la la-remove"></i> </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9"></div>
                            <div class="col">
                                <div data-repeater-create="" class="btn font-weight-bold btn-primary btn-block">
                                    <i class="la la-file-text"></i> @lang('description.add')
                                </div>
                                <span class="form-text text-muted"></span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @include('partials.card_footer')

        </form>


        <!-- begin modal-->
        @include('preinvoice.add_products_modal')
        <!-- end modal-->


    </div>
    <script>


        let preinvoice_status_value = document.getElementById("preinvoice_status").options[document.getElementById("preinvoice_status").selectedIndex].value;
        if (preinvoice_status_value === 'transport') {
            document.getElementById("transport_question_block").style.display = "block";
        } else {
            document.getElementById("transport_question_block").style.display = "none";
        }

        document.getElementById("preinvoice_status").addEventListener("change", function (event) {
            if (event.target.value === 'transport') {
                document.getElementById("transport_question_block").style.display = "block";
            } else {
                document.getElementById("transport_question_block").style.display = "none";
            }
        });

        let productsContainer = document.getElementById("productsContainer");

        let addProductModal = document.getElementById("addProductModal");

        let addProductButton = document.getElementById("addProductButton");
        let cancelModalButton = document.getElementById("cancelModalButton");


// تابع حذف ردیف (با استفاده از closest برای اطمینان)
function removeElement(element) {
    var row = element.closest('.row');
    if (row) row.remove();
}

// دکمه افزودن
document.getElementById('addProductButton').addEventListener('click', function () {
    // تب فعال در مودال
    var activePane = document.querySelector('#addProductModal .tab-pane.active');
    if (!activePane) return;

    // تمام فیلدهای count داخل تب فعال
    var countInputs = activePane.querySelectorAll('.count');
    var container = document.getElementById('productsContainer');

    countInputs.forEach(function(input) {
        var raw = input.value.trim();
        var countVal = parseInt(raw, 10);

        // فقط اگر عدد معتبر و بزرگ‌تر از صفر باشد
        if (isNaN(countVal) || countVal <= 0) return;

        var row = input.closest('tr');
        var titleCell = row.querySelector('.title');
        var productId   = titleCell.dataset.id;
        var productTitle = titleCell.dataset.title;

        // قیمت: حذف کاما و بررسی معتبر بودن
        var priceInput = row.querySelector('.price');
        var rawPrice = priceInput.value.replace(/,/g, '').trim();
        var priceVal = parseFloat(rawPrice);
        // اگر نامعتبر بود، از مقدار پیش‌فرض (data-original-price) استفاده کن
        if (isNaN(priceVal) || rawPrice === '') {
            priceVal = parseFloat(priceInput.dataset.originalPrice) || 0;
        }

        // فرمت: id@تعداد@قیمت
        var productValue = productId + '@' + countVal + '@' + priceVal;

        // جستجوی ردیف تکراری در container
        var existingInput = container.querySelector('input[name="products[]"][value^="' + productId + '@"]');
        if (existingInput) {
            // به‌روزرسانی ردیف موجود
            var parentRow = existingInput.closest('.row');
            existingInput.value = productValue;

            // به‌روزرسانی نمایش تعداد و قیمت
            var displayInputs = parentRow.querySelectorAll('input[disabled]');
            if (displayInputs.length >= 2) {
                displayInputs[1].value = countVal;   // تعداد
                displayInputs[2].value = priceVal;   // قیمت
            }
        } else {
            // ایجاد ردیف جدید
            var div = document.createElement('div');
            div.classList.add('row', 'mt-1');
            div.innerHTML =
                "<input type='hidden' value='" + productValue + "' class='form-control' name='products[]' style='padding:5px;' readonly/>" +
                "<input type='text' value='" + productTitle + "' class='col-6 form-control' style='padding-right:20px;' disabled/>" +
                "<input type='text' value='" + countVal + "' class='col-2 form-control' style='padding-right:20px;' disabled/>" +
                "<input type='text' value='" + priceVal + "' class='col-2 form-control' style='padding-right:20px;' disabled/>" +
                "<button type='button' class='btn btn-danger col-2' onclick='removeElement(this)'>حذف</button>";

            container.appendChild(div);
        }
    });

    // بستن مودال
    $('#addProductModal').modal('hide');
});

function removeElement(element) {
    element.closest('.row').remove();
}

        function removeElement(element) {
            element.parentElement.remove();
        }

    </script>
@endsection
