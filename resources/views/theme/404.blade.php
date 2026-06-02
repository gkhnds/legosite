@extends('theme.master')


@section('meta')
    <title>{{$translate->error_page_title}}</title>
    <meta name="description" content="{{$translate->error_page_desc}}">
@endsection

@section('content')
    <div class="rts-breadcrumb-area bg_image pt--100" style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">
            <div class="row align-items-center">
             
                
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">404</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <div class="row g-5">



                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">


                        <h2>{{$translate->error_page_title}}</h2>
                        <p>{{$translate->error_page_desc}}</p>
                        <a href="/{{$lang}}" class="theme-btn style-one">{{$translate->error_page_button}}</a>






                    </div>

                </div>
                <!--rts blog wized area -->

            </div>
        </div>
    </div>
@endsection
