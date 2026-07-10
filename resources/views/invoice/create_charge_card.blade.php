@extends('layout.main')@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{route('invoice.download_charge_card')}}" method="post">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$id}}">


                    <x-InputRow title="تاریخ شارژ" name="date" id="date" value=""
                                caption="" type="text"
                                icon="bx bx-calendar"></x-InputRow>


                    <x-InputRow title="وزن خاموش کننده" name="weight" id="weight" value=""
                                caption="" type="text"
                                icon="bx bx-weight">
                    </x-InputRow>

                    <hr>

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
