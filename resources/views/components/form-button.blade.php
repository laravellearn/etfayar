@permission($permission)
<a href="{{$url}}"
   onclick="@php echo $click;
@endphp"
   class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2"
   title="{{$title}}"
   target="{{$target}}">
    <span class="svg-icon svg-icon-{{ isset($type)?"{$type}":'light'}} svg-icon-md">
         @php
             echo $icon;
         @endphp

    </span>
</a>

@endpermission
