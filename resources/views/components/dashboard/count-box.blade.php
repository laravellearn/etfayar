@permission($permission)

<div class="col-xl-4">
    <!--begin::آمار Widget 13-->
    <a href="{{$url}}"
       class="card card-custom {{$color}} card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
        <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
             @php
                 echo $icon;
             @endphp
        </span>
            <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5">{{$title}}</div>
            <div class="font-weight-bold text-inverse-danger font-size-sm">{{$caption}}</div>
        </div>
        <!--end::Body-->
    </a>
    <!--end::آمار Widget 13-->
</div>

@endpermission
