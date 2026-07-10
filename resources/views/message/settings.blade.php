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
            <form class="form" action="{{route('message.store_settings')}}" method="post">
                <div class="card-body">

                    @csrf

                    {{--      @php($title=__("insurance.number"))
                          @php($caption='')
                          @php($value='')
                          <x-InputRow :title="$title" name="number" id="number" :value="$value" :caption="$caption"
                                      type="number" :min="0" icon="bx bx-calculator"/>
      --}}
                    @foreach($list as $item)

                        @if($item->element=='Row')

                            @php($title=$item->title)
                            @php($caption=$item->caption)
                            @php($value=$item->value)
                            <x-InputRow :title="$title" name=" setting[{{$item->key}}]" id="{{$item->key}}" :value="$value" :caption="$caption"
                                        type="text" icon="bx bx-text"/>
                        @endif


                        @if($item->element=='Text')

                            @php($title=$item->title)
                            @php($caption=$item->caption)
                            @php($value=$item->value)
                            <x-InputText :title="$title" name="setting[{{$item->key}}]" id="{{$item->key}}"
                                         :value="$value"
                                         :caption="$caption"
                                         type="text" icon="bx bx-text">
                            </x-InputText>

                        @endif

                    @endforeach


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
