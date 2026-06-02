@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}} | Box Producer</title>
    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection
@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])



    <!--portfolio-area start-->
    <section class="portfolio-area style-5 pt--120 pb--120 pt_xs--60 pt_xs--60">
        <div class="container">
            <div class="row">
                @foreach ($multiple->data as $key => $data)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item">
                            <div class="portfolio-wrapper">
                                @if(!empty($data->dynamic->resim))
                                    <div class="img-fluid">
                                        <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}} {{$masters->seo->data->dynamic->keyword1}}">
                                    </div>

                                @endif

                                <div class="single-portfolio">

                                    <h4 class="portfolio-title text-white">{{$data->dynamic->baslik}}</h4>
                                    <span>{{$data->dynamic->spot}}</span>
                                </div>
                                <a class="pf-btn" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}"><i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!--portfolio-area end-->


@stop
