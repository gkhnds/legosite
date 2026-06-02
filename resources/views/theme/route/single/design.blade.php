@extends('theme.master')

@section('title', $single->component->seo->title)

@section('meta')
    <title>{{$single->data->dynamic->baslik}} - {{$single->component->seo->title}} | Box Producer</title>

    <meta name="description" content="{{$single->component->seo->desc}}">



    <!-- Creaati Seo Tools CONTACT -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Corporation",
      "name": "{{$single->component->seo->title}}",
      "url": "{{url('/')}}/{{$lang}}",
      "logo": "{{$masters->tasarim_ayarlari->data->dynamic->logo}}"
    }
    </script>
    <!-- Creaati Seo Tools CONTACT -->

@endsection

@section('content')


   







   <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- about left -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-1 ">
                    <div class="rts-title-area">
                        <p class="pre-title">
                            {{$single->data->dynamic->ust_baslik}}
                        </p>
                        <h1 class="title">{{$single->data->dynamic->baslik}}</h1>
                    </div>
                    
                     
                    <div class="about-inner">
                        <p class="disc">
                             {!! $single->data->dynamic->detay !!}
                        </p>
                        
                        
                       
                            
                            
                        <!-- start about success area -->
                        <div class="row about-success-wrapper">
                            <!-- left wrapper start -->
                            <div class="col-lg-12 col-md-12">
                                
                                @php $tags = $single->data->dynamic->ozellikler; $tags = explode(';',$tags); @endphp
                                    @if(!empty($tags))
                                        @foreach($tags as $tag)
                                             <div class="single">
                                                <i class="far fa-check"></i>
                                                <p class="details">{{$tag}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                    
                               
                                
                            </div>
                            <!-- left wrapper end -->
                            
                        </div>
                        <!-- start about success area -->
                    
                    
                     @if(!empty($single->data->dynamic->detay2))
                             <p class="disc mt--30">
                               {!! $single->data->dynamic->detay2 !!}
                            </p>
                            @endif
                    
                    
                    </div>
                 </div>
                <!-- about right -->
                
                
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-1 order-md-2 order-sm-2 order-2 mt_md--50 mt_sm--50">
                        <div class="rts-title-area mt--50">
                        <p class="pre-title">
                            {{$single->data->dynamic->resim1_baslik}}
                        </p>
                        
                        </div>
                         @if(!empty($single->data->dynamic->resim1))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim1,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->resim1_baslik}}">
                        </div>
                        @endif
                    </div> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-2 order-md-1 order-sm-1 order-1">
                        <div class="rts-title-area mt--50">
                        <p class="pre-title">
                            {{$single->data->dynamic->resim2_baslik}}
                        </p>
                       
                        </div>
                         @if(!empty($single->data->dynamic->resim2))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim2,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->resim2_baslik}}">
                        </div>
                        @endif
                    </div>  
                    
                    
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-1 order-md-2 order-sm-2 order-2 mt_md--50 mt_sm--50">
                        <div class="rts-title-area mt--50">
                        <p class="pre-title">
                            {{$single->data->dynamic->resim3_baslik}}
                        </p>
                        
                        </div>
                         @if(!empty($single->data->dynamic->resim3))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim3,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->resim3_baslik}}">
                        </div>
                        @endif
                    </div> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-2 order-md-1 order-sm-1 order-1">
                        <div class="rts-title-area mt--50">
                        <p class="pre-title">
                            {{$single->data->dynamic->resim4_baslik}}
                        </p>
                       
                        </div>
                         @if(!empty($single->data->dynamic->resim4))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim4,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->resim4_baslik}}">
                        </div>
                        @endif
                    </div>  



                       
               
                
                
                
            </div>
        </div>
    </div>


   



<div class="rts-blog-list-area ">
        <div class="container">
            <div class="row g-5">
                <!-- rts blo post area -->
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <!-- single post -->
                    <div class="blog-single-post-listing details mb--0">
                        <hr>
                        <div class="">
                            
                            @if(!empty($single->data->dynamic->detay3))
                             <p class="disc mt--30">
                               {!! $single->data->dynamic->detay3 !!}
                            </p>
                            @endif
                             
                            
                            
                            
                        </div>
                    </div>
                    <!-- single post End-->
                </div>
                <!-- rts-blog post end area -->
                <!--rts blog wizered area -->
                
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>


    




@stop

@section('customModuleContent')
     
@endsection