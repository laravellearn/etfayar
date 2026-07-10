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
            <form class="form" action="{{route('ip.store_settings')}}" method="post">
                <div class="card-body">

                    @csrf

                    <div class="form-group row">
                        <label class="col-3 col-form-label">فعال بودن محافظت آی پی</label>
                        <div class="col-3">
							<span class="switch">
								<label>
									<input type="checkbox"
                                           {{$value=='true'?'checked':''}} name="is_active_ip_protection">
									<span></span>
								</label>
							</span>
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
