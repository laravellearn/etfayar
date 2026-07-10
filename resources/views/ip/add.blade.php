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
            <form class="form" action="{{route('ip.store')}}" method="post">
                <div class="card-body">

                    @csrf

                    @php($title=__("ip.address"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="address" id="address" :value="$value" :caption="$caption"
                                type="text"
                                icon="bx bx-text">
                    </x-InputRow>


                    @php($title=__("ip.description"))
                    @php($caption=__(""))
                    @php($value='')
                    <x-InputText :title="$title" name="description" id="description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>


                    <div class="form-group row">
                        <label class="col-3">@lang("user.status") <strong>*</strong></label>
                        <div class="col-9">
                            <select class="form-control form-control" name="status">
                                <option value="valid">@lang("common.active")</option>
                                <option value="invalid">@lang("common.inactive")</option>
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


    </script>
@endsection
