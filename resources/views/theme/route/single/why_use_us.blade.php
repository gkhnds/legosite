@extends('theme.master')

@section('title', $single->component->seo->title)

@section('meta')
    <title>{{$single->data->dynamic->baslik}} - {{$single->component->seo->title}}</title>

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
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-1 order-md-2 order-sm-2 order-2 mt_md--50 mt_sm--50">
                    <div class="rts-title-area">
                        <p class="pre-title">
                            {{$single->data->dynamic->ust_baslik}}
                        </p>
                        <h1 class="title">{{$single->data->dynamic->baslik}}</h1>
                    </div>
                    <div class="about-inner">
                        <p class="disc">
                            {{$single->data->dynamic->spot}}
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

                        <!-- about founder & get in touch start -->
                        <div class="row about-founder-wrapper align-items-center mt--40">
                            <!-- left area start -->
                            
                            <!-- left area end -->
                            <!-- right founder area -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_sm--20">
                                <div class="author-call-option">
                                    <img class="authore-call" src="/assets/images/about/call.svg" alt="call_founder">
                                    <div class="call-details">
                                        <span>{{$translate->bize_ulasin}}</span>
                                        <a href="tel:{{$masters->iletisim->data->dynamic->telefon}}">
                                            <h6 class="title">{{$masters->iletisim->data->dynamic->telefon}}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- left founder area -->
                        </div>
                        <!-- about founder & get in touch end -->
                    </div>
                </div>
                <!-- about right -->

                <!-- about-right Start-->
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-2 order-md-1 order-sm-1 order-1">
                    <div class="about-one-thumbnail">
                        <video autoplay loop muted playsinline style="width: 100%; max-height: 480px;">
                            <source src="https://boxproducer.com/why-ani.mp4" type="video/mp4">
                            
                        </video>
                       
                    </div>

                    <!--
                    <div class="about-one-thumbnail">
                        <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim1,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}}" style="border-radius: 5%;">
                        <img class="small-img" src="{{Helpers::NoCacheImageLink($single->data->dynamic->resim2,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}}">
                         
                    </div>
                    -->
                    
                    
                    <div class="service-detials-step-1">
                        
                        
                        
                        
                        <div class="row g-5 mt--30 mb--40">
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    
                                    <div class="details" style="margin-left: 0;">
                                        <h6 class="title">ATI IC VE DIS TICARET LTD. STI.</h6>
                                        <p class="disc">{{$translate->why_us_trade_name}}</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    
                                    <div class="details" style="margin-left: 0;">
                                        <h6 class="title">265335-5</h6>
                                        <p class="disc">{{$translate->why_us_ito}}</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    
                                    <div class="details" style="margin-left: 0;">
                                        <h6 class="title">0102085648100001</h6>
                                        <p class="disc">{{$translate->why_us_mersis}}</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    
                                    <div class="details" style="margin-left:0;">
                                        <h6 class="title">DAVUTPASA / 1020856481</h6>
                                        <p class="disc">{{$translate->why_us_tax_office}}</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                        </div>
                        
                    </div>
                        
                        
                        
                </div>
                <!-- about-right end -->
                
                
                
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
                            
                            @if(!empty($single->data->dynamic->detay))
                             <p class="disc mt--30">
                               {!! $single->data->dynamic->detay !!}
                            </p>
                            @endif
                            <div class="row  align-items-center">
                                <div class="col-lg-12 col-md-12">
                                    <!-- tags details -->
                                    <div class="details-tag">
                                        
                                        
                                    </div>
                                    <!-- tags details End -->
                                </div>
                                
                            </div>
                            
                            
                            
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