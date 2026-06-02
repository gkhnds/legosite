@extends('theme.master')
@section('title', $multiple->component->seo->title)
@section('meta')
    <title>{{$multiple->component->seo->title}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])

@endsection
@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])

   
   <section class="case-study-area case-bg2 nav-style-1  pt_md--60 pt_xs--60 pb--115 pb_md--60 pb_xs--60">
        <div class="container">
            <div class="row">
                
                @foreach ($multiple->data as $key => $data)
                <div class="col-lg-4 col-md-6 col-sm-12 featured-imagebox featured-imagebox-portfolio">
                    <div class="item">
                        <div class="cases-wrapper2">
                            <div class="item-image">
                              <a data-fancybox="gallery-v1" href="{{$data->dynamic->video}}">
                                  @if(!empty($data->dynamic->resim))
                                   <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                  @else
                                  <img src="{{Helpers::GetVideoThumbnail($data->dynamic->video)}}" alt="{{$data->dynamic->baslik}}">
                                  @endif
                              </a>
                            </div>
                            
                            <a data-fancybox="gallery-v1" href="{{$data->dynamic->video}}" class="read-more">{{$data->dynamic->baslik}} <span class="f-right"><i class="far fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                
                @endforeach
                
                
                
            </div>
        </div>
    </section>
    
    
    
     



@endsection

@section('customModuleContent')

<link rel="stylesheet" type="text/css" href="/assets/css/jquery.fancybox.css"/>
        <script src="/assets/js/jquery.fancybox.min.js"></script>
        
        
        
@endsection

