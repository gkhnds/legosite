<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    

    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>
    
    {!! $masters->site_ayarlari->data->dynamic->tagmanager_head !!}
    
    @if (!empty($masters->site_ayarlari->data->dynamic->pixel))
    {!! $masters->site_ayarlari->data->dynamic->pixel !!}
    @endif

    @if (!empty($masters->site_ayarlari->data->dynamic->yandex))
        {!! $masters->site_ayarlari->data->dynamic->yandex !!}
    @endif

    @if (!empty($masters->site_ayarlari->data->dynamic->google))
        {!! $masters->site_ayarlari->data->dynamic->google !!}
    @endif

    @if (!empty($masters->site_ayarlari->data->dynamic->istatistik))
        {!! $masters->site_ayarlari->data->dynamic->istatistik !!}
    @endif
    

    <!-- hreflang Alternate -->
    <!-- hreflang Alternate -->
    <!-- hreflang Alternate -->
 @if (count((array)$languages) > 1)

        @php $singleSlug = Helpers::LanguageSlugDatas($single->data->static->slug ?? ''); @endphp
        @if(\Request::route()->getName() == 'Par2')
            <!-- single page -->
            <!-- single page -->
            @php $componentSlug = Helpers::ComponentSlugDatas($single->component->uuid ?? ''); @endphp
            @if(!empty($componentSlug))
                @foreach ($singleSlug as $key => $hreflang)
                <link rel="alternate" hreflang= @if ($key==0) "x-default" @else "{{$hreflang->lang}}" @endif href="@php echo 'https://'.$_SERVER['HTTP_HOST']; @endphp/{{$hreflang->lang}}/{{$componentSlug[$hreflang->lang]}}/{{$hreflang->slug}}" />
                @endforeach
            @endif
            <!-- single page -->
            <!-- single page -->

        @elseif(\Request::route()->getName() == 'Par1' && empty($multiple->component->uuid))
            <!-- single component -->
            <!-- single component -->
            @php $componentSlug = Helpers::ComponentSlugDatas($single->component->uuid ?? ''); @endphp
            @foreach ($singleSlug as $key => $hreflang)
                <link rel="alternate" hreflang = @if ($key==0) "x-default" @else "{{$hreflang->lang}}" @endif href="@php echo 'https://'.$_SERVER['HTTP_HOST']; @endphp/{{$hreflang->lang}}/{{$componentSlug[$hreflang->lang]}}" />
            @endforeach

            <!-- single component -->
            <!-- single component -->
        @elseif(\Request::route()->getName() == 'Search')
            @php $componentSlug = Helpers::ComponentSlugDatas($multiple[0]->component->uuid ?? ''); @endphp
        @else
            <!-- multiple component -->
            <!-- multiple component -->
            @php $componentSlug = Helpers::ComponentSlugDatas($multiple->component->uuid ?? ''); @endphp
            @if(!empty($componentSlug))
                    <!-- Ok - Ürünler -->
                    <link rel="alternate" hreflang ="x-default" href="https://{{$_SERVER['SERVER_NAME']}}/en" />
                @foreach ($languages as $key => $mylang)
                    <link rel="alternate" hreflang ="{{$mylang->short_name}}" href="@php echo 'https://'.$_SERVER['HTTP_HOST']; @endphp/{{$mylang->short_name}}/{{$componentSlug[$mylang->short_name]}}" />
                @endforeach
                    <!-- Ok - Ürünler -->
            @else
                @foreach ($languages as $key => $mylang)

                    <link rel="alternate" hreflang = @if ($key==0) "x-default" @else "{{$mylang->short_name}}" @endif href="@php echo 'https://'.$_SERVER['HTTP_HOST']; @endphp/{{$mylang->short_name}}" />

                @endforeach
            @endif
            <!-- multiple component -->
            <!-- multiple component -->
        @endif



    @endif




    <!-- hreflang Alternate -->
    <!-- hreflang Alternate -->
    <!-- hreflang Alternate -->


    <!-- CREAATI SEO FEATURES -->
    <!-- CREAATI SEO FEATURES -->
    <!-- CREAATI SEO FEATURES -->
    
    

    @if ($masters->seo->data->dynamic->durum == 'Aktif')

           <!-- search -->
            <script type="application/ld+json">
            {
              "@context": "https://schema.org/",
              "@type": "WebSite",
              "name": "{{$masters->iletisim->data->dynamic->baslik}}",
              "url": "{{url('/')}}",
              "potentialAction": {
                "@type": "SearchAction",
                
                
                
                "target": "{{url('/')}}/{{$lang}}/search/{search_term_string}/1",
                "query-input": "required name=search_term_string"
              }
            }
            </script>
            <!-- search -->
 
            <!-- local bussiness -->
            <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "ProfessionalService",
              "name": "{{$masters->iletisim->data->dynamic->baslik}}",
              "image": "{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
              "@id": "",
              "url": "@php echo 'https://'.$_SERVER['SERVER_NAME']; @endphp",
              "telephone": "{{$masters->iletisim->data->dynamic->telefon}}",
              "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{$masters->seo->data->dynamic->streetAddress}}",
                "addressLocality": "{{$masters->seo->data->dynamic->addressLocality}}",
                "postalCode": "{{$masters->seo->data->dynamic->postalCode}}",
                "addressCountry": "TR"
              },
              "geo": {
                "@type": "GeoCoordinates",
                "latitude": {{$masters->seo->data->dynamic->latitude}},
                "longitude": {{$masters->seo->data->dynamic->longitude}}
                    },
                    "openingHoursSpecification": {
                      "@type": "OpeningHoursSpecification",
                      "dayOfWeek": [
                          "Monday",
                          "Tuesday",
                          "Wednesday",
                          "Thursday",
                          "Friday",
                          "Saturday"
                        ],
                      "opens": "{{$masters->seo->data->dynamic->opens}}",
                "closes": "{{$masters->seo->data->dynamic->closes}}"
              },
              "sameAs": "{{$masters->seo->data->dynamic->sameAs}}"
            }
            </script>
            <!-- local bussiness -->
 
            <!-- Logo -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "{{$masters->iletisim->data->dynamic->baslik}}",
          "alternateName": "{{$masters->seo->data->dynamic->keyword1}}",
          "url": "https://{{$_SERVER['SERVER_NAME']}}",
          "logo": "{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false,'Mime' => 'webp'))}}",
          "sameAs": [
            "{{$masters->seo->data->dynamic->sameAs}}"
          ]
        }
        </script>
            <!-- Logo -->

    @endif
        <!-- CREAATI SEO FEATURES -->
        <!-- CREAATI SEO FEATURES -->
        <!-- CREAATI SEO FEATURES -->

 

    @yield('meta')
    @yield('social')
    <link rel="icon" href="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->favicon,array('ThumbsMode' => false,'Mime' => 'webp'))}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->favicon,array('ThumbsMode' => false,'Mime' => 'webp'))}}" type="image/x-icon"/>

    <!-- Creaati Theme Contents -->
    <!-- Creaati Theme Contents -->
   <!-- Google Fonts için preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Josefin Sans fontu yükle (CLS düşürür) -->
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">

