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
            <form class="form" action="{{route('message.store')}}" method="post">
                <div class="card-body">

                    @csrf
                    <div class="form-group row">
                        <label class="col-3">@lang("message_report.users")</label>
                        <div class="col-9">
                            <select class="form-control selectpicker" name="user_ids[]" data-size="5"
                                    data-live-search="true"
                                    data-fv-not-empty="true"
                                    multiple="multiple"
                                    data-fv-not-empty___message="@lang('message_report.choose_user')..."
                                    required>
                                <option value="" disabled selected hidden>@lang('message_report.choose_user')...</option>
                                @foreach($users as $item)
                                    <option
                                        {{ old('user_id')==$item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--  @php($title=__("insurance.number"))
                      @php($caption='')
                      @php($value='')
                      <x-InputRow :title="$title" name="number" id="number" :value="$value" :caption="$caption"
                                  type="number" :min="0" icon="bx bx-calculator"/>--}}

                    @php($title=__("message_report.text"))
                    @php($caption=__(""))
                    @php($value='')
                    <x-InputText :title="$title" name="text" id="text" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>


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
