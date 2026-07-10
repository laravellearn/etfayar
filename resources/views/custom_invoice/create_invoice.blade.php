@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-sm-12 col-lg-8 offset-lg-2">
        <form class="form" action="{{route('custom_invoice.invoice.store')}}" method="post" autocomplete="off"
              enctype="multipart/form-data">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif

            @include('partials.form_error')

            @csrf
            <input type="hidden" name="id" value="{{$preinvoice->id}}">

            {{--General--}}
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title font-weight-bolder text-dark font-size-h3 font-size-h3-lg">اطلاعات
                        :</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">


                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div id="request_id_block" class="form-group row">
                        <label class="col-3">عنوان درخواست</label>
                        <div class="col-9">
                            <select class="form-control" name="request_id" disabled>
                                <option value="" disabled selected hidden>@lang('preinvoice.choose_request')...</option>
                                @foreach($requests as $item)
                                    <option
                                        {{ $preinvoice->request_id==$item->id ? 'selected':''}}  value="{{$item->id}}">{{$item->service->title??''}}
                                        به شماره درخواست {{$item->code}} برای {{$item->user->fullname??''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php($title=__("preinvoice.code"))
                    @php($caption='')
                    @php($value=$code)
                    <x-InputRow :title="$title" name="code" id="code" :value="$value" :caption="$caption" type="text"
                                icon="bx bx-tax" disabled="disabled">
                    </x-InputRow>

                    <div id="title_block" class="form-group row">
                        <label class="col-3">@lang("preinvoice.title")</label>
                        <div class="input-group col-9">
                            <div class="input-group-prepend show">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true">
                                    انتخاب عنوان
                                </button>
                                <div id="dropdown-menu" class="dropdown-menu">
                                    @foreach($informations as $item)
                                        <a onclick="getSelected(this,{{$item}})" class="dropdown-item"
                                           href="#">{{$item->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <input id="title" name="title" placeholder="انتخاب عنوان" value="{{$single->title??''}}"
                                   type="text" class="form-control"
                                   aria-label="input with dropdown button">

                        </div>
                    </div>
                    @php($title='میزان افزایش قیمت')
                    @php($caption='')
                    @php($value=$single->increase_percent_per_item??0)
                    <x-InputRow :title="$title" name="increase_percent_per_item" id="increase_percent_per_item"
                                :value="$value" :caption="$caption" type="number" max="100" min="0"
                                icon="bx bx-tax">

                    </x-InputRow>

                    @php($title=__("description.add"))
                    @php($caption=__(""))
                    @php($value=$single->description??'')
                    <x-InputText :title="$title" name="description" id="description" :value="$value"
                                 :caption="$caption"
                                 type="text" icon="bx bx-text">
                    </x-InputText>



                    @php($title=__("preinvoice.page_header"))
                    @php($caption='')
                    @php($value='')
                    <x-InputRow :title="$title" name="header" id="header" :value="$value" :caption="$caption"
                                type="file"
                                icon="bx bx-tax">
                    </x-InputRow>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">حذف فایل سربرگ</label>
                        <div class="col-3">
                               <span class="switch">
                                   <label>
                                       <input type="checkbox" name="is_delete_header">
                                       <span></span>
                                   </label>
                               </span>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-3">نوع فاکتور</label>
                        <div class="col-9">
                            @php($items=[['title'=>'فاکتور شماره 1','value'=>1],['title'=>'فاکتور شماره 2','value'=>2]])
                            <select class="form-control" name="type">
                                @foreach($items as $item)
                                    <option

                                        @if(isset($single))
                                        {{$single->type==$item['value']?'selected':''}}
                                        @endif
                                        value="{{$item['value']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
            </div>

            @include('partials.card_footer')

        </form>

    </div>
    <script>

        function getSelected(element, item) {
            document.getElementById("title").value = element.innerText;
        }

    </script>
@endsection
