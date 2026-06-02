@extends('theme.master')


@section('meta')
    <title>@if (empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->baslik}} @else {{$single->data->dynamic->meta_title}} @endif {{$masters->seo->data->dynamic->keyword1}}</title>

    <meta name="description" content="{{$single->data->dynamic->meta_description}}">

    @include('theme.partials.single.seoLink-schema-and-meta', ['lang'=>$lang, 'single'=>$single, 'masters'=>$masters])
    
    <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />
<script type='text/javascript' src='/assets/unitegallery/themes/tiles/ug-theme-tiles.js'></script>
      <!-- Product Shema -->
   <!-- Product Shema -->


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{$single->data->dynamic->baslik}}",
   
  "description": "{{$single->data->dynamic->meta_description}}",
  @if(!empty($single->data->dynamic->resim))
  @php $selectResimData = explode(',', $single->data->dynamic->resim) @endphp
  @php $resim_key = 0; @endphp
  "image": [
      @foreach($selectResimData as $ky => $value)
        @if ($resim_key > 0), @endif
    "https://{{$_SERVER['SERVER_NAME']}}{{Helpers::CacheImageLink($value,array('ThumbsMode' => false, 'Mime' => 'webp'))}}"
    @php $resim_key++; @endphp
    @endforeach
  ],
  @endif
  "brand": {
        "@type": "Brand",
        "name": "{{$masters->iletisim->data->dynamic->baslik}}"
      },
       "sku": "{{$single->data->static->uuid}}",
      "mpn": "{{$single->data->static->uuid}}",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "97",
    "reviewCount": "97"
  },
  
  
  "review": [
            {
              "@type": "Review",
               "author": {
        "@type": "Person",
        "name": "Creaati",
        "url": "https://creaati.com"
      },
              "datePublished": "2024-12-10T22:15:06+03:00",
			  "dateModified": "{{date('Y-m-d H:i:s')}}",
              "reviewRating": {
				"@type": "Rating",
				"bestRating": "5",
				"ratingValue": "5",
				"worstRating": "1"
			   }			  
            }
          ]	
}
</script>
    <!-- Product Shema -->
    <!-- Product Shema -->
    
    
     <!-- sss shema -->
    <!-- sss shema -->
  @if(!empty($single->data->dynamic->sss))


  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        @php
          $items = explode('***', $single->data->dynamic->sss); // '***' ile parçala
          $key = 0;
        @endphp
        @foreach($items as $item)
            @php
                // ':::' ile başlık ve detayı ayır
                $parts = explode(':::', $item);
                $baslik = $parts[0] ?? ''; // Başlık
                $detay = $parts[1] ?? ''; // Detay
            @endphp
    
            @if(!empty($baslik) && !empty($detay))
              @if ($key > 0), @endif
              {
                "@type": "Question",
                "name": "{{ $baslik }}",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "{{ $detay }}"
                }
              }
              @php $key++; @endphp
            @endif
        @endforeach
      ]
    }
    </script>

    @endif
    <!-- sss shema -->
    <!-- sss shema -->
    
    <style>
#lightbox-modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
#lightbox-modal img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
}
#lightbox-close {
    position: absolute;
    top: 20px; right: 30px;
    color: white;
    font-size: 2rem;
    cursor: pointer;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('lightbox-modal');
    const modalImg = document.getElementById('lightbox-img');
    const closeBtn = document.getElementById('lightbox-close');

    document.querySelectorAll('.lightbox-trigger').forEach(el => {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const imgSrc = this.getAttribute('data-image');
            modalImg.src = imgSrc;
            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
        modalImg.src = '';
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            modalImg.src = '';
        }
    });
});
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
                <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                    <!-- detay -->
                    <div class="service-detials-step-1">

                        @if(!empty($single->data->dynamic->resim))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}}">
                        </div>
                        @endif
                        
                        
                         


                        <p class="disc">
                            @if(!empty($single->data->dynamic->detay))

                                @php $makale = str_replace('**kelime**',$single->data->dynamic->baslik, $single->data->dynamic->detay); @endphp

                                {!! $makale !!}

                            @else
                                @php $makale = str_replace('**kelime**',$single->data->dynamic->baslik, $masters->seo->data->dynamic->makale); @endphp
                                {!! $makale !!}
                            @endif


                        </p>

                        @if(!empty($single->data->dynamic->video))
                            <hr>
                            <iframe id="player" type="text/html" width="640" height="390"
                                    src="{{Helpers::GetVideoPlayerLinkChange($single->data->dynamic->video)}}"
                                    frameborder="0"></iframe>

                        @endif




                    </div>
                    <!-- detay -->
                    
                    
                    @if(!empty($single->data->dynamic->resim))
    
                    <!-- Galeri -->
                     <!-- Galeri -->
    
                            <div class="title-area-style-six text-start">
                            <div class="pre-title">
                                
                                
                               
                            </div>
                            <hr>
                        </div>
                        <div id="gallery" >
 
                        @php $selectData = explode(',', $single->data->dynamic->resim) @endphp

                        @foreach($selectData as $ky => $value)
@if($ky > 0)
                            <a href="#" class="lightbox-trigger" data-image="{{ Helpers::CacheImageLink($value, ['ThumbsMode' => false, 'Mime' => 'webp']) }}">
    <img 
        alt="{{ $single->data->dynamic->baslik }} sample {{ $ky }}"
        src="{{ Helpers::CacheImageLink($value, ['ThumbsMode' => true, 'Mime' => 'webp']) }}"
        loading="lazy"
        width="200"
        height="auto"
    >
