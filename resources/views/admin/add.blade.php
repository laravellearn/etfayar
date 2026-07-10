@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    @lang('admin.add_admin') </h3>
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
            <form class="form" action="{{route('admin.store')}}" method="post" id="kt_form">
                @csrf
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">اطلاعات مشتری:</h3>
                            <div class="form-group row">
                                <label class="col-3">@lang('user.name')</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="name" value="{{old('name')}}" placeholder="@lang('user.name')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.family")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="family" value="{{old('family')}}" placeholder="@lang("user.family")">
                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>

                            <h3 class=" text-dark font-weight-bold mb-10">اطلاعات تماس:</h3>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.primary_mobile')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                        <input type="text" class="form-control form-control" name="mobile" value="{{old('mobile')}}" placeholder="@lang('user.primary_mobile')">
                                    </div>
                                    <span class="form-text text-muted">تلفن همراه اصلی ضروری می باشد.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang('user.email')</label>
                                <div class="col-9">
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <input type="text" class="form-control form-control" name="email" value="{{old('email')}}" placeholder="@lang("user.email")">
                                    </div>
                                    <span class="form-text text-muted">مثال :sample@gmail.com</span>

                                </div>
                            </div>

                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-52">
                            <h3 class=" text-dark font-weight-bold mb-10">امنیت:</h3>
                            <div class="form-group row">
                                <label class="col-3">@lang("user.username")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="text" name="username" value="{{old('username')}}" placeholder="@lang("user.username")">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">@lang("user.password")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="password" name="password" value="{{old('password')}}" placeholder="@lang("user.password")">
                                    <span class="form-text text-muted">در تعیین رمز عبور برای ادمین دقت نمایید امکان تغییر آن بعدا وجود ندارد.</span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-3">@lang("user.password_confirm")</label>
                                <div class="col-9">
                                    <input class="form-control form-control" type="password" name="password_confirmation" value="{{old('password_confirm')}}" placeholder="@lang("user.password_confirm")">
                                    <span class="form-text text-muted">جهت تایید رمز عبور وارد شده را دوباره وارد نمایید.</span>
                                </div>
                            </div>

                            @php($status=1)
                            @include('partials.status_input')

                            <div class="form-group row">
                                <label class="col-3">@lang("user.roles")</label>
                                <div class="col-9">
                                    <div class="checkbox-list">
                                        @if(!empty(old('roles')))
                                            @foreach($roles as $role)
                                                <label class="checkbox">
                                                    <input type="checkbox" {{in_array($role->title,old('roles'))?'checked':''}}  name="roles[]" value="{{$role->title}}">
                                                    <span></span> {{$role->persian_title}}
                                                </label>
                                            @endforeach
                                        @else
                                            @foreach($roles as $role)
                                                <label class="checkbox">
                                                    <input type="checkbox" name="roles[]" value="{{$role->title}}">
                                                    <span></span> {{$role->persian_title}}
                                                </label>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

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

        document.getElementById("btn_code_generate").addEventListener("click", function () {
            document.getElementById("customer_code").value = makeid(5);
        });

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

        document.getElementById("customer_code").value = makeid(5);


    </script>
@endsection
