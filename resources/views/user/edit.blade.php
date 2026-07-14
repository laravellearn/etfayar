@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    {{$title}} </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        {{--   <span class="example-toggle" data-toggle="tooltip" title="" data-original-title="مشاهد کد"></span>
                           <span class="example-copy" data-toggle="tooltip" title="" data-original-title="کپی کد"></span>--}}

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('partials.form_error')


                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{route('user.update')}}" method="post" id="kt_form">
                @csrf

                <input type="hidden" name="id" value="{{$user->id}}">


                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">اطلاعات مشتری:</h3>
                            <div class="form-group row">
                                <label class="col-3">@lang("user.customer_code") <strong>*</strong></label>
                                <div class="col-9">
                                    <div class="input-group">
                                        {{--<div class="input-group-prepend">
                                            <button id="btn_code_generate" class="btn btn-secondary" type="button">
                                                <i class="la la-dice"></i> ایجاد شماره تصادفی برای مشتری
                                            </button>
                                        </div>--}}
                                        <input class="form-control form-control" type="text" name="customer_code"
                                               id="customer_code" value="{{$user->customer_code}}"
                                               placeholder="@lang("user.customer_code")" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">@lang("user.created_at")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="created_at_display"
                                           id="created_at_display" value="{{$user->persian_date}}"
                                           placeholder="@lang("user.created_at")" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">@lang("user.identity_type") <strong>*</strong></label>
                                <div class="col-9">
                                    @php($items=[['title'=>'حقیقی','value'=>'natural'],['title'=>'حقوقی','value'=>'legal']])
                                    <select class="form-control form-control" name="identity_type" id="identity_type">
                                        <option value="" disabled selected hidden>انتخاب نوع هویت...</option>
                                        @foreach($items as $item)
                                            <option
                                                {{$user->identity_type==$item['value']?'selected':''}}  value="{{$item['value']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div id="name_block" class="form-group row">
                                <label class="col-3">@lang('user.name') <strong>*</strong></label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="name"
                                           value="{{$user->name}}" placeholder="@lang('user.name')">
                                </div>
                            </div>

                            <div id="family_block" class="form-group row">
                                <label class="col-3">@lang("user.family") <strong>*</strong></label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="family"
                                           value="{{$user->family}}" placeholder="@lang("user.family")">
                                </div>
                            </div>

                            <div id="national_code_block" class="form-group row">
                                <label class="col-3">@lang("user.national_code") <strong>*</strong></label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="national_code"
                                           value="{{$user->national_code}}" placeholder="@lang("user.national_code")">
                                </div>
                            </div>

                            <div id="company_block" class="form-group row">
                                <label class="col-3">@lang("user.company")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="company"
                                           value="{{$user->company}}" placeholder="@lang("user.company")">
                                </div>
                            </div>

                            <div id="connector_name_block" class="form-group row">
                                <label class="col-3">@lang("user.connector_name")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="connector_name"
                                           value="{{$user->connector_name}}" placeholder="@lang("user.connector_name")">
                                </div>
                            </div>

                            <div id="connector_position_block" class="form-group row">
                                <label class="col-3">@lang("user.connector_position")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="connector_position"
                                           value="{{$user->connector_position}}"
                                           placeholder="@lang("user.connector_position")">
                                </div>
                            </div>


                            <div id="economic_code_block" class="form-group row">
                                <label class="col-3">@lang("user.economic_code")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="economic_code"
                                           value="{{$user->economic_code}}"
                                           placeholder="@lang("user.economic_code")">
                                </div>
                            </div>


                            <div id="registration_number_block" class="form-group row">
                                <label class="col-3">@lang("user.registration_number")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="registration_number"
                                           value="{{$user->registration_number}}"
                                           placeholder="@lang("user.registration_number")">
                                </div>
                            </div>


                            <div id="gender_block" class="form-group row">
                                <label class="col-3">@lang("user.gender")</label>
                                <div class="col-9">
                                    @php($items=[['title'=>'مذکر','value'=>'male'],['title'=>'مونث','value'=>'female']])
                                    <select class="form-control form-control" name="gender">
                                        <option value="" disabled selected hidden>انتخاب جنسیت...</option>
                                        @foreach($items as $item)
                                            <option
                                                {{$user->gender==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-3">@lang("user.expert") <strong>*</strong></label>
                                <div class="col-9">
                                    <select class="form-control form-control" name="expert_id">
                                        <option value="" disabled selected hidden>انتخاب کارشناس ...</option>
                                        @foreach($experts as $item)
                                            <option
                                                {{ $item->id==$user->expert_id?'selected':'' }} value="{{ $item->id }}">{{ $item->fullName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>

                            <h3 class=" text-dark font-weight-bold mb-10">اطلاعات تماس:</h3>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.telephone') <strong>*</strong></label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" class="form-control form-control" name="telephone"
                                               value="{{$user->telephone}}" placeholder="@lang("user.telephone")">
                                    </div>
                                    <span class="form-text text-muted">تلفن ثابت در این قسمت وارد می شود.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.primary_mobile') <strong>*</strong></label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                        <input type="text" class="form-control form-control" name="mobile"
                                               value="{{$user->mobile}}" placeholder="@lang('user.primary_mobile')">
                                    </div>
                                    <span class="form-text text-muted">تلفن همراه اصلی ضروری می باشد.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3"></label>
                                <div class="col-9">
                                <span id="user_link_container" style="visibility: hidden" class="form-text text-muted">
                                مشتری صاحب تلفن همراه
                            <a style="display: inline;" href="" id="user_link" target="_blank"
                               class="form-text text-primary"></a>
                                می باشد
                            </span>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-3">@lang('user.mobile_owner')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-user"></i></span></div>
                                        <input type="text" class="form-control form-control" name="mobile_owner"
                                               value="{{$user->mobile_owner}}" placeholder="@lang('user.mobile_owner')">
                                    </div>
                                </div>
                            </div>


                            <div id="kt_repeater_3">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>@lang('user.additinal_mobile_phone')</label>
                                    </div>
                                    <div data-repeater-list="group_mobile" class="col-md-9">
                                        @if(!empty($user->mobiles->toArray()))
                                            @foreach($user->mobiles as $mobile)
                                                <div data-repeater-item="" class="form-group row">
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-mobile-phone"></i>
                                                </span>
                                                            </div>
                                                            <input type="text" name="mobile" id="mobile"
                                                                   value="{{$mobile->mobile}}" class="form-control"
                                                                   placeholder="@lang('user.mobile')">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-phone"></i>
                                                </span>
                                                            </div>
                                                            <input type="text" name="telephone" id="telephone"
                                                                   value="{{$mobile->telephone}}" class="form-control"
                                                                   placeholder="@lang('user.mobile')">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-user"></i>
                                                </span>
                                                            </div>
                                                            <input type="text" name="mobile_owner" id="mobile_owner"
                                                                   value="{{$mobile->mobile_owner}}"
                                                                   class="form-control"
                                                                   placeholder="@lang('user.mobile_owner')">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a href="javascript:;" data-repeater-delete=""
                                                           class="btn font-weight-bold btn-danger btn-icon">
                                                            <i class="la la-remove"></i> </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div data-repeater-item="" class="form-group row">
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-mobile-phone"></i>
                                                </span>
                                                        </div>
                                                        <input type="text" name="mobile" id="mobile"
                                                               class="form-control" placeholder="@lang('user.mobile')">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-phone"></i>
                                                </span>
                                                        </div>
                                                        <input type="text" name="telephone" id="telephone"
                                                               class="form-control"
                                                               placeholder="@lang('user.telephone')">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-user"></i>
                                                </span>
                                                        </div>
                                                        <input type="text" name="mobile_owner" id="mobile_owner"

                                                               class="form-control"
                                                               placeholder="@lang('user.mobile_owner')">
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
                                    <div class="col-lg-9">


                                    </div>
                                    <div class="col">
                                        <div data-repeater-create="" class="btn font-weight-bold btn-primary btn-block">
                                            <i class="la la-mobile-alt"></i> @lang('user.add_new_mobile_number')
                                        </div>
                                        <span class="form-text text-muted">در صورت عدم نیاز می توانید با کلیک بر روی دکمه ضربدر قرمز رنگ شماره همراه را پاک نمایید.</span>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.email')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <input type="text" class="form-control form-control" name="email"
                                               value="{{$user->email}}" placeholder="@lang("user.email")">
                                    </div>
                                    <span class="form-text text-muted">مثال :sample@gmail.com</span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.website')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <input type="text" class="form-control form-control" name="website"
                                               value="{{$user->website}}" placeholder="@lang("user.website")">
                                        <div class="input-group-append"><span class="input-group-text">.com</span></div>
                                    </div>
                                    <span
                                        class="form-text text-muted"> مثال: www.sample.com , https://sample.com </span>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-10"></div>
                        <div class="my-5">
                            <h3 class=" text-dark font-weight-bold mb-10">اطلاعات آدرس:</h3>

                            {{-- <div class="form-group row">
                                 <label class="col-3">@lang("user.province") <strong>*</strong></label>
                                 <div class="col-9">
                                     <select class="form-control form-control" name="province_id">
                                         <option value="null" disabled selected hidden>انتخاب استان...</option>
                                         @foreach($provinces as $item)
                                             @if(!is_null($user->address))
                                             <option {{$user->address->city->province->id==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                             @else
                                                 <option value="{{$item->id}}">{{$item->name}}</option>
                                             @endif
                                         @endforeach
                                     </select>
                                 </div>
                             </div>--}}

                            <div class="form-group row">
                                <label class="col-3">@lang("user.city") <strong>*</strong></label>
                                <div class="col-9">
                                    <select class="form-control selectpicker" name="city_id" data-size="5"
                                            data-live-search="true">
                                        <option value="null" disabled selected hidden>انتخاب شهر...</option>
                                        @foreach($cities as $item)
                                            @if(!is_null($user->address))
                                                <option
                                                    {{$user->address->city->id==$item->id?'selected':''}}  value="{{$item->id}}">{{$item->name}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-3">@lang("user.area")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="area"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->area}}"
                                           @endif
                                           placeholder="@lang("user.area")">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">@lang("user.postal_code")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="postal_code"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->postal_code}}"
                                           @endif
                                           placeholder="@lang("user.postal_code")">
                                </div>
                            </div>
                            {{--        <div class="form-group row">
                                        <label class="col-3">@lang("user.postal_box")</label>
                                        <div class="col-9">
                                            <input class="form-control form-control" type="text" name="postal_box"
                                                   @if(!is_null($user->address))
                                                   value="{{$user->address->postal_box}}"
                                                   @endif
                                                   placeholder="@lang("user.postal_box")">
                                        </div>
                                    </div>--}}
                            <div class="form-group row">
                                <label class="col-3">@lang("user.address") <strong>*</strong></label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="address"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->address}}"
                                           @endif
                                           placeholder="@lang("user.address")">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.location") <strong>*</strong></label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="location"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->location}}"
                                           @endif
                                           placeholder="@lang("user.location")">
                                </div>
                            </div>


                            {{--  <div class="form-group row">
                                  <label class="col-3">@lang("user.longitude")</label>
                                  <div class="col-9">
                                      <input class="form-control form-control" type="text" name="longitude" value="{{$user->address->longitude}}" placeholder="@lang("user.longitude")">
                                      <span class="form-text text-muted">مثال : 51.14630122</span>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-3">@lang("user.latitude")</label>
                                  <div class="col-9">
                                      <input class="form-control form-control" type="text" name="latitude" value="{{$user->address->latitude}}" placeholder="@lang("user.latitude")">
                                      <span class="form-text text-muted">مثال : 28.71082391</span>
                                  </div>
                              </div>--}}

                        </div>
                        <div class="separator separator-dashed my-10"></div>

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
                                            {{$user->acquaintance_id==$item->id?'selected':''}} value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="my-52">
                            <h3 class=" text-dark font-weight-bold mb-10">سرویس ها:</h3>
                            <div class="form-group row">
                                <label class="col-3">@lang('service.services')</label>
                                <div class="checkbox-list col-9">
                                    @foreach($services as $item)
                                        @if(!is_null($user->services))
                                            <label class="checkbox"> <input type="checkbox"
                                                                            {{$user->services->contains($item)?'checked':''}} name="services[]"
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

                            @php($status=$user->status)
                            @include('partials.status_input')
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

    <script>

        document.getElementById("mobile").addEventListener("change", function (event) {
            document.cookie = "mobile=" + event.target.value;

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
                        $("#user_link").text(msg.user.name + ' ' + msg.user.family);
                        $("#user_link").attr("href", "/admin/user/show/" + msg.user.id);
                        $("#user_link_container").css("visibility", "visible");
                    } else {
                        $("#user_link_container").css("visibility", "hidden");
                    }


                });


        });


        document.getElementById("identity_type").addEventListener("change", function (event) {
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

    </script>
@endsection
