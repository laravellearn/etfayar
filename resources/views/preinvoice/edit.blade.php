@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-8 offset-lg-2">
        <form class="form" action="{{route('preinvoice.update')}}" method="post" id="add_user_form" autocomplete="off"
              enctype="multipart/form-data">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @include('partials.form_error')

            @csrf
            <input type="hidden" name="id" value="{{$single->id}}">

            {{-- اطلاعات کلی --}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات کلی :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center"></div>
                    </div>
                </div>
                <div class="card-body">

                    <div id="request_id_block" class="form-group row">
                        <label class="col-3">@lang("preinvoice.save_preinvoice_for_request")</label>
                        <div class="col-9">
                            <select class="form-control" name="request_id" disabled>
                                <option value="" disabled selected hidden>@lang('preinvoice.choose_request')...</option>
                                @foreach($requests as $item)
                                    <option {{ $single->request_id==$item->id ? 'selected':''}} value="{{$item->id}}">
                                        {{$item->service->title??''}} به شماره درخواست {{$item->code}} برای {{$item->user->fullname??''}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="title_block" class="form-group row">
                        <label class="col-3">@lang("preinvoice.title")</label>
                        <div class="col-9">
                            <select id="information_id" class="form-control" name="information_id" onchange="fir(this)">
                                <option value="" disabled selected hidden>انتخاب عنوان...</option>
                                @foreach($informations as $item)
                                    <option {{ $item->id==$single->information_id ?'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("preinvoice.tax"))
                    @php($caption='')
                    @php($value=$single->tax)
                    <x-InputRow :title="$title" name="tax" id="tax" :value="$value" :caption="$caption" type="number"
                                icon="bx bx-tax"></x-InputRow>

                    @php($title=__("preinvoice.description"))
                    @php($caption='')
                    @php($value=$single->description)
                    <x-InputText :title="$title" name="description" id="description" :value="$value" :caption="$caption"
                                 type="text" icon="bx bx-text"></x-InputText>

                    @php($title=__("preinvoice.code"))
                    @php($caption='')
                    @php($value=$code)
                    <x-InputRow :title="$title" name="code" id="code" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-tax" disabled="disabled"></x-InputRow>
                </div>
            </div>

            {{-- وضعیت --}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">وضعیت پیش فاکتور :</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3">@lang("common.status") <strong>*</strong></label>
                        <div class="col-9">
                            @php($items=[['title'=>'معلق بودن','value'=>'pending'],['title'=>' ارسال به واحد ترابری','value'=>'transport'],['title'=>'ارسال به واحد مالی','value'=>'financial']])
                            <select id="preinvoice_status" class="form-control" name="status">
                                <option value="" disabled selected hidden>انتخاب وضعیت پیش فاکتور...</option>
                                @foreach($items as $item)
                                    @if($item['value']=='financial')
                                        @permission("Send To Financial")
                                        <option {{$single->status==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                        @endpermission
                                    @else
                                        <option {{$single->status==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @include('preinvoice.transport_question')
                </div>
            </div>

            {{-- محصولات --}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">انتخاب محصولات :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            {{-- تغییر: اشاره به editProductModal --}}
                            <a type="button" class="btn btn-light-success font-weight-bold mr-2"
                               data-toggle="modal" data-target="#editProductModal">انتخاب محصولات از انبار</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-10 offset-1" id="productsContainer">
                        {{-- با جاوااسکریپت پر می‌شود --}}
                    </div>
                </div>
            </div>

            {{-- توضیحات --}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">توضیحات :</h3>
                </div>
                <div class="card-body">
                    <div id="kt_repeater_4">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>@lang('preinvoice.choose_description')</label>
                            </div>
                            <div data-repeater-list="description_items" class="col-md-9">
                                @if(!empty($single->descriptions->toArray()))
                                    @foreach($single->descriptions as $description)
                                        <div data-repeater-item="description_item" class="form-group row">
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <select class="form-control" name="description_id">
                                                        <option value="null" disabled selected hidden>انتخاب توضیحات...</option>
                                                        @foreach($descriptions as $item)
                                                            <option {{$item->id==$description->description_id ?'selected':''}} value="{{$item->id}}">{{$item->description}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                    <i class="la la-remove"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div data-repeater-item="item-description" class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <select class="form-control" name="description_id">
                                                    <option value="null" disabled selected hidden>انتخاب توضیحات...</option>
                                                    @foreach($descriptions as $item)
                                                        <option value="{{$item->id}}">{{$item->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                <i class="la la-remove"></i>
                                            </a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- قطعات داغی --}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">لیست قطعات داغی :</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="workshop_id" value="{{$workshop_id}}">
                    <div id="kt_repeater_workshop_form">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>@lang('preinvoice.product')</label>
                            </div>
                            <div data-repeater-list="workshop_items" class="col-md-9">
                                @if(!empty($workshop_items))
                                    @foreach($workshop_items as $workshopItem)
                                        <div data-repeater-item="workshop_item" class="form-group row">
                                            <div class="col-lg-7">
                                                <select class="form-control" name="fireExtinguisherPart_id">
                                                    <option value="null" disabled selected hidden>انتخاب قطعه داغی...</option>
                                                    @foreach($fire_extinguisher_parts as $item)
                                                        <option {{$item->id==$workshopItem['fire_extinguisher_part_id']?'selected':''}} value="{{$item->id}}">{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="number" name="count" class="form-control" value="{{$workshopItem['count']}}" min="0" placeholder="@lang('preinvoice.count')">
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                    <i class="la la-remove"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div data-repeater-item="workshop_item" class="form-group row">
                                        <div class="col-lg-7">
                                            <select class="form-control" name="fireExtinguisherPart_id">
                                                <option value="null" disabled selected hidden>انتخاب قطعه داغی...</option>
                                                @foreach($fire_extinguisher_parts as $item)
                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="number" name="count" class="form-control" min="0" placeholder="@lang('preinvoice.count')">
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                <i class="la la-remove"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9"></div>
                            <div class="col">
                                <div data-repeater-create="" class="btn font-weight-bold btn-primary btn-block">
                                    <i class="la la-product-hunt"></i> @lang('preinvoice.add_product')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.card_footer')
        </form>

        {{-- مودال ویرایش --}}
        @include('preinvoice.edit_products_modal')

    </div>

    <script>
        // ------------------- وضعیت حمل و نقل -------------------
        let preinvoice_status = document.getElementById("preinvoice_status");
        let transportBlock = document.getElementById("transport_question_block");

        if (preinvoice_status.value === 'transport') {
            transportBlock.style.display = "block";
        } else {
            transportBlock.style.display = "none";
        }

        preinvoice_status.addEventListener("change", function (event) {
            transportBlock.style.display = (event.target.value === 'transport') ? "block" : "none";
        });

        // ------------------- محصولات -------------------
        let productsContainer = document.getElementById("productsContainer");

        // تابع حذف ردیف
        function removeElement(element) {
            let row = element.closest('.row');
            if (row) row.remove();
        }

        // تابع بازسازی لیست محصولات از مودال ویرایش
        function add_products() {
            // فقط اینپوت‌های داخل مودال ویرایش
            let $inputs = $('#editProductModal .count');
            $inputs.each(function () {
                let val = parseInt($(this).val(), 10);
                if (isNaN(val) || val <= 0) return;

                let $row = $(this).closest('tr');
                let $titleCell = $row.find('.title');
                let productTitle = $titleCell.data('title');
                let productId = $titleCell.data('id');
                let countValue = $(this).val();

                // قیمت را از حالت فرمت‌شده خارج می‌کنیم
                let priceInput = $row.find('.price');
                let rawPrice = priceInput.val().replace(/,/g, '').trim();
                let priceValue = parseFloat(rawPrice);
                if (isNaN(priceValue) || rawPrice === '') {
                    priceValue = parseFloat(priceInput.data('original-price')) || 0;
                }

                let productValue = productId + '@' + countValue + '@' + priceValue;

                // ساخت ردیف در container
                let inputContainer = document.createElement('div');
                inputContainer.classList.add('row', 'mt-1');
                inputContainer.innerHTML =
                    "<input type='hidden' value='" + productValue + "' class='form-control' name='products[]' style='padding:5px;' readonly/>" +
                    "<input type='text' value='" + productTitle + "' class='col-6 form-control' style='padding-right:20px;' disabled/>" +
                    "<input type='text' value='" + countValue + "' class='col-2 form-control' style='padding-right:20px;' disabled/>" +
                    "<input type='text' value='" + priceValue + "' class='col-2 form-control' style='padding-right:20px;' disabled/>" +
                    "<button type='button' class='btn btn-danger col-2' onclick='removeElement(this)'>حذف</button>";

                productsContainer.appendChild(inputContainer);
            });
        }

        // بارگذاری اولیه محصولات ذخیره‌شده
        add_products();

        // دکمه ذخیره تغییرات در مودال
        document.getElementById('editProductButton').addEventListener('click', function () {
            // پاک کردن محتوای قبلی
            productsContainer.innerHTML = '';
            // بازسازی از مودال
            add_products();
            // بستن مودال
            $('#editProductModal').modal('hide');
        });
    </script>
@endsection