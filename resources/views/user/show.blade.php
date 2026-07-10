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

                        <x-Button class="mr-3" permission="Add Request" :title="__('request.add')"
                                  {{--:icon="__('icon.user_icon')"--}}
                                  url="{{route('request.add',$user)}}">

                        </x-Button>

                        <x-Button btnClass="btn-outline-primary" permission="Access Users"
                                  :title="__('user.back_to_user_list')"
                                  {{--:icon="__('icon.user_icon')"--}}
                                  url="{{route('users')}}">

                        </x-Button>


                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="" method="post" id="kt_form">
                @csrf

                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">اطلاعات مشتری:</h3>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.customer_code")</label>
                                <div class="col-9">
                                    <div class="input-group">
                                        <input class="form-control form-control" type="text" name="customer_code"
                                               id="customer_code" value="{{$user->customer_code}}"
                                               placeholder="@lang("user.customer_code")" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.identity_type")</label>
                                <div class="col-9">
                                    @php($items=[['title'=>'حقیقی','value'=>'natural'],['title'=>'حقوقی','value'=>'legal']])
                                    <select class="form-control form-control" name="identity_type" id="identity_type"
                                            disabled>
                                        <option value="" disabled selected hidden>انتخاب نوع هویت...</option>
                                        @foreach($items as $item)
                                            <option
                                                {{$user->identity_type==$item['value']?'selected':''}}  value="{{$item['value']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div id="name_block" class="form-group row">
                                <label class="col-3">@lang('user.name')</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="name"
                                           value="{{$user->name}}" placeholder="@lang('user.name')" disabled>
                                </div>
                            </div>

                            <div id="family_block" class="form-group row">
                                <label class="col-3">@lang("user.family")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="family"
                                           value="{{$user->family}}" placeholder="@lang("user.family")" disabled>
                                </div>
                            </div>

                            <div id="national_code_block" class="form-group row">
                                <label class="col-3">@lang("user.national_code")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="national_code"
                                           value="{{$user->national_code}}" placeholder="@lang("user.national_code")"
                                           disabled>
                                </div>
                            </div>

                            <div id="company_block" class="form-group row">
                                <label class="col-3">@lang("user.company")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="company"
                                           value="{{$user->company}}" placeholder="@lang("user.company")" disabled>
                                </div>
                            </div>

                            <div id="connector_name_block" class="form-group row">
                                <label class="col-3">@lang("user.connector_name")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="connector_name"
                                           value="{{$user->connector_name}}" placeholder="@lang("user.connector_name")"
                                           disabled>
                                </div>
                            </div>

                            <div id="connector_position_block" class="form-group row">
                                <label class="col-3">@lang("user.connector_position")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="connector_position"
                                           value="{{$user->connector_position}}"
                                           placeholder="@lang("user.connector_position")" disabled>
                                </div>
                            </div>


                            <div id="economic_code_block" class="form-group row">
                                <label class="col-3">@lang("user.economic_code")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="economic_code"
                                           value="{{$user->economic_code}}"
                                           placeholder="@lang("user.economic_code")" disabled>
                                </div>
                            </div>


                            <div id="registration_number_block" class="form-group row">
                                <label class="col-3">@lang("user.registration_number")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="registration_number"
                                           value="{{$user->registration_number}}"
                                           placeholder="@lang("user.registration_number")" disabled>
                                </div>
                            </div>


                            <div id="gender_block" class="form-group row">
                                <label class="col-3">@lang("user.gender")</label>
                                <div class="col-9">
                                    @php($items=[['title'=>'مذکر','value'=>'male'],['title'=>'مونث','value'=>'female']])
                                    <select class="form-control form-control" name="gender" disabled>
                                        <option value="" disabled selected hidden>انتخاب جنسیت...</option>
                                        @foreach($items as $item)
                                            <option
                                                {{$user->gender==$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>

                            <h3 class=" text-dark font-weight-bold mb-10">اطلاعات تماس:</h3>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.telephone')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" class="form-control form-control" name="telephone"
                                               value="{{$user->telephone}}" placeholder="@lang("user.telephone")"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.primary_mobile') <strong>*</strong></label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                        <input type="text" class="form-control form-control" name="mobile"
                                               value="{{$user->mobile}}" placeholder="@lang('user.primary_mobile')"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.mobile_owner')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-user"></i></span></div>
                                        <input type="text" class="form-control form-control" name="mobile_owner"
                                               value="{{$user->mobile_owner}}" placeholder="@lang('user.mobile_owner')"
                                               disabled>
                                    </div>
                                </div>
                            </div>


                            <div id="kt_repeater_3">
                                <div class="form-group row">

                                    @if(!empty($user->mobiles->toArray()))
                                        <div class="col-md-3">
                                            <label>@lang('user.additinal_mobile_phone')</label>
                                        </div>
                                    @endif
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
                                                                   placeholder="@lang('user.mobile')" disabled>
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
                                                                   placeholder="@lang('user.telephone')" disabled>
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
                                                                   value="{{$mobile->mobile_owner}}"
                                                                   class="form-control"
                                                                   placeholder="@lang('user.mobile_owner')" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9">


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
                                               value="{{$user->email}}" placeholder="@lang("user.email")" disabled>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.website')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <input type="text" class="form-control form-control" name="website"
                                               value="{{$user->website}}" placeholder="@lang("user.website")" disabled>
                                        <div class="input-group-append"><span class="input-group-text">.com</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-10"></div>
                        <div class="my-5">
                            <h3 class=" text-dark font-weight-bold mb-10">اطلاعات آدرس:</h3>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.city")</label>
                                <div class="col-9">
                                    <select class="form-control selectpicker" name="city_id" data-size="5"
                                            data-live-search="true" disabled>
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
                                           placeholder="@lang("user.area")" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">@lang("user.postal_code")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="postal_code"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->postal_code}}"
                                           @endif
                                           placeholder="@lang("user.postal_code")" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.address")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="address"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->address}}"
                                           @endif
                                           placeholder="@lang("user.address")" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.location")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="location"
                                           @if(!is_null($user->address))
                                               value="{{$user->address->location}}"
                                           @endif
                                           placeholder="@lang("user.location")" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="separator separator-dashed my-10"></div>
                        <div class="form-group row">
                            <label class="col-3">@lang("acquaintance.title2")</label>
                            <div class="col-9">
                                <select class="form-control" name="acquaintance_id" id="acquaintance_id" disabled>
                                    <option value="null" disabled selected hidden>انتخاب نشده است</option>
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
                                                                            value="{{$item->id}}" disabled>
                                                <span></span> {{$item->title}}
                                            </label>
                                        @else
                                            <label class="checkbox"> <input type="checkbox" name="services[]"
                                                                            value="{{$item->id}}" disabled>
                                                <span></span> {{$item->title}}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <br><br>
                            <div>

                            </div>
                            <br><br>
                        </div>
                    </div>
                    <div class="col-xl-2">


                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

    <script>

        /*document.getElementById("btn_code_generate").addEventListener("click", function () {
            document.getElementById("customer_code").value = makeid(5);
        });
*/
        function makeid(length) {
            var result = '';
            //var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            //var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }

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
