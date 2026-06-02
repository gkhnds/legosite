@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}} - {{$masters->seo->data->dynamic->keyword1}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">

    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])

@endsection
@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])



    <section class="case-study-area case-bg2 nav-style-1 pt--70 pt_md--60 pt_xs--60 pb--115 pb_md--60 pb_xs--60">
        <div class="container">
            <div class="row">

                @foreach ($multiple->data as $key => $data)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="item">
                        <div class="cases-wrapper2">
                            @if(!empty($data->dynamic->resim))
                            <div class="blog-header">
                                        <a class="thumbnail" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                            <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                        </a>

                            </div>
                            @endif
                            <div class="item-content">
                
                                <h6 class="fs-20 text-heding3">{{$data->dynamic->baslik}}</h6>

                               @if(!empty($data->dynamic->meta_description)) <p>{{$data->dynamic->meta_description}}</p> @endif
                            </div>

                            <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}" title="{{$data->dynamic->baslik}}" class="read-more">{{$translate->daha_fazla}} <span class="f-right"><i class="far fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                @endforeach




            </div>
        </div>
    </section>





@stop
