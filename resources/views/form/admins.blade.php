@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    {{$title}} </h3>
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
            <form class="" action="{{route('form.update_admins')}}" method="post">
                <div class="card-body">
                    @csrf

                    <input type="hidden" class="form-control" name="form_id" value="{{ $form_id }}">

                    @foreach($roles as $role)

                        <div class="checkbox-list"><label class="checkbox checkbox-lg">
                                <input type="checkbox"
                                       {{in_array($role->id,$single->rolesIds)?'checked':''}}  name="roles[]"
                                       value="{{$role->id}}">
                                <span></span> {{$role->persian_title}}
                            </label>
                        </div>
                        <br>
                    @endforeach


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
