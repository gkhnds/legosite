<!DOCTYPE html>

<html lang="{{$lang}}">



@include('theme.partials.head')

<body class="index-six loaded">
 {!! $masters->site_ayarlari->data->dynamic->tagmanager_body !!}
@include('theme.partials.header')





@yield('content')


@include('theme.partials.footer')

@include('theme.partials.mobile-cta')





@include('theme.partials.scripts')

@yield('customModuleContent')

</body>
</html>
