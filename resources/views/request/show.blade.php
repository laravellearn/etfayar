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
            <form class="form" action="" method="post">
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-3">@lang("request.choose_service")</label>
                        <div class="col-9">
                            <select class="form-control" name="service_id" disabled>
                                <option value="" disabled selected hidden>@lang('request.choose_service')...</option>
                                @foreach($services as $item)
                                    <option value="{{$item->id}}" {{$request->service_id == $item->id ? 'selected' : '' }} >{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("request.choose_user") </label>
                        <div class="col-9">
                            <select class="form-control" name="user_id" disabled>
                                <option value="" disabled selected hidden>@lang('request.choose_user')...</option>
                                @foreach($users as $item)
                                    <option value="{{$item->id}}" {{$request->user_id == $item->id ? 'selected' : '' }} >{{$item->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("request.description"))
                    @php($caption=__(""))
                    @php($value=$request->description)
                    <x-InputText :title="$title" name="description" id="description" :value="$value" :caption="$caption" type="text" disabled="disabled" icon="bx bx-text"/>


                    <div class="form-group row">
                        <label class="col-3">@lang("request.request_code")</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input class="form-control" type="text" name="code" id="code" value="{{$request->code}}" placeholder="@lang("request.code")" disabled>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3">@lang("common.status") </label>
                        <div class="col-9">
                            @php($items=[['title'=>'ثبت پیش فاکتور','value'=>1],['title'=>'معلق بودن سفارش','value'=>0]])
                            <select class="form-control" name="status" disabled>
                                <option value="" disabled selected hidden>@lang('common.choose_status')...</option>
                                @foreach($items as $item)
                                    <option {{$request->status ===$item['value'] ? 'selected' : '' }} value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

@endsection
