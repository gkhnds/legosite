@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->ladder->name.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->ladder->name)
@endif

@section('meta')
    <title>{{$multiple->ladder->name}} {{$multiple->component->seo->title}}</title>
    <meta name="description" content="{{$multiple->ladder->name}} {{$multiple->component->seo->desc}}">

    <!-- Creaati Seo Tools -->

    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "{{$multiple->component->seo->title}}",
        "item": "/{{$lang}}"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "{{$multiple->component->seo->title}}",
        "item": "/{{$lang}}/{{$multiple->component->slug}}"
      }

        ]
    }
    </script>
@endsection


@section('content')

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area bg_image " style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">{{$multiple->ladder->name}}</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="/{{$lang}}/{{$multiple->component->slug}}" class="active">{{$multiple->component->seo->title}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">


                @if (count($ladders->resim_kategorileri) > 1 )
                    <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">

                        <!-- single wizered start -->
                        <div class="rts-single-wized Categories service">
                            <div class="wized-header">
                                <h5 class="title">
                                    {{$translate->kategoriler}}
                                </h5>
                            </div>
                            <div class="wized-body">

                                @foreach($ladders->resim_kategorileri as $key => $kategori)
                                    <ul class="single-categories">
                                        <li><a href="/{{$lang}}/{{$multiple->component->slug}}/{{$kategori->slug}}">{{$kategori->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                    </ul>

                                    @if(isset($kategori->children))
                                        @foreach($kategori->children as $key => $subdata)
                                            <ul style="margin-left: 20px;" class="single-categories">
                                                <li style="margin-top: -9px;"><a style="line-height: 9px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} </a></li>
                                            </ul>
                                        @endforeach
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <!-- single wizered End -->

                    </div>
                    <!-- rts- blog wizered end area -->

                @endif

                <div class="@if (count($ladders->resim_kategorileri) > 1 )col-xl-9  @else col-xl-12 @endif col-md-12 col-sm-12 col-12">
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">

                        <!-- PhotoSwipe Gallery Grid -->
                        <div class="pswp-gallery row" id="gallery">
                            @foreach ($multiple->data as $key => $data)
                                @php $img = explode(',', $data->dynamic->resim) @endphp
                                @foreach($img as $k => $i)
                                    @php
                                        $fullImage = Helpers::CacheImageLink($i, array('ThumbsMode' => false, 'Mime' => 'webp'));
                                        $thumbImage = Helpers::CacheImageLink($i, array('ThumbsMode' => false, 'Mime' => 'webp', 'Resize' => array('Width' => 400, 'Height' => 400)));
                                    @endphp
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                        <a href="{{$fullImage}}" 
                                           data-pswp-width="1200" 
                                           data-pswp-height="800"
                                           target="_blank"
                                           class="gallery-item">
                                            <img src="{{$thumbImage}}" 
                                                 alt="{{$data->dynamic->baslik}}" 
                                                 class="img-fluid rounded"
                                                 style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s ease;">
                                            @if(isset($masters->anasayfa_duzenle->data->dynamic->galeri_resim_baslik) && $masters->anasayfa_duzenle->data->dynamic->galeri_resim_baslik == 'Aktif')
                                                <div class="gallery-caption">
                                                    {{$data->dynamic->baslik}}
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                    </div>
                    <!-- service details left area end -->

                </div>


            </div>
        </div>
    </div>
    <!-- End service details area -->

@endsection

@section('customModuleContent')
    <!-- PhotoSwipe CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe.min.css">

    <!-- PhotoSwipe JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/umd/photoswipe-lightbox.umd.min.js"></script>

    <style>
        .gallery-item {
            display: block;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .gallery-item img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 15px 10px 10px;
            font-size: 14px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-caption {
            opacity: 1;
        }

        .pswp-gallery {
            margin: 0 -15px;
        }

        @media (max-width: 768px) {
            .gallery-item img {
                height: 200px !important;
            }
        }

        @media (max-width: 576px) {
            .gallery-item img {
                height: 150px !important;
            }
        }
    </style>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // PhotoSwipe Lightbox başlat
            const lightbox = new PhotoSwipeLightbox({
                gallery: '#gallery',
                children: 'a',
                pswpModule: PhotoSwipe,
                
                // Ayarlar
                bgOpacity: 0.9,
                spacing: 0.1,
                allowPanToNext: true,
                loop: true,
                
                // Zoom ayarları
                zoom: true,
                maxZoomLevel: 3,
                
                // UI ayarları
                showHideAnimationType: 'fade',
                
                // Paylaşım butonları (isteğe bağlı)
                shareEl: true,
                fullscreenEl: true,
                zoomEl: true,
                counterEl: true,
                arrowEl: true,
                
                // Türkçe metinler
                errorMsg: 'Resim yüklenemedi',
                closeTitle: 'Kapat (Esc)',
                zoomTitle: 'Yakınlaştır',
                arrowPrevTitle: 'Önceki',
                arrowNextTitle: 'Sonraki',
            });

            lightbox.init();
        });
    </script>
@endsection