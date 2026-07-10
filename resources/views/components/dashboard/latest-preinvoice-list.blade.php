@permission($permission)
<div class="col-6 p-1">
    <div class=" col-12 p-1 h-auto">
        <!--begin::لیست Widget 3-->
        <div class="card card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">آخرین پیش فاکتورهای صادر شده</h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-2">
            @foreach($list as $item)
                <!--begin::Item-->
                    <div class="d-flex align-items-center mb-10">
                        <!--begin::سیمبل-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                <span class="symbol-label">{{ $loop->iteration }}
                    <img src="" class="h-75 align-self-end" alt=""/>
                </span>
                        </div>
                        <!--end::سیمبل-->

                        <!--begin::متن-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="{{route('preinvoice.show',$item->id)}}"
                               class="text-dark text-hover-primary mb-1 font-size-lg">{{$item->request->user->full_name??''}}</a>
                            <span class="text-muted">{{$item->title}}</span>
                        </div>
                        <!--end::متن-->

                        <div class="{{$item->statusBadge}}">{{$item->statusTitle}}</div>

                    </div>
                    <!--end::Item-->

                @endforeach

            </div>
            <!--end::Body-->
        </div>
        <!--end::لیست Widget 3-->
    </div>

</div>

@endpermission