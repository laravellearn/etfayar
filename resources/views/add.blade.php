@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-8 offset-lg-2">
        <form class="form" action="{{route('user.store')}}" method="post" id="add_user_form" autocomplete="off">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif
            @include('partials.form_error')
            @csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات مشتری
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="identity_type_block" class="form-group row">
                        <label class="col-3">@lang("user.identity_type") <strong>*</strong></label>
                        <div class="col-9">
                            @php($items=[['title'=>'حقیقی','value'=>'natural'],['title'=>'حقوقی','value'=>'legal']])
                            <select class="form-control form-control" name="identity_type" id="identity_type">
                                {{-- <option value="" disabled selected hidden>انتخاب نوع هویت...</option>--}}
                                @foreach($items as $item)
                                    <option
                                        {{old('identity_type')==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="name_block" class="form-group row">
                        <label class="col-3">@lang('user.name') <strong>*</strong></label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="name" id="name"
                                   value="{{old('name')}}" placeholder="@lang('user.name')">

                        </div>
                    </div>
                    <div id="family_block" class="form-group row">
                        <label class="col-3">@lang("user.family") <strong>*</strong></label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="family" id="family"
                                   value="{{old('family')}}" placeholder="@lang("user.family")">
                        </div>
                    </div>
                    <div id="national_code_block" class="form-group row">
                        <label class="col-3">@lang("user.national_code")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="national_code"
                                   id="national_code"
                                   value="{{old('national_code')}}" placeholder="@lang("user.national_code")">
                        </div>
                    </div>
                    <div id="company_block" class="form-group row">
                        <label class="col-3">@lang("user.company")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="company" id="company"
                                   value="{{old('company')}}" placeholder="@lang("user.company")">
                        </div>
                    </div>
                    <div id="connector_name_block" class="form-group row">
                        <label class="col-3">@lang("user.connector_name")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="connector_name"
                                   id="connector_name"
                                   value="{{old('connector_name')}}" placeholder="@lang("user.connector_name")">
                        </div>
                    </div>
                    <div id="connector_position_block" class="form-group row">
                        <label class="col-3">@lang("user.connector_position")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="connector_position"
                                   id="connector_position"
                                   value="{{old('connector_position')}}"
                                   placeholder="@lang("user.connector_position")">
                        </div>
                    </div>
                    <div id="economic_code_block" class="form-group row">
                        <label class="col-3">@lang("user.economic_code")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="economic_code"
                                   value="{{old('economic_code')}}"
                                   placeholder="@lang("user.economic_code")">
                        </div>
                    </div>
                    <div id="registration_number_block" class="form-group row">
                        <label class="col-3">@lang("user.registration_number")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="registration_number"
                                   id="registration_number"
                                   value="{{old('registration_number')}}"
                                   placeholder="@lang("user.registration_number")">
                        </div>
                    </div>
                    <div id="gender_block" class="form-group row">
                        <label class="col-3">@lang("user.gender")</label>
                        <div class="col-9">
                            @php($items=[['title'=>'مذکر','value'=>'male'],['title'=>'مونث','value'=>'female']])
                            <select class="form-control form-control" name="gender" id="gender">
                                <option value="" disabled selected hidden>انتخاب جنسیت...</option>
                                @foreach($items as $item)
                                    <option
                                        {{old('gender')==$item['value']?'selected':''}}   value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات تماس :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <a type="button" class="btn btn-light-success font-weight-bold mr-2"
                               data-toggle="modal" data-target="#addMobileModal">افزودن تلفن همراه دیگر
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-3">@lang('user.email')</label>
                        <div class="col-9">
                            <div class="input-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="la la-at"></i></span></div>
                                <input type="text" class="form-control form-control" name="email" id="email"
                                       value="{{old('email')}}" placeholder="@lang("user.email")">
                            </div>
                            <span class="form-text text-muted">مثال :sample@gmail.com</span>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang('user.website')</label>
                        <div class="col-9">
                            <div class="input-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="flaticon2-world"></i></span></div>
                                <input type="text" class="form-control form-control" name="website" id="website"
                                       value="{{old('website')}}" placeholder="@lang("user.website")">
                            </div>
                            <span class="form-text text-muted"> مثال: https://sample.com </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang('user.telephone') <strong>*</strong></label>
                        <div class="col-9">
                            <div class="input-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="la la-phone"></i></span></div>
                                <input type="text" class="form-control form-control" name="telephone"
                                       id="telephone"
                                       value="{{old('telephone')}}" placeholder="@lang("user.telephone")">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3"></label>
                        <div class="col-9">
                                <span id="user_telephone_container" style="visibility: hidden"
                                      class="form-text text-muted">
                                این تلفن برای
                            <a style="display: inline;" href="" id="user_telephone" target="_blank"
                               class="form-text text-primary"></a>
                                ثبت شده است
                            </span>
                        </div>

                    </div>


                    <div class="form-group row">
                        <label class="col-3">@lang('user.primary_mobile') <strong>*</strong></label>
                        <div class="col-9">
                            <div class="input-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                <input type="text" class="form-control form-control" name="mobile" id="mobile"
                                       value="{{old('mobile')}}" placeholder="@lang('user.primary_mobile')"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3"></label>
                        <div class="col-9">
                                <span id="user_mobile_container" style="visibility: hidden"
                                      class="form-text text-muted">
                                این تلفن همراه برای
                            <a style="display: inline;" href="" id="user_mobile" target="_blank"
                               class="form-text text-primary"></a>
                                ثبت شده است
                            </span>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang('user.mobile_owner') <strong>*</strong></label>
                        <div class="col-9">
                            <div class="input-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="la la-user"></i></span></div>
                                <input type="text" class="form-control form-control" name="mobile_owner"
                                       id="mobile_owner"
                                       value="{{old('mobile_owner')}}" placeholder="@lang('user.mobile_owner')">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang('user.additinal_mobile_phone')</label>
                        <div class="col-9">
                            <div id="additionalMobilesContainer">

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات آدرس
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3">@lang("user.city") <strong>*</strong></label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="city_id" id="city_id" data-size="5"
                                    data-live-search="true"
                                    data-fv-not-empty="true"
                                    data-fv-not-empty___message="لطفا یک شهر را انتخاب نمایید"
                                    required>
                                <option value="null" disabled selected hidden>انتخاب شهر...</option>
                                @foreach($cities as $item)
                                    <option
                                        {{old('city_id')==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("user.area")</label>
                        <div class="col-9">
                            <input class="form-control" type="text" name="area" id="area"
                                   value="{{old('area')}}" placeholder="@lang("user.area")">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("user.postal_code")</label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="postal_code"
                                   id="postal_code"
                                   value="{{old('postal_code')}}" placeholder="@lang("user.postal_code")">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("user.address") <strong>*</strong></label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="address" id="address"
                                   value="{{old('address')}}" placeholder="@lang("user.address")">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("user.location") </label>
                        <div class="col-9">
                            <input class="form-control form-control" type="text" name="location" id="location"
                                   value="{{old('location')}}" placeholder="@lang("user.location")">
                        </div>
                    </div>


                </div>
            </div>

            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">وضعیت :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-3">@lang("acquaintance.title2") <strong>*</strong></label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="acquaintance_id" id="acquaintance_id"
                                    data-size="5"
                                    data-live-search="true"
                                    data-fv-not-empty="true"
                                    data-fv-not-empty___message="نوع آشنایی با مشتری را انتخاب نمایید"
                                    required>
                                <option value="null" disabled selected hidden>انتخاب نوع آشنایی...</option>
                                @foreach($acquaintances as $item)
                                    <option
                                        {{old('acquaintance_id')==$item->id?'selected':''}} value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3">@lang('service.services')</label>
                        <div class="checkbox-list col-9">
                            @foreach($services as $item)
                                @if(!is_null(old('services')))
                                    <label class="checkbox"> <input type="checkbox"
                                                                    {{in_array($item->id,old('services'))?'checked':''}} name="services[]"
                                                                    value="{{$item->id}}">
                                        <span></span> {{$item->title}}
                                    </label>
                                @else
                                    <label class="checkbox"> <input type="checkbox" name="services[]"
                                                                    value="{{$item->id}}">
                                        <span></span> {{$item->title}}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @php($status=1)
                    @include('partials.status_input')

                </div>
            </div>

            @include('partials.card_footer')

            <!-- begin modal-->
            <div class="modal fade" id="addMobileModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="staticdrop" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">افزودن شماره همراه جدید</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-4">@lang('user.mobile')</label>
                                <div class="col-8">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                        <input type="text" class="form-control" name="mobile_additional"
                                               id="mobileInput"
                                               value="" placeholder="@lang('user.mobile')"
                                               required>
                                    </div>
                                    {{--<span class="form-text text-muted">تلفن همراه اصلی ضروری می باشد.</span>--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4"></label>
                                <div class="col-8">
                                <span id="user_mobile_modal_container" style="visibility: hidden"
                                      class="form-text text-muted">
                                 این تلفن همراه برای
                            <a style="display: inline;" href="" id="user_mobile_modal" target="_blank"
                               class="form-text text-primary"></a>
                                ثبت شده است
                            </span>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-4">@lang('user.telephone')</label>
                                <div class="col-8">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" class="form-control" name="telephone_additional"
                                               id="telephoneInput"
                                               value="" placeholder="@lang('user.telephone')"
                                               required>
                                    </div>
                                    {{--<span class="form-text text-muted">تلفن همراه اصلی ضروری می باشد.</span>--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3"></label>
                                <div class="col-9">
                                <span id="user_telephone_modal_container" style="visibility: hidden"
                                      class="form-text text-muted">
                                این تلفن برای
                            <a style="display: inline;" href="" id="user_telephone_modal" target="_blank"
                               class="form-text text-primary"></a>
                                ثبت شده است
                            </span>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-4">@lang('user.mobile_owner')</label>
                                <div class="col-8">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-user"></i></span></div>
                                        <input type="text" class="form-control" name="mobile_owner_additional"
                                               id="mobileOwnerInput"
                                               value="" placeholder="@lang('user.mobile_owner')">
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button id="cancelModalButton" type="button"
                                        class="btn btn-light-primary font-weight-bold"
                                        data-dismiss="modal">انصراف
                                </button>
                                <button id="addMobileNumberButton" type="button"
                                        class="btn btn-primary font-weight-bold">افزودن
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal-->

        </form>
    </div>
    @push('addUserForm')
        <script>

            document.getElementById("identity_type").addEventListener("change", function (event) {
                console.log("identity_type=" + event.target.value);
                document.cookie = "identity_type=" + event.target.value;
                check_identity_type(event.target.value)
            });

            let identity_type_value = document.getElementById("identity_type").options[document.getElementById("identity_type").selectedIndex].value;
            check_identity_type(identity_type_value);

            function check_identity_type(type) {
                if (type == 'natural') {//حقیقی
                    naturalInputs();
                } else {//حقوقی
                    legalInputs();
                }
            }


            function naturalInputs() {//حقیقی
                document.getElementById("connector_name_block").style.display = "none";
                document.getElementById("connector_position_block").style.display = "none";
                document.getElementById("company_block").style.display = "none";
                document.getElementById("economic_code_block").style.display = "none";
                document.getElementById("registration_number_block").style.display = "none";

                document.getElementById("national_code_block").style.display = "flex";
                document.getElementById("gender_block").style.display = "flex";
                document.getElementById("name_block").style.display = "flex";
                document.getElementById("family_block").style.display = "flex";
            }

            function legalInputs() {//حقوقی
                document.getElementById("connector_name_block").style.display = "flex";
                document.getElementById("connector_position_block").style.display = "flex";
                document.getElementById("company_block").style.display = "flex";
                document.getElementById("economic_code_block").style.display = "flex";
                document.getElementById("registration_number_block").style.display = "flex";

                document.getElementById("national_code_block").style.display = "none";
                document.getElementById("gender_block").style.display = "none";
                document.getElementById("name_block").style.display = "none";
                document.getElementById("family_block").style.display = "none";
            }


            document.getElementById("telephone").addEventListener("change", function (event) {
                $telephone = event.target.value;

                $.ajax({
                    method: "POST",
                    url: "/api/checkExistTelephone",
                    data: {telephone: $telephone}
                })
                    .done(function (msg) {
                        //alert("Data : " + msg);
                        console.log(msg)

                        if (msg.valid === true) {
                            $("#user_telephone").text(msg.user.name + ' ' + msg.user.family);
                            $("#user_telephone").attr("href", "/admin/user/show/" + msg.user.id);
                            $("#user_telephone_container").css("visibility", "visible");
                        } else {
                            $("#user_telephone_container").css("visibility", "hidden");
                        }


                    });


            });

            document.getElementById("telephoneInput").addEventListener("change", function (event) {
                $telephone = event.target.value;

                $.ajax({
                    method: "POST",
                    url: "/api/checkExistTelephone",
                    data: {telephone: $telephone}
                })
                    .done(function (msg) {

                        if (msg.valid === true) {
                            $("#user_telephone_modal").text(msg.user.name + ' ' + msg.user.family);
                            $("#user_telephone_modal").attr("href", "/admin/user/show/" + msg.user.id);
                            $("#user_telephone_modal_container").css("visibility", "visible");
                        } else {
                            $("#user_telephone_modal_container").css("visibility", "hidden");
                        }


                    });


            });

            document.getElementById("mobile").addEventListener("change", function (event) {

                $mobile = event.target.value;

                $.ajax({
                    method: "POST",
                    url: "/api/checkExistMobile",
                    data: {mobile: $mobile}
                })
                    .done(function (msg) {
                        //alert("Data : " + msg);
                        console.log(msg)

                        if (msg.valid === true) {
                            $("#user_mobile").text(msg.user.name + ' ' + msg.user.family);
                            $("#user_mobile").attr("href", "/admin/user/show/" + msg.user.id);
                            $("#user_mobile_container").css("visibility", "visible");
                        } else {
                            $("#user_mobile_container").css("visibility", "hidden");
                        }


                    });


            });

            document.getElementById("mobileInput").addEventListener("change", function (event) {

                $mobile = event.target.value;

                $.ajax({
                    method: "POST",
                    url: "/api/checkExistMobile",
                    data: {mobile: $mobile}
                })
                    .done(function (msg) {
                        //alert("Data : " + msg);
                        console.log(msg)

                        if (msg.valid === true) {
                            $("#user_mobile_modal").text(msg.user.name + ' ' + msg.user.family);
                            $("#user_mobile_modal").attr("href", "/admin/user/show/" + msg.user.id);
                            $("#user_mobile_modal_container").css("visibility", "visible");
                        } else {
                            $("#user_mobile_modal_container").css("visibility", "hidden");
                        }


                    });


            });

            /* add  dynamic mobile */
            let additionalMobilesContainer = document.getElementById("additionalMobilesContainer");
            let addMobileModal = document.getElementById("addMobileModal");
            let addMobileNumberButton = document.getElementById("addMobileNumberButton");
            let cancelModalButton = document.getElementById("cancelModalButton");
            let mobileInput = document.getElementById("mobileInput");
            let telephoneInput = document.getElementById("telephoneInput");
            let mobileOwnerInput = document.getElementById("mobileOwnerInput");

            addMobileNumberButton.addEventListener("click", function (event) {

                let mobileNumber = mobileInput.value;
                let phoneNumber = telephoneInput.value;
                let mobileOwner = mobileOwnerInput.value;
                let inputValue = mobileNumber + '@' + phoneNumber + '@' + mobileOwner;

                $('#addMobileModal').modal('hide');

                let inputContainer = document.createElement('div');
                inputContainer.classList.add("row");
                inputContainer.classList.add("mt-1");
                inputContainer.innerHTML = "<input type='hidden' value='" + inputValue + "' class='col-9 form-control ' name='mobiles[]' style='padding:5px;' readonly/>" + " " +
                    "<input type='text' value='" + mobileNumber + "' class='col-3 form-control m-1' style='padding:5px;' disabled/>" +
                    "<input type='text' value='" + phoneNumber + "' class='col-3 form-control m-1' style='padding:5px;' disabled/>" +
                    "<input type='text' value='" + mobileOwner + "' class='col-3 form-control m-1' style='padding:5px;' disabled/>" +
                    "<button id='del' class='btn btn-danger col-2 m-1' onclick='removeElement(this)'>حذف</>";
                additionalMobilesContainer.appendChild(inputContainer);

                mobileInput.value = "";
                telephoneInput.value = "";
                mobileOwnerInput.value = "";


            });

            function removeElement(element) {
                element.parentElement.remove();
            }

            //$('#city_id').select2().addAttribute('required');
        </script>
    @endpush
@endsection
