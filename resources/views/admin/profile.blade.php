@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic" src="{{asset('media/logos/rayan_etfa_logo2.png')}}">
                        </div>
                    </div>
                    <!--end::Pic-->

                    <!--begin: اطلاعات-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::نام-->
                                    <a href="#"
                                       class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                        {{$admin->full_name}}
                                    </a>
                                    <!--end::نام-->
                                    <span
                                        class="label label-light-success label-inline font-weight-bolder mr-1">{{$admin->username}}</span>
                                </div>

                                <!--begin::مخاطب-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#"
                                       class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:assets/media/svg/icons/ارتباطات/Mail-notification.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path
            d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
            fill="#000000"></path>
        <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
    </g>
</svg><!--end::Svg Icon--></span> {{$admin->email}}
                                    </a>
                                    @foreach($admin->roles as $role)
                                        <a href="#"
                                           class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:assets/media/svg/icons/عمومی/Lock.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <mask fill="white">
            <use xlink:href="#path-1"></use>
        </mask>
        <g></g>
        <path
            d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
            fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon--></span> {{$role->persian_title}}
                                        </a>
                                    @endforeach

                                    <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:assets/media/svg/icons/Map/marker2.svg--><svg
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
    <title>Stockholm-icons / Communication / Outgoing-call</title>
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Stockholm-icons-/-Communication-/-Outgoing-call" stroke="none" stroke-width="1" fill="none"
       fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
        <path
            d="M7.14296018,11.6653622 C7.06267828,11.7456441 6.95746388,11.7962128 6.84462255,11.8087507 C6.57016914,11.8392455 6.32295974,11.641478 6.29246492,11.3670246 L5.76926113,6.65819047 C5.76518362,6.62149288 5.76518362,6.58445654 5.76926113,6.54775895 C5.79975595,6.27330553 6.04696535,6.07553802 6.32141876,6.10603284 L11.0302529,6.62923663 C11.1430942,6.64177456 11.2483086,6.69234321 11.3285905,6.77262511 C11.5238526,6.96788726 11.5238526,7.28446974 11.3285905,7.47973189 L9.94288211,8.86544026 L11.4443443,10.3669024 C11.6396064,10.5621646 11.6396064,10.8787471 11.4443443,11.0740092 L10.7372375,11.781116 C10.5419754,11.9763782 10.2253929,11.9763782 10.0301307,11.781116 L8.52866855,10.2796538 L7.14296018,11.6653622 Z"
            id="Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path
            d="M12.0799676,14.7839934 L14.2839934,12.5799676 C14.8927139,11.9712471 15.0436229,11.0413042 14.6586342,10.2713269 L14.5337539,10.0215663 C14.1487653,9.25158901 14.2996742,8.3216461 14.9083948,7.71292558 L17.6411989,4.98012149 C17.836461,4.78485934 18.1530435,4.78485934 18.3483056,4.98012149 C18.3863063,5.01812215 18.4179321,5.06200062 18.4419658,5.11006808 L19.5459415,7.31801948 C20.3904962,9.0071287 20.0594452,11.0471565 18.7240871,12.3825146 L12.7252616,18.3813401 C11.2717221,19.8348796 9.12170075,20.3424308 7.17157288,19.6923882 L4.75709327,18.8875616 C4.49512161,18.8002377 4.35354162,18.5170777 4.4408655,18.2551061 C4.46541191,18.1814669 4.50676633,18.114554 4.56165376,18.0596666 L7.21292558,15.4083948 C7.8216461,14.7996742 8.75158901,14.6487653 9.52156634,15.0337539 L9.77132688,15.1586342 C10.5413042,15.5436229 11.4712471,15.3927139 12.0799676,14.7839934 Z"
            id="Path-76" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon--></span> {{$admin->mobile}}
                                    </a>

                                </div>
                                <!--end::مخاطب-->
                            </div>
                            <!--begin::User-->
                        </div>
                        <!--end::Title-->

                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                آی پی :{{$ip}}
                            </div>
                            <!--end::Description-->

                        </div>
                        <!--end::Content-->


                        <!--begin::Content-->
                        <hr>
                        <div class="col-12">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @include('partials.form_error')


                            <form action="{{route('admin.change_password')}}" method="post">
                                @csrf

                                <div class="col-6 p-1"><input type="password" class="form-control" name="password_old"
                                                              id="password_old"
                                                              placeholder="رمزعبور قبلی"></div>

                                <div class="col-6 p-1"><input type="password" class="form-control" name="password"
                                                              id="password"
                                                              placeholder="رمزعبور"></div>

                                <div class="col-6 p-1"><input type="password" class="form-control"
                                                              name="password_confirmation"
                                                              id="password_confirmation"
                                                              placeholder="تکرار رمزعبور"></div>
                                <div class="col-4 p-1">
                                    <button type="submit"
                                            class="btn btn-primary mr-2">تغییر پسورد
                                    </button>

                                </div>
                            </form>


                        </div>
                    </div>
                    <!--end::Content-->


                </div>
                <!--end::اطلاعات-->
            </div>
        </div>
    </div>

@endsection
