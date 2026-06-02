<meta property="og:url"  content="{{url('/')}}/{{$lang}}/{{$multiple->component->slug}}" />
<meta property="og:type" content="article" />
<meta property="og:title"  content="{{$multiple->component->seo->title}}" />
<meta property="og:description" content="{{$multiple->component->seo->desc}}" />
<meta property="og:image"  content="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" />
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{'@'.url('/')}}">
<meta name="twitter:title" content="{{$multiple->component->seo->title}}">
<meta name="twitter:url" content="{{url('/')}}/{{$lang}}/{{$multiple->component->slug}}">
<meta name="twitter:description" content="{{$multiple->component->seo->desc}}">
<meta name="twitter:image" content="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false, 'Mime' => 'webp'))}}">
<!-- Creaati Seo BreadcrumbList -->

<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "{{$translate->anasayfa}}",
        "item": "{{url('/')}}/{{$lang}}"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "{{$multiple->component->seo->title}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$multiple->component->slug}}"
      }

        ]
    }
    </script>
<!-- Creaati Seo BreadcrumbList  -->



