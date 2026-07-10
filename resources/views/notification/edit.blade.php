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
            <form class="form" action="{{route('notification.update')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$single->id}}">

                    @php($title=__("notification.title"))
                    @php($caption='')
                    @php($value=$single->title)
                    <x-InputRow :title="$title" name="title" id="title" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-text"/>

                    @php($title=__("notification.body"))
                    @php($caption=__(""))
                    @php($value=$single->body)
                    <x-InputText :title="$title" name="body" id="body" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>

                    <div class="form-group row">
                        <label class="col-3">@lang("notification.roles") <strong>*</strong></label>
                        <div class="col-9">
                            @foreach($roles as $role)

                                <div class="checkbox-list"><label class="checkbox checkbox-lg">
                                        <input type="checkbox"
                                               name="roles[]"
                                               {{in_array($role->id,$single->rolesIds)?'checked':''}}
                                               value="{{$role->id}}">
                                        <span></span> {{$role->persian_title}}
                                    </label>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>

                    @php($status=$single->status)
                    @include('partials.status_input')

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
