@extends('theme.master')


@section('meta')
    <title>@if (empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->baslik}} @else {{$single->data->dynamic->meta_title}} @endif | {{$single->component->seo->title}}</title>

    <meta name="description" content="{{$single->data->dynamic->meta_description}}">
   
   
   
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
 
@endsection

@section('social')



@endsection

@section('content')



    @include('theme.partials.single.breadcrumb', ['masters'=>$masters, 'single'=>$single])

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">


                



                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">
 

                        @if(!empty($single->data->dynamic->resim))
                            <!-- slider -->
                            <!-- slider -->
                            <div id="gallery" style="display:none;" class="mb--30">

                                @foreach(Helpers::CacheImageList($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp')) as $image)


                                    <img alt="{{$single->data->dynamic->baslik}}"
                                         src="{{$image}}"
                                         data-image="{{$image}}"
                                         data-description="{{$single->data->dynamic->baslik}}">

                                @endforeach

                            </div>
                            <!-- slider -->
                            <!-- slider -->
                        @endif


                         @if(!empty($single->data->dynamic->header_resim))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}}">
                        </div>
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
