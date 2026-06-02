@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif

@section('meta')
    @if(!empty($multiple->ladder->seo->title))
        <title>{{$multiple->ladder->seo->title}}</title>
    @else
        <title>{{$multiple->ladder->name}} | {{$multiple->component->seo->title}}</title>
    @endif
    
    @if(!empty($multiple->ladder->seo->desc))
<meta name="description" content="{{$multiple->ladder->seo->desc}}">
    @else
<meta name="description" content="{{$multiple->component->seo->desc}}">
    @endif
<meta property="og:url"  content="{{url('/')}}/{{$lang}}/{{$multiple->component->slug}}" />
<meta property="og:type" content="article" />
@if(!empty($multiple->ladder->seo->title))
        <meta property="og:title"  content="{{$multiple->ladder->seo->title}}" />
    @else
    <meta property="og:title"  content="{{$multiple->ladder->name}} | {{$multiple->component->seo->title}}" />
    @endif
<meta property="og:description" content="{{$multiple->component->seo->desc}}" />
<meta property="og:image"  content="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" />


    
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
        "name": "{{$multiple->component->seo->title}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$multiple->component->slug}}"
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "{{$multiple->ladder->name}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$multiple->component->slug}}/{{$multiple->ladder->slug}}"
      }]
    }
    </script>
    <!-- BreadcrumbList shema -->
    <!-- BreadcrumbList shema -->
    
    
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
                        <a href="/{{$lang}}">{{$translate->anasayfa}}</a>
                        <span> / </span> 
                        &nbsp;<a href="/{{$lang}}/{{$multiple->component->slug}}">{{$multiple->component->seo->title}}</a>
                        <span> / </span>
                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$multiple->ladder->slug}}" class="active">{{$multiple->ladder->name}}</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">


            <div class="show-only-mobile" style="z-index: 1;">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onchange="window.location.href = window.location.origin+this.value;">
                    <option data-display="{{$translate->kategori_seciniz}}" value=""> {{$translate->kategori_seciniz}}</option>
                    @foreach ($ladders->urun_kategorileri as $key => $value)
                        <option data-display="{{$value->name}}" value="/{{$lang}}/{{$component_slug}}/{{$value->slug}}"> {{$value->name}}</option>
                         @if(isset($value->children))
                                    @foreach($value->children as $key => $subdata)
                                    <option data-display="{{$translate->seciniz}}" value="/{{$lang}}/{{$component_slug}}/{{$subdata->slug}}"> - {{$subdata->name}}</option>
                                    @endforeach
                         @endif
                    @endforeach
                </select>

                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onchange="window.location.href = window.location.origin+this.value;">
                    <option data-display="{{$translate->tip_seciniz}}" value=""> {{$translate->tip_seciniz}}</option>
                    @foreach ($ladders->types as $key => $value)
                        <option data-display="{{$value->name}}" value="/{{$lang}}/{{$component_slug}}/{{$value->slug}}"> {{$value->name}}</option>
                        @if(isset($value->children))
                            @foreach($value->children as $key => $subdata)
                                <option data-display="{{$translate->tip_seciniz}}" value="/{{$lang}}/{{$component_slug}}/{{$subdata->slug}}"> - {{$subdata->name}}</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>


            <div class="row g-5">

                <div class="col-xl-3 col-md-12 col-sm-12 col-12 show-only-desktop">

                    <!-- single wized start -->
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h5 class="title">
                                {{$translate->kategoriler}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach($ladders->urun_kategorileri as $key => $data)
                                <!-- single categoris -->

                                <ul class="single-categories" >
                                    <li><a style="background-color: {{$data->icon}}" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">{{$data->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                                @if(isset($data->children))
                                    @foreach($data->children as $key => $subdata)
                                        <ul style="margin-left: 20px;" class="single-categories">
                                            <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>

                                        @if(isset($subdata->children))
                                            @foreach($subdata->children as $key => $third_level)
                                                <ul style="margin-left: 40px;" class="single-categories">
                                                    <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$third_level->slug}}"> {{$third_level->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                                </ul>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif


                                <!-- single categoris End -->
                            @endforeach
                        </div>

                        <div class="wized-header mt--40">
                            <h5 class="title">
                                {{$translate->types}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach($ladders->types as $key => $data)
                                <!-- single categoris -->

                                <ul class="single-categories" >
                                    <li><a style="background-color: {{$data->icon}}" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">{{$data->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                                @if(isset($data->children))
                                    @foreach($data->children as $key => $subdata)
                                        <ul style="margin-left: 20px;" class="single-categories">
                                            <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>

                                        @if(isset($subdata->children))
                                            @foreach($subdata->children as $key => $third_level)
                                                <ul style="margin-left: 40px;" class="single-categories">
                                                    <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$third_level->slug}}"> {{$third_level->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                                </ul>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif


                                <!-- single categoris End -->
                            @endforeach
                        </div>

                        <div class="wized-header mt--40">
                            <h5 class="title">
                                {{$translate->industries}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach($ladders->sektor_kategorileri as $key => $data)
                                <!-- single categoris -->

                                <ul class="single-categories" >
                                    <li><a style="background-color: {{$data->icon}}" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">{{$data->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                                @if(isset($data->children))
                                    @foreach($data->children as $key => $subdata)
                                        <ul style="margin-left: 20px;" class="single-categories">
                                            <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>

                                        @if(isset($subdata->children))
                                            @foreach($subdata->children as $key => $third_level)
                                                <ul style="margin-left: 40px;" class="single-categories">
                                                    <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$third_level->slug}}"> {{$third_level->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                                </ul>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif


                                <!-- single categoris End -->
                            @endforeach
                        </div>
                    </div>
                    <!-- single wizered End -->
                    <!-- single wizered start -->

                </div>

                <div class="col-xl-9 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">
 
                        @foreach ($multiple->data as $key => $value)
                        @if($value->dynamic->durum == 'Aktif')
                        
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <!-- start blog grid inner -->
                                <div class="blog-grid-inner">
                                    <div class="blog-header">
                                        <a class="thumbnail" href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}">
                                            <img src="{{Helpers::CacheImageLink($value->dynamic->liste_resmi,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$value->dynamic->baslik}}">
                                        </a>

                                    </div>
                                    <div class="blog-body">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}">
                                            <h5 class="title">
                                                {{$value->dynamic->baslik}}
                                            </h5>
                                        </a>
                                        <p class="disc">
                                            {{$value->dynamic->spot_baslik}}
                                        </p>
                                    </div>
                                </div>
                                <!-- end blog grid inner -->
                            </div>
                            @endif
                        @endforeach

                    </div>
                    <!-- pagination area 
                    <div class="row mt--30">
                        <div class="col-12">
                            <div class="text-center">
                                <div class="pagination">
                                    @foreach($multiple->links as $order => $links)
                                        @if($order == 0)
                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$slug) !!}"><i class="fal fa-angle-double-left"></i></a>
                                        @elseif($order == ($multiple->last_page + 1))
                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$slug) !!}"><i class="fal fa-angle-double-right"></i></a>
                                        @else

                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$slug) !!}" @if($links->active == 1) class="active" @endif>
                                                {{$links->label}}
                                            </a>

                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pagination area End -->
                </div>
                <!--rts blog wized area -->

                 
                @if($multiple->current_page <= 1)
                    @php
                        $where = [];
                       // $where[]      = 'selected_category,=,'.$multiple->ladder->uuid;
                        $category_details = Connections::DataGetAll("5f1d5498-ccda-4401-b063-f860b6ebc2d6",$lang,$where,null,null,null,50,1);
                    @endphp
                <div class="rts-project-details-area ">
                    <div class="container">
                        @foreach($category_details->data as $kategori_detay)

                        @if (strstr($kategori_detay->dynamic->selected_category, $multiple->ladder->uuid))
                        <div class="row mt--70 mb--50">
                            <div class="col-12">
                                <div class="product-details-main-inner">
                                    <span>{{$kategori_detay->dynamic->baslik}}</span>
                                    
                                    <p class="disc">{!! $kategori_detay->dynamic->detay !!}</p>
                                    
                                </div>
                            </div>
                        </div>

                            @php $cat_sss = $kategori_detay->dynamic->sss; @endphp
                            @endif
                        @endforeach
                        
                    </div>
                </div>
                 @endif




                <!-- sss -->
                <!-- sss -->
                @if(!empty($cat_sss))

                    <div class="accordion-one-inner">
                        <div class="accordion" id="accordionExample2">


                            @php
                                // Veriyi diziye dönüştürme
                                $items = explode('***', $cat_sss); // '***' ile parçala
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


    </div>
    <!-- rts blog grid area end -->




        <!-- sss shema -->
        <!-- sss shema -->
        @if(!empty($cat_sss))


            <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        @php
                    $items = explode('***', $cat_sss); // '***' ile parçala
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

@endsection

