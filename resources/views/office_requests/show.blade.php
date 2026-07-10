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
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{route('office_request.update')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$single->id}}">

                    @foreach($data as $item)
                        <div class="d-flex align-items-center mb-4">
                            <!--begin::سیمبل-->
                            <div class="symbol symbol-40 symbol-light-success mr-5">
                                <span class="symbol-info"></span>
                            </div>
                            <!--end::سیمبل-->

                            <!--begin::متن-->
                            <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                <div
                                    class="text-dark text-hover-primary mb-1 font-size-lg font-weight-bold">{{$item->label}}
                                    :
                                </div>
                                <span class="text-muted">@php
                                        echo $item->value;
                                    @endphp</span>
                            </div>
                            <!--end::متن-->
                        </div>
                    @endforeach
                    <hr>
                    <div class="form-group row">
                        <label class="col-4 ml-8">@lang("office_request.choose_status")</label>
                        <div class="col-6">
                            @php($items=[
['title'=>'مشاهده نشده','value'=>'not_seen'],
['title'=>'در حال بررسی','value'=>'pending'],
['title'=>'موافقت با درخواست','value'=>'agree'],
['title'=>'رد درخواست','value'=>'deny']])

                            <select class="form-control" name="status" disabled>
                                <option value="" disabled selected hidden>@lang('office_request.choose_status')...
                                </option>
                                @foreach($items as $item)
                                    <option
                                        {{ $single->status==$item['value'] ? 'selected':''}}  value="{{$item['value']}}">{{$item['title']}}</option>
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
    <script>


    </script>
@endsection
