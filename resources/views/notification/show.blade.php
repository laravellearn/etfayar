@extends('layout.main')@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <div class="card-body">


                @php($title=__("notification.title"))
                @php($caption='')
                @php($value=$single->title)
                <x-InputRow :title="$title" name="title" id="title" :value="$value" :caption="$caption" type="text"
                            icon="bx bx-text" disabled="disabled"/>

                @php($title=__("notification.body"))
                @php($caption=__(""))
                @php($value=$single->body)
                <x-InputText :title="$title" name="body" id="body" :value="$value"
                             :caption="$caption"
                             type="text" icon="bx bx-text"
                             disabled="disabled">
                </x-InputText>


            </div>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <script>


    </script>
@endsection
