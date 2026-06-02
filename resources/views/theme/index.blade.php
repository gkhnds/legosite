@extends('theme.master')

@section('meta')
    <title>{{$masters->seo->data->dynamic->title}}</title>

    <meta name="description" content="{{$masters->seo->data->dynamic->description}}">
@endsection

@section('content')

    @foreach($masters->moduller->data as $k => $modul)
        @if($modul->dynamic->tipi == 'Anasayfa')
            <x-modules position="Anasayfa" view="{{$modul->dynamic->view}}"  uuid="{{$modul->static->uuid}}"/>
        @endif
    @endforeach
    
@endsection