<!-- Kritik CSS varsa inline eklenebilir -->

<!-- CSS dosyalarını ertelenmiş şekilde yükle -->
<link rel="stylesheet" href="/assets/css/plugins/swiper.min.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="/assets/css/plugins/fontawesome-5.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="/assets/css/plugins/animate.min.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="/assets/css/plugins/unicons.css" media="print" onload="this.media='all'">
<!-- Kritik CSS: render-blocking (FOUC önlemek için normal yükleniyor) -->
<link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="/assets/css/style.css">

<!-- Yedek: Tarayıcı desteği olmayanlar için noscript -->
<noscript>
  <link rel="stylesheet" href="/assets/css/plugins/swiper.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/fontawesome-5.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/unicons.css">
</noscript>

    <!-- Creaati Theme Contents -->
    <!-- Creaati Theme Contents -->

    <style>
        :root {
            --color-primary: {{$masters->tasarim_ayarlari->data->dynamic->color1}};
            --color-primary-2: {{$masters->tasarim_ayarlari->data->dynamic->color2}};
            --color-primary-6: {{$masters->tasarim_ayarlari->data->dynamic->color2}};
            --color-primary-3: {{$masters->tasarim_ayarlari->data->dynamic->color3}};
            --color-primary-4: {{$masters->tasarim_ayarlari->data->dynamic->color4}};
            --color-primary-5: {{$masters->tasarim_ayarlari->data->dynamic->color5}};
            --color5: {{$masters->tasarim_ayarlari->data->dynamic->color5}};
            --color6: {{$masters->tasarim_ayarlari->data->dynamic->color6}};
            --color7: {{$masters->tasarim_ayarlari->data->dynamic->color7}};
            --color8: {{$masters->tasarim_ayarlari->data->dynamic->color8}};
            --color9: {{$masters->tasarim_ayarlari->data->dynamic->color9}};
            --color10: {{$masters->tasarim_ayarlari->data->dynamic->color10}};
            --color-primary-alta : {{$masters->tasarim_ayarlari->data->dynamic->color1}};

            ---font-primary: {{$masters->tasarim_ayarlari->data->dynamic->font1}};
            --font-secondary: {{$masters->tasarim_ayarlari->data->dynamic->font2}};
            --font3: {{$masters->tasarim_ayarlari->data->dynamic->font3}};
            --font4: {{$masters->tasarim_ayarlari->data->dynamic->font4}};
            --font5: {{$masters->tasarim_ayarlari->data->dynamic->font5}};
            --font6: {{$masters->tasarim_ayarlari->data->dynamic->font6}};
            --font7: {{$masters->tasarim_ayarlari->data->dynamic->font7}};
            --font8: {{$masters->tasarim_ayarlari->data->dynamic->font8}};
            --font9: {{$masters->tasarim_ayarlari->data->dynamic->font9}};
            --font10: {{$masters->tasarim_ayarlari->data->dynamic->font10}};
        }

    </style>
    
    <!-- header online time -->
    <style>
    .working-time.green {
        color: green !important;
    }

    .working-time.red {
        color: red !important;
    }
</style>
    <!-- header online time -->

</head>

