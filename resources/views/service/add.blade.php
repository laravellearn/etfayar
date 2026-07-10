@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    @lang('service.add_service') </h3>
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
            <form class="form" action="{{route('service.store')}}" method="post">
                <div class="card-body">

                    @csrf

                    @php($title=__("user.title"))
                    @php($caption=__("service.input_title"))
                    @php($value=(old('title')))
                    <x-InputRow :title="$title" name="title" id="title" :value="$value" :caption="$caption" type="text" icon="bx bx-text"/>

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
