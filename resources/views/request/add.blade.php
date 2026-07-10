@extends('layout.main')@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
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
            <form class="form" action="{{route('request.store')}}" method="post">
                <div class="card-body">
                    @csrf

                    <div class="form-group row">
                        <label class="col-3">@lang("request.choose_service") <strong>*</strong></label>
                        <div class="col-9">
                            <select class="form-control form-control" name="service_id">
                                <option value="" disabled selected hidden>@lang('request.choose_service')...</option>
                                @foreach($services as $item)
                                    <option {{old('service_id')==$item->id?'selected':''}}  value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("request.choose_user") <strong>*</strong></label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="user_id"  data-size="5"
                                    data-live-search="true"
                                    data-fv-not-empty="true"
                                    data-fv-not-empty___message="@lang('request.choose_user')..."
                                    required>
                                <option value="" disabled selected hidden>@lang('request.choose_user')...</option>
                                @foreach($users as $item)
                                    <option {{ old('user_id')==$item->id?'selected':'' }} {{ $user->id==$item->id?'selected':'' }}  value="{{ $item->id }}">#{{ $item->customer_code }}     {{ $item->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("request.description"))
                    @php($caption=__(""))
                    @php($value=(old('description')))
                    <x-InputText :title="$title" name="description" id="description" :value="$value" :caption="$caption" type="text" icon="bx bx-text"/>

{{--

                    <div class="form-group row">
                        <label class="col-3">@lang("request.request_code") <strong>*</strong></label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button id="btn_code_generate" class="btn btn-secondary" type="button">
                                        <i class="la la-dice"></i>@lang('request.request_code_button_title')
                                    </button>
                                </div>
                                <input class="form-control" type="text" name="code" id="code" value="{{old('code')}}" placeholder="@lang("request.code")">
                            </div>
                        </div>
                    </div>

--}}

                    <div class="form-group row">
                        <label class="col-3">@lang("common.status") <strong>*</strong></label>
                        <div class="col-9">
                            @php($items=[['title'=>'ثبت پیش فاکتور','value'=>1],['title'=>'معلق بودن سفارش','value'=>0]])
                            <select class="form-control" name="status">
                                <option value="" disabled selected hidden>@lang('common.choose_status')...</option>
                                @foreach($items as $item)
                                    <option {{old('status')===$item['value']?'selected':''}} value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

    <script>

        document.getElementById("btn_code_generate").addEventListener("click", function () {
            document.getElementById("code").value = makeid(5);
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