</a>
<amp-img alt="{{ $single->data->dynamic->baslik }}" 
         src="{{ Helpers::CacheImageLink($value, ['ThumbsMode' => false, 'Mime' => 'webp']) }}" 
         layout="responsive" 
         width="300" height="200">
</amp-img>
@endif
                        @endforeach


                    </div>
                     <!-- Galeri -->
                      <!-- Galeri -->
                     
@endif
 <div id="lightbox-modal" style="display:none;">
    <span id="lightbox-close">&#10006;</span>
    <img id="lightbox-img" alt="Expanded image">
</div>

                    <!-- ilgili linkler -->
                    <div class="blog-single-post-listing details mb--0">

                        <div class="blog-listing-content">

                            <div class="row  align-items-center">
                                <div class="col-lg-12 col-md-12">
                                    <!-- tags details -->
                                    <div class="details-tag">
                                        <a type="button" href="https://www.facebook.com/sharer/sharer.php?u=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}" value="facebook" target="_blank" class="button">Facebook</a>
                                        <a type="button" href="https://twitter.com/intent/tweet?url=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&text={{$single->data->dynamic->baslik}}" value="twitter" target="_blank" class="button">Twitter</a>
                                        <a type="button" href="http://www.tumblr.com/share?v=3&u=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&t={{$single->data->dynamic->baslik}}" value="tumblr" target="_blank" class="button">Tumblr</a>
                                        <a type="button" href="http://www.linkedin.com/shareArticle?mini=true&url=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&title={{$single->data->dynamic->baslik}}" value="linkedin" target="_blank" class="button">Linkedin</a>
                                        @if(!empty($single->data->dynamic->resim))
                                            <a type="button" href="http://pinterest.com/pin/create/button/?url=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&media={{Helpers::NoCacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}&description={{$single->data->dynamic->baslik}}" value="pinterest" target="_blank" class="button">Pinterest</a>
                                        @else
                                            <a type="button" href="http://pinterest.com/pin/create/button/?url=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&media={{Helpers::NoCacheImageLink($masters->seo->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}&description={{$single->data->dynamic->baslik}}" value="pinterest" target="_blank" class="button">Pinterest</a>
                                        @endif



                                    </div>
                                    <!-- tags details End -->
                                </div>

                            </div>



                        </div>
                    </div>
                    <!-- ilgili linkler -->
                    
                    
                     <!-- sss -->
                            <!-- sss -->
                            @if(!empty($single->data->dynamic->sss))
                                <div class="title-area-style-six text-start mt--50">
                                    <div class="pre-title">

                                        <span class="pre">{{$translate->sss}}</span>

                                    </div>
                                    <hr>
                                </div>
                                <div class="accordion-one-inner">
                                    <div class="accordion" id="accordionExample2">


                                        @php
                                            // Veriyi diziye dönüştürme
                                            $items = explode('***', $single->data->dynamic->sss); // '***' ile parçala
                                        @endphp

                                        @foreach($items as $key => $item)
                                            @php
                                                // ':::' ile başlık ve detayı ayır
                                                $parts = explode(':::', $item);
                                                $baslik = $parts[0] ?? ''; // Başlık
                                                $detay = $parts[1] ?? ''; // Detay
                                            @endphp

                                            @if(!empty($baslik) && !empty($detay))
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading{{$key}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                                            {{ $baslik }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample2" style="">
                                                        <div class="accordion-body">
                                                            {!! $detay !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            @endif
                            <!-- sss -->
                            <!-- sss -->

                </div>

                <div class="col-xl-4 col-md-12 col-sm-12 col-12 mt_lg--60">
                    @if(!empty($single->data->dynamic->keywords))
                    <!-- KEYWORDS -->
                    <div class="rts-single-wized">
                        <div class="wized-header">
                            <h6 class="title">
                                {{$translate->etiketler}}
                            </h6>
                        </div>
                        <div class="wized-body">
                            <div class="tags-wrapper">
                                @php $tags = $single->data->dynamic->keywords; $tags = explode(';',$tags); @endphp
                                @if(!empty($tags))
                                    @foreach($tags as $tag)
                                        <a href="/{{$lang}}/search/{{$tag}}/1" target="new" title="{{$tag}}">{{$tag}}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- KEYWORDS -->
                    @endif




                    <!-- single wized End -->
                    <!-- single wized start -->
                    <div class="rts-single-wized contact">
                        <div class="wized-header">
                            <a href="#"><img src="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo_beyaz,array('ThumbsMode' => false,'Mime' => 'webp'))}}" alt="{{$masters->seo->data->dynamic->keyword1}}"></a>
                        </div>
                        <div class="wized-body">
                            <h5 class="title"><a href="tel:{{$masters->iletisim->data->dynamic->telefon}}">{{$masters->iletisim->data->dynamic->telefon}}</a></h5>
                            <a class="rts-btn btn-primary" href="mailto:{{$masters->iletisim->data->dynamic->email}}">{{$masters->iletisim->data->dynamic->email}}</a>

                        </div>
                    </div>
                    <!-- single wized End -->
                </div>
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>
    <!-- End service details area -->




@endsection
@section('customModuleContent')
<script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
   
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />
<script type='text/javascript' src='/assets/unitegallery/themes/tiles/ug-theme-tiles.js'></script>

 <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery").unitegallery({
                gallery_theme: "tiles",
                tiles_type: "nested",
                @if($masters->anasayfa_duzenle->data->dynamic->galeri_resim_baslik == 'Aktif')
                tile_enable_textpanel:true,
                tile_textpanel_title_text_align: "center",
                tile_textpanel_always_on:true,
                
                @endif
            });


        });



    </script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
