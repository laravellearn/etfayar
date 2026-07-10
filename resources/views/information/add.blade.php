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
            <form class="form" action="{{route('information.store')}}" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    @csrf



                    @php($title=__("information.name"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="name" id="name" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    {{--      @php($title=__("information.logo"))
                          @php($caption='')
                          @php($value='')
                          <x-InputRow :title="$title" name="logo" id="logo" :value="$value" :caption="$caption" type="file"
                                      icon="bx bx-tax">
                          </x-InputRow>
      --}}
                    @php($title=__("information.sign"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="sign" id="sign" :value="$value" :caption="$caption" type="file"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.header"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="header" id="header" :value="$value" :caption="$caption"
                                type="file"
                                icon="bx bx-tax">
                    </x-InputRow>

                    {{--  @php($title=__("information.footer"))
                      @php($caption='')
                      @php($value='')
                      <x-InputRow :title="$title" name="footer" id="footer" :value="$value" :caption="$caption"
                                  type="file"
                                  icon="bx bx-tax">
                      </x-InputRow>

  --}}
                    @php($title=__("information.economic_code"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="economic_code" id="economic_code" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.national_code"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="national_code" id="national_code" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.postal_code"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="postal_code" id="postal_code" :value="$value" :caption="$caption"
                                type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.registration_number"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="registration_number" id="registration_number" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    <div class="form-group row">
                        <label class="col-3">@lang("user.city")</label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="city_id" data-size="5"
                                    data-live-search="true">
                                <option value="null" disabled selected hidden>انتخاب شهر...</option>
                                @foreach($cities as $item)
                                    <option
                                        {{old('city_id')==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("information.area"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="area" id="area" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.postal_box"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="postal_box" id="postal_box" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.address"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="address" id="address" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.location"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="location" id="location" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.telephone"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="telephone" id="telephone" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    <div class="form-group row">
                        <label class="col-3">@lang("information.choose_banks")</label>
                        <div class="col-9">
                            <select id="preinvoice_status" class="form-control form-control" name="bank_id">
                                <option value="null" selected>انتخاب حساب بانکی...</option>
                                @foreach($banks as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3">@lang("common.type")</label>
                        <div class="col-9">
                            <select class="form-control form-control" name="type">
                                <option value="0">@lang("common.preinvoice")</option>
                                <option value="1">@lang("common.invoice")</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("information.header_type")</label>
                        <div class="col-9">
                            <select class="form-control form-control" name="header_type">
                                <option value="0">@lang("information.unofficial")</option>
                                <option value="1">@lang("information.official")</option>
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
