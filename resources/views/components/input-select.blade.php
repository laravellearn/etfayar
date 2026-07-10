<div class="row">
    <div class="col-md-3">
        <label>{{$title}}</label>
    </div>
    <div class="col-md-9 form-group">
        <select class="select selectpicker" name="{{$name}}" id="{{$id}}" {{$disabled}}>
            @if(isset($items))
                @if($isAddFirst)
                    <option value=null {{checkSelected(null,$value)}}>اصلی</option>
                @endif
                @foreach($items as $item)
                    <option value="{{$item[$valueKey]}}" {{checkSelected($item[$valueKey],$value)}}>{{$item[$key]}}</option>
                @endforeach
        </select>
        @endif
        <div class="form-control-position">
            <i class="{{$icon}}"></i>
        </div>
    </div>

</div>
