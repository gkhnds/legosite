
<img @if(!empty($Id)) id="{{$Id}}" @endif @if($LazyMode  == false) src="{{$Image}}" @else src="{{$Image}}" data-src="{{$Image}}" @endif class="@if($LazyMode  == true) lazy @endif {{$Class}}"
     @if(count($Attributes) > 0)
        @foreach($Attributes as $key => $attribute) {{$key}}="{{$attribute}}" @endforeach
     @endif
     alt="{{$Alt}}">
