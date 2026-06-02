
<meta property="og:url"  content="{{url('/')}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}" />
<meta property="og:type" content="article" />
<meta property="og:title"  content="{{$single->data->dynamic->baslik}}" />
<meta property="og:description" content="{{$single->component->seo->desc}}" />
@if(!empty($single->data->dynamic->resim))
    <meta property="og:image"  content="{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" />
    <meta name="twitter:image" content="{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}">
@else
    <meta property="og:image"  content="{{Helpers::CacheImageLink($masters->seo->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" />
    <meta name="twitter:image" content="{{Helpers::CacheImageLink($masters->seo->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}">
@endif




<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{'@'.url('/')}}">
<meta name="twitter:title" content="{{$single->data->dynamic->baslik}}">
<meta name="twitter:url" content="{{url('/')}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}">
<meta name="twitter:description" content="{{$single->component->seo->desc}}">

<!-- Creaati SEO TOOLS -->
<!-- Creaati SEO TOOLS -->





@if (!empty($single->data->dynamic->schema))
    
        {!! str_replace('&quot;','"',$single->data->dynamic->schema)  !!}
    
@else
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{url('/')}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}"
  },
  "headline": "{{$single->data->dynamic->baslik}}",
  @if(!empty($single->data->dynamic->meta_description))
  "description": "{{$single->data->dynamic->meta_description}}",
  @else
  "description": "{{$single->data->dynamic->baslik}}",
  @endif
  @if(!empty($single->data->dynamic->resim))
  "image": "{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
  @else
  "image": "{{Helpers::CacheImageLink($masters->seo->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
  @endif
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


    <!-- review -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "AggregateRating",
      "itemReviewed": {
        "@type": "ProfessionalService",
        "image": "{{Helpers::CacheImageLink($masters->seo->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
        "name": "{{$masters->seo->data->dynamic->review}}",
        "servesCuisine": "{{$single->data->dynamic->baslik}}",
        "telephone": "{{$masters->iletisim->data->dynamic->telefon}}",
        "address" : {
          "@type": "PostalAddress",
         "streetAddress": "{{$masters->seo->data->dynamic->streetAddress}}",
         "addressLocality": "{{$masters->seo->data->dynamic->addressLocality}}",
          "addressRegion": "{{$masters->seo->data->dynamic->addressLocality}}",
          "postalCode": "{{$masters->seo->data->dynamic->postalCode}}",
          "addressCountry": "TR"
        }
      },
      "ratingValue": "100",
      "bestRating": "100",
      "ratingCount": "20"
    }
    </script>
    <!-- review -->


    <!-- video shema -->
    @if(!empty($single->data->dynamic->video))
        <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "VideoObject",
      "name": "{{$single->data->dynamic->baslik}}",
      "description": "{{$single->data->dynamic->baslik}}",
      "thumbnailUrl": [
        "{{Helpers::GetVideoThumbnail($single->data->dynamic->video)}}"
       ],
      "uploadDate": "{{$single->data->static->created_at}}",
      "duration": "PT1M54S",
      "contentUrl": "{{$single->data->dynamic->video}}",
      "embedUrl": "{{Helpers::GetVideoPlayerLinkChange($single->data->dynamic->video)}}",
      "interactionStatistic": {
        "@type": "InteractionCounter",
        "interactionType": { "@type": "WatchAction" },
        "userInteractionCount": 5647018
      },
      "regionsAllowed": "US,NL"
    }
    </script>
    @endif
    <!-- video shema -->


    <!-- shema.org image object -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ImageObject",
      "author": "{{$masters->iletisim->data->dynamic->baslik}}",
      "contentLocation": "{{$masters->seo->data->dynamic->streetAddress}} {{$masters->seo->data->dynamic->addressLocality}} ",
      @if(!empty($single->data->dynamic->resim))
            "contentUrl": "{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
     @else
            "contentUrl": "{{Helpers::CacheImageLink($masters->seo->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}",
      @endif
      "datePublished": "{{$single->data->static->created_at}}",
      "description": "{{$single->data->dynamic->baslik}}",
      "name": "{{$single->data->dynamic->baslik}}"
    }
    </script>
    <!-- shema.org image object -->


@endif
<!-- Creaati Seo Tools PRODUCT -->
