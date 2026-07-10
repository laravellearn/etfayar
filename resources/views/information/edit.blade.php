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
            <form class="form" action="{{route('information.update')}}" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" value="{{$single->id}}">

                    @php($title=__("information.name"))
                    @php($caption='')
                    @php($value=$single->name)
                    <x-InputRow :title="$title" name="name" id="name" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    {{--

                                        <div class="row">
                                            <div class="col-3"></div>
                                            <div class="col-9"><img class="rounded-circle mr-1 mt-2"
                                                                    src=" {{asset('/storage/'.$single->logo)}}" alt="avatar" height="60"
                                                                    width="60"></div>

                                        </div>


                                        @php($title=__("information.logo"))
                                        @php($caption='')
                                        @php($value=$single->logo)

                                        <x-InputRow :title="$title" name="logo" id="logo" :value="$value" :caption="$caption" type="file"
                                                    icon="bx bx-tax">
                                        </x-InputRow>
                    --}}

                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9"><img class="mr-1 mt-2"
                                                src=" {{asset('/storage/'.$single->header)}}" alt="avatar" height="60"
                                                width="60"></div>

                    </div>

                    @php($title=__("information.header"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="header" id="header" :value="$value" :caption="$caption"
                                type="file"
                                icon="bx bx-tax">
                    </x-InputRow>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">حذف فایل سربرگ</label>
                        <div class="col-3">
                               <span class="switch">
                                   <label>
                                       <input type="checkbox" name="is_delete_header">
                                       <span></span>
                                   </label>
                               </span>
                        </div>

                    </div>

                    {{----}}
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9"><img class="mr-1 mt-2"
                                                src=" {{asset('/storage/'.$single->sign)}}" alt="avatar" height="60"
                                                width="60"></div>

                    </div>

                    @php($title=__("information.sign"))
                    @php($caption='')
                    @php($value=$single->sign)

                    <x-InputRow :title="$title" name="sign" id="sign" :value="$value" :caption="$caption" type="file"
                                icon="bx bx-tax">
                    </x-InputRow>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">حذف فایل امضاء</label>
                        <div class="col-3">
                               <span class="switch">
                                   <label>
                                       <input type="checkbox" name="is_delete_sign">
                                       <span></span>
                                   </label>
                               </span>
                        </div>

                    </div>


                    {{-- @php($title=__("information.footer"))
                     @php($caption='')
                     @php($value='')
                     <x-InputRow :title="$title" name="footer" id="footer" :value="$value" :caption="$caption"
                                 type="file"
                                 icon="bx bx-tax">
                     </x-InputRow>

 --}}


                    @php($title=__("information.economic_code"))
                    @php($caption='')
                    @php($value=$single->economic_code)
                    <x-InputRow :title="$title" name="economic_code" id="economic_code" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.national_code"))
                    @php($caption='')
                    @php($value=$single->national_code)
                    <x-InputRow :title="$title" name="national_code" id="national_code" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.postal_code"))
                    @php($caption='')
                    @php($value=$single->postal_code)
                    <x-InputRow :title="$title" name="postal_code" id="postal_code" :value="$value" :caption="$caption"
                                type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.national_code"))
                    @php($caption='')
                    @php($value=$single->national_code)
                    <x-InputRow :title="$title" name="national_code" id="national_code" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.registration_number"))
                    @php($caption='')
                    @php($value=$single->registration_number)
                    <x-InputRow :title="$title" name="registration_number" id="registration_number" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    {{--          <div class="form-group row">
                                  <label class="col-3">@lang("user.province") <strong>*</strong></label>
                                  <div class="col-9">
                                      <select class="form-control form-control" name="province_id">
                                          <option value="null" disabled selected hidden>انتخاب استان...</option>
                                          @foreach($provinces as $item)
                                              <option {{$single->city->province_id==$item->id?'selected':''}}  value="{{$item->id}}">{{$item->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
          --}}
                    {{--  <div class="form-group row">
                          <label class="col-3">@lang("user.city") <strong>*</strong></label>
                          <div class="col-9">
                              <select class="form-control form-control" name="city_id">
                                  <option value="null" disabled selected hidden>انتخاب شهر...</option>
                                  @foreach($cities as $item)
                                      <option {{$single->city_id==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
  --}}
                    <div class="form-group row">
                        <label class="col-3">@lang("user.city")</label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="city_id" data-size="5"
                                    data-live-search="true">
                                <option value="null" disabled selected hidden>انتخاب شهر...</option>
                                @foreach($cities as $item)
                                    @if(!is_null($single->city_id))
                                        <option
                                            {{$single->city_id==$item->id?'selected':''}}  value="{{$item->id}}">{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>


                    @php($title=__("information.area"))
                    @php($caption='')
                    @php($value=$single->area)
                    <x-InputRow :title="$title" name="area" id="area" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.postal_box"))
                    @php($caption='')
                    @php($value=$single->postal_box)
                    <x-InputRow :title="$title" name="postal_box" id="postal_box" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.address"))
                    @php($caption='')
                    @php($value=$single->address)
                    <x-InputRow :title="$title" name="address" id="address" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.location"))
                    @php($caption='')
                    @php($value=$single->location)
                    <x-InputRow :title="$title" name="location" id="location" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-tax">
                    </x-InputRow>

                    @php($title=__("information.telephone"))
                    @php($caption='')
                    @php($value=$single->telephone)
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
                                    <option
                                        {{$single->bank_id==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3">@lang("common.type")</label>
                        <div class="col-9">
                            <select class="form-control form-control" name="type">
                                <option
                                    {{$single->type==0?'selected':""}}  value="0">@lang("common.preinvoice")</option>
                                <option {{$single->type==1?'selected':""}} value="1">@lang("common.invoice")</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3">@lang("information.header_type")</label>
                        <div class="col-9">
                            <select class="form-control form-control" name="header_type">
                                <option
                                    {{$single->header_type==0?'selected':""}}  value="0">@lang("information.unofficial")</option>
                                <option {{$single->header_type==1?'selected':""}} value="1">@lang("information.official")</option>
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
