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
            <form autocomplete="off" class="form" action="{{route('transport.update_done_task')}}" method="post">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" value="{{$single->id}}">


                    @php($title=__("transport.delivery_description"))
                    @php($caption=__(""))
                    @php($value=$single->delivery_description??'')
                    <x-InputText :title="$title" name="delivery_description" id="delivery_description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label>تایید انجام شدن تحویل : </label>
                            </div>
                            <div class="col-md-9">
                                <div class="">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="is_done" checked>
                                        <span></span>

                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
