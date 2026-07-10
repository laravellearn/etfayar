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
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{route('permission.store')}}" method="post">
                <div class="card-body">
                    @csrf

                    @php($title=__("user.code"))
                    @php($caption=__("user.code_automatic_generate"))
                    @php($value=$code)
                    <input type="hidden" name="code" id="code" value="{{$code}}">
                    <x-InputRow :title="$title" name="" id="" :value="$value" type="number" :caption="$caption" disabled="disabled" icon="bx bx-text"/>

                    @php($title=__("user.title"))
                    @php($caption=__("user.input_english_title"))
                    @php($value='')
                    <x-InputRow :title="$title" name="title" id="title" :value="$value" :caption="$caption" type="text" icon="bx bx-text"/>

                    @php($title=__("user.persian_title"))
                    @php($caption=__("user.input_persian_title"))
                    @php($value='')
                    <x-InputRow :title="$title" name="persian_title" id="persian_title" :caption="$caption" :value="$value" type="text" icon="bx bx-text"/>

                    @php($status=1)
                    @include('partials.status_input')

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
