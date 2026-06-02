<!-- start breadcrumb area -->
<div class="rts-breadcrumb-area bg_image " style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                <h1 class="title">{{$multiple->component->seo->title}}</h1>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="bread-tag">
                    <a href="/{{$lang}}">{{$translate->anasayfa}}</a>
                        <span> / </span> 
                    <a href="/{{$lang}}/{{$multiple->component->slug}}" class="active">{{$multiple->component->seo->title}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb area -->
