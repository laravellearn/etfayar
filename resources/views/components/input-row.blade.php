<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            <label>{{$title}} : </label>
        </div>
        <div class="col-md-9">
            <div class="">
                <input  type="{{$type}}" class="form-control  form-control-color" name="{{$name}}" id="{{$id}}" placeholder="{{$title}}" value="{{$value}}" min="{{$min}}" {{$disabled}}>
                <span class="form-text text-muted">{{$caption}}</span>
                <div class="form-control-position">
                    @if($type=='file' && isset($image))
                        <img class="rounded-circle" src="{{asset('/storage/'.$value)}}" alt="avatar" height="32" width="32">
                    @else
                        <i class="{{$icon}}"></i>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
