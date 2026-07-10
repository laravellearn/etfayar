@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-8 offset-lg-2">
        <form class="form" action="{{route('invoice.update')}}" method="post" id="add_user_form" autocomplete="off"
              enctype="multipart/form-data">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif
            @include('partials.form_error')


            @csrf
            <input type="hidden" name="id" value="{{$single->id}}">

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
                            <select class="form-control" name="request_id" disabled>
                                <option value="" disabled selected hidden>@lang('preinvoice.choose_request')...</option>
                                @foreach($requests as $item)
                                    <option
                                        {{ $single->request_id==$item->id ? 'selected':''}}  value="{{$item->id}}">{{$item->service->title??''}}
                                        به شماره درخواست {{$item->code}} برای {{$item->user->fullname??''}}</option>
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
                                    <option
                                        {{ $item->id==$single->information_id ?'selected':'' }} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{--  <div id="title_block" class="form-group row">
                          <label class="col-3">@lang("preinvoice.title")</label>
                          <div class="input-group col-9">
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
                              <input id="title" name="title" placeholder="انتخاب عنوان" value="{{$single->title}}"
                                     type="text" class="form-control"
                                     aria-label="input with dropdown button" readonly>

                              <input type="hidden" id="header" name="header" value="{{$single->header}}">
                              <input type="hidden" id="sign" name="sign" value="{{$single->sign}}">
                              <input type="hidden" id="information_id" name="information_id"
                                     value="{{$single->information_id}}">

                          </div>
                      </div>--}}




                    @php($title=__("preinvoice.tax"))
                    @php($caption='')
                    @php($value=$single->tax)
                    <x-InputRow :title="$title" name="tax" id="tax" :value="$value" :caption="$caption" type="number"
                                icon="bx bx-tax">

                    </x-InputRow>

                    @php($title=__("preinvoice.description"))
                    @php($caption='')
                    @php($value=$single->description)
                    <x-InputText :title="$title" name="description" id="description" :value="$value" :caption="$caption"
                                 type="text" icon="bx bx-text">

                    </x-InputText>

                    {{--   @php($title=__("preinvoice.page_header"))
                       @php($caption='')
                       @php($value='')
                       <x-InputRow :title="$title" name="header" id="header" :value="$value" :caption="$caption"
                                   type="file"
                                   icon="bx bx-tax">
                       </x-InputRow>


                       <div class="form-group row">
                           <label class="col-3 col-form-label">حذف فایل سربرگ</label>
                           <div class="col-3">
                               <span class="switch">
                                   <label>
                                       <input type="checkbox" name="is_delete_header">
                                       <span></span>
                                   </label>
                               </span>
                           </div>

                       </div>


                       @php($title=__("preinvoice.page_footer"))
                       @php($caption='')
                       @php($value='')
                       <x-InputRow :title="$title" name="footer" id="footer" :value="$value" :caption="$caption"
                                   type="file"
                                   icon="bx bx-file">
                       </x-InputRow>


                       <div class="form-group row">
                           <label class="col-3 col-form-label">حذف فایل پابرگ</label>
                           <div class="col-3">
                               <span class="switch">
                                   <label>
                                       <input type="checkbox" name="is_delete_footer">
                                       <span></span>
                                   </label>
                               </span>
                           </div>

                       </div>
   --}}
                    @php($title=__("preinvoice.code"))
                    @php($caption='')
                    @php($value=$code)
                    <x-InputRow :title="$title" name="code" id="code" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-tax" disabled="disabled">
                    </x-InputRow>

                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">وضعیت فاکتور
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
                            <select id="preinvoice_status" class="form-control form-control" name="status">
                                <option value="" disabled selected hidden>انتخاب وضعیت پیش فاکتور...</option>
                                @foreach($items as $item)
                                    <option
                                        {{$single->status==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
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
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div id="kt_repeater_4">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>@lang('preinvoice.choose_description')</label>
                            </div>
                            <div data-repeater-list="group_descriptions" class="col-md-9">
                                @if(!empty($single->descriptions->toArray()))
                                    @foreach($single->descriptions as $description)
                                        <div data-repeater-item="item-description" class="form-group row">

                                            <div class="col-lg-9">
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

                                        <div class="col-lg-6">
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

            {{--FireExtinguisherParts--}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">لیست قطعات داغی
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
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
                                                <div class="input-group">
                                                    <select class="form-control" name="fireExtinguisherPart_id">
                                                        <option value="null" disabled selected hidden>انتخاب قطعه
                                                            داغی...
                                                        </option>
                                                        @foreach($fire_extinguisher_parts as $item)
                                                            <option
                                                                {{$item->id==$workshopItem['fire_extinguisher_part_id']?'selected':''}} value="{{$item->id}}">{{$item->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <input type="number" name="count" id="count" class="form-control"
                                                           value="{{$workshopItem['count']}}" min="0"
                                                           placeholder="@lang('preinvoice.count')">
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
                                    <div data-repeater-item="workshop_item" class="form-group row">
                                        <div class="col-lg-7">
                                            <div class="input-group">
                                                <select class="form-control" name="fireExtinguisherPart_id">
                                                    <option value="null" disabled selected hidden>انتخاب قطعه داغی...
                                                    </option>
                                                    @foreach($fire_extinguisher_parts as $item)
                                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-group">
                                                <input type="number" name="count" id="count" min="0"
                                                       class="form-control"
                                                       placeholder="@lang('preinvoice.count')">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn font-weight-bold btn-danger btn-icon">
                                                <i class="la la-remove"></i> </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9">


                            </div>
                            <div class="col">
                                <div data-repeater-create="" class="btn font-weight-bold btn-primary btn-block">
                                    <i class="la la-product-hunt"></i> @lang('preinvoice.add_product')
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
        @include('invoice.edit_products_modal')
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

        /*document.getElementsByClassName("product").addEventListener("change", function (event) {
            console.log(event.target.value);

        });*/

        let productsContainer = document.getElementById("productsContainer");

        let addProductModal = document.getElementById("addProductModal");

        let addProductButton = document.getElementById("addProductButton");
        let cancelModalButton = document.getElementById("cancelModalButton");


        addProductButton.addEventListener("click", function (event) {
            $('#productsContainer').html('');
            add_products();
            $('#addProductModal').modal('hide');

        });


        function removeElement(element) {
            element.parentElement.remove();
        }

        function add_products() {
            $inputs = $('.count');
            $inputs.each(function (index) {
                let val = parseInt($(this).val());
                if (val > 0) {
                    $product_wraper = $(this).parent().parent();
                    $product_title = $product_wraper.find('.title').data('title');
                    $product_data_id = $product_wraper.find('.title').data('id');

                    $count_elemnt = $product_wraper.find('.count');
                    $count_elemnt_value = $count_elemnt.val();

                    $price_elemnt = $product_wraper.find('.price');
                    $price_elemnt_value = $price_elemnt.val();
                    console.log(val, $product_title);
                    let productValue = $product_data_id + '@' + $count_elemnt_value + '@' + $price_elemnt_value;

                    let inputContainer = document.createElement('div');
                    inputContainer.classList.add("row");
                    inputContainer.classList.add("mt-1");
                    inputContainer.innerHTML =
                        "<input type='hidden' value='" + productValue + "' class='form-control ' name='products[]' style='padding:5px;' readonly/>" + " " +
                        "<input type='text' value='" + $product_title + "' class='col-6 form-control ' style='padding-right:20px;' disabled/>" +
                        "<input type='text' value='" + $count_elemnt_value + "' class='col-2 form-control  ' style='padding-right:20px;' disabled/>" +
                        "<input type='text' value='" + $price_elemnt_value + "' class='col-2 form-control  ' style='padding-right:20px;' disabled/>" +
                        "<button id='del' class='btn btn-danger col-2 ' onclick='removeElement(this)'>حذف</>";


                    productsContainer.appendChild(inputContainer);

                }
            });
        }

        add_products();

        function enforceMinMax(el) {
            if (el.value != "") {
                if (parseInt(el.value) < parseInt(el.min)) {
                    el.value = el.min;
                }
                if (parseInt(el.value) > parseInt(el.max)) {
                    el.value = el.max;
                }
            }
        }
    </script>
@endsection
