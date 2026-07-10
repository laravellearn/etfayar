@permission($permission)

<a href="{{$url}}"
   onclick="@php echo $click;
@endphp" class="btn {{ $btnClass??'btn-primary'}} font-weight-bolder mr-2 ml-2">
	<span class="svg-icon svg-icon-white svg-icon-md">
     @php
         echo $icon;
     @endphp
    </span> {{$title}}
</a>

@endpermission

