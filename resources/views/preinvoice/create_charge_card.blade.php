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
            <form class="form" action="{{route('preinvoice.download_charge_card')}}" method="post">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$id}}">

                    @php($title='تاریخ شارژ')
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="date" id="date" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-calendar">
                    </x-InputRow>

                    @php($title='وزن خاموش کننده')
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="weight" id="weight" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-weight">
                    </x-InputRow>
{{--
                    <div class="form-group row">
                        <label class="col-3">نوع خاموش کننده</label>
                        <div class="col-9">
                            @php($items=[
    ['title'=>'پودر و گاز','value'=>0],
    ['title'=>'آب و گاز','value'=>1],
    ['title'=>'co2','value'=>2],
    ])
                            <select class="form-control" name="type">
                                <option value="" disabled selected hidden>انتخاب نوع خاموش کننده</option>
                                @foreach($items as $item)
                                    <option
                                        value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>--}}

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
