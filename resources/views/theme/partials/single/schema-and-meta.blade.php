
<meta property="og:url"  content="{{url('/')}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}" />
<meta property="og:type" content="article" />
<meta property="og:title"  content="{{$single->data->dynamic->baslik}}" />
<meta property="og:description" content="{{$single->data->dynamic->meta_description}}" />
<meta property="og:image"  content="{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" />

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{'@'.url('/')}}">
<meta name="twitter:title" content="{{$single->data->dynamic->baslik}}">
<meta name="twitter:url" content="{{url('/')}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}">
<meta name="twitter:description" content="{{$single->data->dynamic->meta_description}}">
<meta name="twitter:image" content="{{Helpers::CacheImageLink($single->data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}">
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
@endif


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
