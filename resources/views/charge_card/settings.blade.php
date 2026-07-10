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
            <form class="form" action="{{route('charge_card.store_settings')}}" method="post">
                <div class="card-body">

                    @csrf
                    @foreach($list as $item)
                        <x-InputRow :title="$item->title" name="settings[{{$item->key}}]" :id="$item->key"
                                    :value="$item->value"
                                    caption="" type="text"
                                    icon="bx bx-calculator">
                        </x-InputRow>
                    @endforeach


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
