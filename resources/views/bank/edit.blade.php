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
            <form class="form" action="{{route('bank.update')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$single->id}}">

                    @php($title=__("bank.name"))
                    @php($caption='')
                    @php($value=$single->name)
                    <x-InputRow :title="$title" name="name" id="name" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-text"/>

                    @php($title=__("bank.account"))
                    @php($caption='')
                    @php($value=$single->account)
                    <x-InputRow :title="$title" name="account" id="account" :value="$value" :caption="$caption"
                                type="text" icon="bx bx-text"/>


                    @php($title=__("bank.cart_code"))
                    @php($caption='')
                    @php($value=$single->cart_code)
                    <x-InputRow :title="$title" name="cart_code" id="cart_code" :value="$value" :caption="$caption"
                                type="text" icon="bx bx-text"/>

                    @php($title=__("bank.sheba"))
                    @php($caption='')
                    @php($value=$single->sheba)
                    <x-InputRow :title="$title" name="sheba" id="sheba" :value="$value" :caption="$caption"
                                type="text" icon="bx bx-text"/>


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <script>


    </script>
@endsection
