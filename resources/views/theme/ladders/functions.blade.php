@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')

    <title>{{$multiple->ladder->name}} | {{$multiple->component->seo->title}}  </title>
    
    <meta name="description" content="{{$multiple->ladder->seo->desc}} ">

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
            <div class="row g-5">



                @if (count($ladders->urun_ozellik_gruplari) > 1 )
                    <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">




                        <!-- single wizered start -->
                        <div class="rts-single-wized Categories service">
                            <div class="wized-header">
                                <h5 class="title">
                                    {{$translate->kategoriler}}
                                </h5>
                            </div>
                            <div class="wized-body">

                                @foreach($ladders->urun_ozellik_gruplari as $key => $kategori)
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


                <div class="@if (count($ladders->urun_ozellik_gruplari) > 1 )col-xl-9  @else col-xl-12 @endif col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">


                        @foreach ($multiple->data as $key => $data)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <!-- start blog grid inner -->
                                <div class="blog-grid-inner">
                                    <div class="blog-header">
                                        <a class="thumbnail" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                            <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                        </a>

                                    </div>
                                    <div class="blog-body">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                            <h6 class="title">
                                                {{$data->dynamic->baslik}}
                                            </h6>
                                        </a>
                                    </div>
                                </div>
                                <!-- end blog grid inner -->
                            </div>
                        @endforeach



                    </div>
                    <!-- pagination area -->

                    <!-- pagination area End -->
                </div>


            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->





@endsection

