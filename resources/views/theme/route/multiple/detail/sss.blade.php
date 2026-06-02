@extends('theme.master')


@section('meta')
    <title>@if (empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->baslik}} - {{$single->component->seo->title}} @else {{$single->data->dynamic->meta_title}} - {{$single->component->seo->title}} @endif</title>

    <meta name="description" content="@if (empty($single->data->dynamic->meta_description)) {{$single->data->dynamic->meta_description}} @else {{$single->data->dynamic->meta_title}} @endif">

    <!-- Creaati SEO TOOLS -->
        @if (!empty($single->data->dynamic->schema))
            <script type="application/ld+json">
                {!! str_replace('&quot;','"',$single->data->dynamic->schema)  !!}
            </script>
        @else
            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [{
                    "@type": "Question",
                    "name": "{{$single->data->dynamic->baslik}}",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "{{strip_tags($single->data->dynamic->detay)}}"
                    }
                    }]
                      }
            </script>
        @endif
        <!-- Creaati Seo Tools FAQ -->

@endsection
@section('content')

    @include('theme.partials.single.breadcrumb', ['masters'=>$masters, 'single'=>$single])

    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    @if(!empty($single->data->dynamic->resim))

                        <section class="banner-section">
                            <div class="banner-carousel owl-theme owl-carousel dots-style-one">
                                @foreach(Helpers::CacheImageList($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp')) as $image)
                                    <div class="slide-item">
                                        <div class="image-layer" style="background-image:url({{$image}})"></div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <div class="service-details-content">
                        <div class="content-one">
                            <div class="text">
                                
                              
                                {!! $single->data->dynamic->detay !!}
                            </div>
                        </div>

                        @if(!empty($single->data->dynamic->video))
                            <hr>
                            <section class="video-section">
                                <div class="inner-container">
                                    <div class="video-inner" style="background-image: url({{Helpers::GetVideoThumbnail($single->data->dynamic->video)}});">
                                        <div class="video-btn">
                                            <a href="{{$single->data->dynamic->video}}" class="lightbox-image" data-caption="">
                                                <i class="fas fa-play"></i>
                                                <span class="border-animation border-1"></span>
                                                <span class="border-animation border-2"></span>
                                                <span class="border-animation border-3"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        @endif


                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12  sidebar-side">
                    @include('theme.partials.single.sidebar', ['single'=>$single, 'lang'=>$lang])
                </div>
            </div>
        </div>
    </section>
@endsection
