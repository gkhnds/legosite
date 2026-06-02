@extends('theme.master')


@section('meta')
    <title>@if(!empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->meta_title}} @else  {{$single->data->dynamic->baslik}} @endif | {{$single->component->seo->title}}</title>

    <meta name="description" content="{{$single->data->dynamic->meta_description}}">
   
   @foreach($ladders->urun_ozellik_gruplari as $kategori)
  
        @if($single->data->dynamic->kategori[0] == $kategori->uuid )
          @php $kat_name = $kategori->name;   @endphp
          @php $kat_slug = $kategori->slug;   @endphp
        @else
            @if(isset($kategori->children))
            @foreach($kategori->children as $kategoriChild)
                @if($single->data->dynamic->kategori[0] == $kategoriChild->uuid )
                  @php $kat_name = $kategoriChild->name; @endphp
                  @php $kat_slug = $kategoriChild->slug;   @endphp
                @endif
            @endforeach
            @endif
        @endif
 @endforeach
   
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{url('/')}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}"
  },
  "headline": "{{$single->data->dynamic->baslik}}",
  "description": "{{$single->data->dynamic->meta_description}}",
  "image": "{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
  "author": {
    "@type": "Person",
    "name": "{{$masters->seo->data->dynamic->author}}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{$masters->seo->data->dynamic->organization}}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false, 'Mime' => 'webp'))}}"
    }
  },
  "datePublished": "{{$single->data->static->created_at}}"
}
</script>

 
 <!-- BreadcrumbList shema -->
   <!-- BreadcrumbList shema -->
    
      <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "{{$translate->anasayfa}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "{{$single->component->seo->title}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$single->component->slug}}"
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "{{$kat_name}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$single->component->slug}}/{{$kat_slug}}"
      },{
        "@type": "ListItem",
        "position": 4,
        "name": "{{$single->data->dynamic->baslik}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}"
      }]
    }
    </script>
    <!-- BreadcrumbList shema -->
    <!-- BreadcrumbList shema -->
 
@endsection

@section('social')



@endsection

@section('content')



     <!-- start breadcrumb area -->
<div class="rts-breadcrumb-area bg_image " style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                <h1 class="title">{{$single->data->dynamic->baslik}}</h3>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                
               
                <div class="bread-tag">
                    <a href="/{{$lang}}">{{$translate->anasayfa}}</a>
                        <span> / </span> 
                    &nbsp;<a href="/{{$lang}}/{{$single->component->slug}}">{{$single->component->seo->title}}</a>
                        <span> / </span>  
                        &nbsp;<a href="/{{$lang}}/{{$single->component->slug}}/{{$kat_slug}}">{{$kat_name}}</a>
                        
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb area -->

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">


               

 

                <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">
 @if(!empty($single->data->dynamic->resim))
      
        @php
        $resimListesi = explode(',', $single->data->dynamic->resim);
        $resimCount = count($resimListesi);
        @endphp
       
        @if($resimCount > 1)
                      
                            <!-- slider -->
                            <!-- slider -->
                            <div id="gallery" style="display:none;" class="mb--30">

                                @foreach(Helpers::CacheImageList($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp')) as $image)


                                    <img alt="{{$single->data->dynamic->baslik}} images"
                                         src="{{$image}}"
                                         data-image="{{$image}}"
                                         data-description="{{$single->data->dynamic->baslik}}">

                                @endforeach

                            </div>
                            <!-- slider -->
                            <!-- slider -->
                        
                        
        @else                

 
                        
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}} images">
                        </div>
        @endif
                        
@endif 
                        <p class="disc">
                            {!! $single->data->dynamic->detay !!}
                        </p>

                        @if(!empty($single->data->dynamic->video))
                            <hr>
                            <iframe id="player" type="text/html" width="640" height="390"
                                    src="{{Helpers::GetVideoPlayerLinkChange($single->data->dynamic->video)}}"
                                    frameborder="0"></iframe>

                        @endif




                    </div>
                    <!-- service details left area end -->

                </div>
                <!--rts blog wizered area -->
                
                
                 <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">




                        <!-- single wizered start -->
                        <div class="rts-single-wized Categories service">
                            <div class="wized-header">
                                <h6 class="title">
                                    {{$translate->function_categories}}
                                </h6>
                            </div>
                            <div class="wized-body">

                                @foreach($ladders->urun_ozellik_gruplari as $key => $kategori)
                                    <ul class="single-categories">
                                        <li><a href="/{{$lang}}/{{$single->component->slug}}/{{$kategori->slug}}">{{$kategori->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                    </ul>

                                    @if(isset($kategori->children))
                                        @foreach($kategori->children as $key => $subdata)
                                            <ul style="margin-left: 20px;" class="single-categories">
                                                <li style="margin-top: -9px;"><a style="line-height: 9px;" href="/{{$lang}}/{{$single->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} </a></li>
                                            </ul>
                                        @endforeach
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <!-- single wizered End -->


               </div>
                    <!-- rts- blog wizered end area -->

            </div>
        </div>
    </div>
    <!-- End service details area -->




@endsection
@section('customModuleContent')
    
    <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />
    <script type='text/javascript' src='/assets/unitegallery/themes/slider/ug-theme-slider.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery").unitegallery({
                gallery_theme: "slider",
                slider_scale_mode: "fit",
                gallery_mousewheel_role: "none"
            });
        });



    </script>
@endsection
