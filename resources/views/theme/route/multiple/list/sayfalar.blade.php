@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}} - {{$masters->seo->data->dynamic->keyword1}}</title>
    
    <meta name="description" content="{{$multiple->component->seo->desc}}">

@endsection
@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])



    
    
    
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <div class="row g-5">



                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">

 
                                    
                                     @foreach ($multiple->data as $key => $data)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <!-- single service start -->
                                        <div class="rts-single-service-h2">
                                            @if(!empty($data->dynamic->resim))
                                            <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}" class="thumbnail">
                                                 
                                                    <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                                
                                            </a>
                                            @endif
                                            <div class="body">
                                                <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                                    <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                                </a>
                                                 
                                                                            
                                            </div>
                                        </div>
                                        <!-- single service End -->
                                    </div>
                                    @endforeach


                    </div>

                </div>
                <!--rts blog wized area -->

            </div>
        </div>
    </div>
    


@stop
