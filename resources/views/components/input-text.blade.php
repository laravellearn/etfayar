<div class="row">
    <div class="col-md-3">
        <label>{{$title}}</label>
    </div>
    <div class="col-md-9 form-group">
        <div class="position-relative has-icon-left">
            <textarea class="form-control" rows="6" name="{{$name}}" id="{{$id}}"
                      placeholder="{{$title}}" {{$disabled}}>{{$value}}</textarea>
            <div class="form-control-position">
                <i class="{{$icon}}"></i>
            </div>
        </div>
        <span class="form-text text-muted">{{$caption}}</span>
    </div>


</div>
