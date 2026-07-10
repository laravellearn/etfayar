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
            <form class="form" action="{{route('user_support.update')}}" method="post">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$single->id}}">
                    <input type="hidden" name="previous_url" id="previous_url" value="{{$previous_url}}">

                    @php($title=__("user_support.create_description"))
                    @php($caption=__(""))
                    @php($value=$single->create_description)
                    <x-InputText :title="$title" name="create_description" id="create_description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>

                    @php($title=__("user_support.support_time"))
                    @php($caption='')
                    @php($value=$single->persianSupportTime??'')
                    <x-InputRow :title="$title" name="support_time" id="support_time" :value="$value"
                                :caption="$caption" type="text"
                                icon="bx bx-calendar">
                    </x-InputRow>

                    @php($title=__("user_support.done_description"))
                    @php($caption=__(""))
                    @php($value=$single->done_description)
                    <x-InputText :title="$title" name="done_description" id="done_description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>

                    <div class="form-group row">
                        <label class="col-3">@lang("common.status")</label>
                        <div class="col-9">
                            @php($items=[
    ['title'=>'پشتیبانی انجام نشده است','value'=>0],
    ['title'=>'پشتیبانی موفق','value'=>1],
    ['title'=>'پشتیبانی ناموفق','value'=>2],
    ])
                            <select class="form-control" name="status">
                                <option value="" disabled selected hidden>@lang('common.choose_status')...</option>
                                @foreach($items as $item)
                                    <option
                                        {{$single->status==$item['value']?'selected':''}}  value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
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
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: true
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , pastYearsCount: 0
            , futureYearsCount: 3
            , markToday: true
            , markHolidays: false
            , highlightSelectedDay: false
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('support_time', customOptions);
    </script>
@endsection
