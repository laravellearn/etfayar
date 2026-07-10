@extends('layout.main')
@section('title', $title)
@section('content')
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    @lang('user.edit_role') </h3>
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
            <form class="form" action="{{route('role.update')}}" method="post">
                <div class="card-body">

                    @csrf

                    <input type="hidden" name="id" value="{{$role->id}}">

                    @php($title=__("user.code"))
                    @php($caption=__("user.code_automatic_generate"))
                    @php($value=$role->code)
                    <x-InputRow :title="$title" name="" id="" :value="$value" type="number" :caption="$caption"
                                disabled="disabled" icon="bx bx-text"/>

                    @php($title=__("user.title"))
                    @php($caption=__("user.input_english_title"))
                    @php($value=$role->title)
                    <x-InputRow :title="$title" name="title" id="title" :value="$value" :caption="$caption" type="text"
                                disabled="disabled" icon="bx bx-text"/>

                    @php($title=__("user.persian_title"))
                    @php($caption=__("user.input_persian_title"))
                    @php($value=$role->persian_title)
                    <x-InputRow :title="$title" name="persian_title" id="persian_title" :caption="$caption"
                                :value="$value" type="text" icon="bx bx-text"/>

                    @php($status=$role->status)
                    @include('partials.status_input')

                    {{-- <label>@lang('user.permissions')</label>
                     <div class="checkbox-list">
                         @foreach($permissions as $permission)
                             <label class="checkbox"> <input type="checkbox"
                                                             {{$role->permissions->contains($permission)?'checked':''}} name="permissions[]"
                                                             value="{{$permission->title}}">
                                 <span></span> {{$permission->persian_title}}
                             </label>
                         @endforeach
                     </div>
                     --}}
                    <label>@lang('user.permissions')</label>
                    <div class="accordion accordion-toggle-arrow" id="accordionنمونه1">
                        @foreach($permissions as $permission)
                        <div class="card m-2">
                            <div class="card-header">
                                <div class="card-title" data-toggle="collapse" data-target="#collapse{{$permission->id}}" aria-expanded="true">
                                    {{$permission->persian_title}}
                                </div>
                            </div>
                            <div id="collapse{{$permission->id}}" class="collapse show" data-parent="#accordionنمونه1" style="">
                                <div class="card-body">

                                    <div class="checkbox-list">
                                        <label class="checkbox"><input type="checkbox"
                                                                        {{$role->permissions->contains($permission)?'checked':''}} name="permissions[]"
                                                                        value="{{$permission->title}}">
                                            <span></span> {{$permission->persian_title}}
                                        </label>
                                        @foreach($permission->childs as $permission)
                                            <label class="checkbox"> <input type="checkbox"
                                                                            {{$role->permissions->contains($permission)?'checked':''}} name="permissions[]"
                                                                            value="{{$permission->title}}">
                                                <span></span> {{$permission->persian_title}}
                                            </label>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>
                @include('partials.card_footer')
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
