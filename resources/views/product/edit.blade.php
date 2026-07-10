@extends('layout.main')
@section('title', $title)
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
            <form class="form" action="{{route('product.update')}}" method="post">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" value="{{$single->id}}">

                    {{-- نام محصول --}}
                    @php($title = __("product.name"))
                    @php($caption = '')
                    @php($value = $single->title)
                    <x-InputRow :title="$title" name="title" id="title" :value="$value" :caption="$caption"
                                type="text" icon="bx bx-text"/>

                    {{-- قیمت --}}
                    @php($title = __("product.price"))
                    @php($caption = '')
                    @php($value = $single->price)
                    <x-InputRow :title="$title" name="price" id="price" :value="$value" :caption="$caption"
                                type="number" :min="0" icon="bx bx-text"/>

                    {{-- موجودی --}}
                    @php($title = __("product.quantity"))
                    @php($caption = '')
                    @php($value = $single->quantity)
                    <x-InputRow :title="$title" name="quantity" id="quantity" :value="$value" :caption="$caption"
                                type="number" :min="0" icon="bx bx-text"/>

                    {{-- نوع محصول / خدمت / تست (جدید) --}}
                    @php($title = __("انتخاب نوع"))
                    @php($caption = '')
                    @php($value = old('type', $single->type))
                    @php($items = [
                        ['id' => 'product', 'title' => 'محصول'],
                        ['id' => 'service', 'title' => 'خدمت'],
                        ['id' => 'test', 'title' => 'تست']
                    ])
                    <x-input-select
                        :title="$title"
                        name="type"
                        id="type"
                        :value="$value"
                        :caption="$caption"
                        :items="$items"
                        valueKey="id"
                        key="title"
                        :isAddFirst="false"
                        disabled=""
                        icon="bx bx-list-ul"
                    />

                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <script>
        // اسکریپت‌های خاص این صفحه (در صورت نیاز)
    </script>
@endsection