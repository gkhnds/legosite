@extends('theme.masterLanding')



@section('meta')
    <title>@if (empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->baslik}} @else {{$single->data->dynamic->meta_title}} @endif</title>

    <meta name="description" content="{{$single->data->dynamic->baslik}} {{$single->data->dynamic->meta_description}} ">

<!-- sss shema -->
<!-- sss shema -->
    @php
        $where = [];
        //$where[]      = 'secilen_langing,=,'.$single->data->dynamic->kod;
        $sss_datas = Connections::DataGetAll("6f431d59-9dd9-4b10-8200-48b564543d51",$lang,$where,null,null,null,100,1);
    @endphp


    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        @php $key = 0; @endphp
        @foreach($sss_datas->data as  $sss_detay)
            @if($sss_detay->dynamic->landing_page_kodu == $single->data->dynamic->kod)
                @php $cevap= strip_tags($sss_detay->dynamic->detay); @endphp

            @if ($key > 0), @endif {
            "@type": "Question",
             "name": "{{$sss_detay->dynamic->baslik}}",
            "acceptedAnswer": {
              "@type": "Answer",
             "text": "{{$cevap}}"
            }
          }
          @php $key = $key+1; @endphp
           @endif
        @endforeach
        ]
      }
    </script>



    <!-- sss shema -->
    <!-- sss shema -->

@endsection

@section('social')

    @include('theme.partials.single.landingMeta', ['lang'=>$lang, 'single'=>$single, 'masters'=>$masters])

@endsection

@section('content')





    <!-- slider area -->
    <div class="rts-banner-area banner-bg-h7 pt--100" style="background-image:url({{Helpers::CacheImageLink($single->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">

            @if(!empty($single->data->dynamic->mobil_resim))
                <div class="show-only-mobile"><img src="{{Helpers::CacheImageLink($single->data->dynamic->mobil_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}">
                  <amp-img alt="{{$single->data->dynamic->baslik}}" src="{{Helpers::CacheImageLink($single->data->dynamic->mobil_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" layout="responsive" > </amp-img>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-7">
                    <!-- bannerq inner six -->
                    <div class="rts-banner-wrapper-seven">
                        <p class="pre-title"><span>{{$single->data->dynamic->ust_baslik}}</span></p>
                        <h1 class="banner-title">
                            {{$single->data->dynamic->baslik}}
                        </h1>
                        <p class="disc">
                            {{$single->data->dynamic->spot}}
                        </p>
                        <div class="button-area">
                            @if( !empty($single->data->dynamic->buton_title) )
                                <a href="{{$single->data->dynamic->buton_link}}" class="rts-btn btn-primary six mr--30">{{$single->data->dynamic->buton_title}}</a>
                            @endif


                        </div>
                    </div>
                    <!-- bannerq inner six ENd -->
                </div>



                @if($single->data->dynamic->form_durumu == 'Aktif')
                    <div class="col-xl-5">
                        <div class="rts-contact-form-area six">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rts-contact-fluid">
                                            <div class="rts-title-area contact-fluid text-center">
                                                <h2 class="title">{{$single->data->dynamic->form_title}}</h2>
                                            </div>
                                            <div class="form-wrapper">
                                                <div id="form-messages"></div>
                                                <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form SubmitForm">
                                                    <div class="name-email">
                                                        <input type="text" name="isim" placeholder="{{$translate->adiniz}}" required>
                                                        <input type="text" name="telefon" placeholder="{{$translate->telefon}}" required>
                                                    </div>
                                                    <input type="email" name="email" placeholder="{{$translate->email}}" required>

                                                    @if($single->data->dynamic->select_durum == 'Aktif')
                                                        <select name="Seçim" id="Seçim">

                                                            @php $selectData = explode(',', $single->data->dynamic->select_data) @endphp
                                                            @foreach($selectData as $ky => $value)
                                                                <option value="{{$value}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                    <textarea placeholder="{{$translate->mesaj}}" name="mesaj"></textarea>

                                                    <button class="g-recaptcha rts-btn btn-primary"  type="button" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain'  id="sbtn" name="submit-form">{{$translate->gonder}}</button>

                                                    <style>
                                                        .grecaptcha-badge{
                                                            display: none;
                                                        }
                                                    </style>
                                                    <input type="hidden" name="validate_message" value="{{$translate->form_uyari_mesaji}}">
                                                    <input type="hidden" name="accept_message" value="{{$translate->form_gonderildi}}">
                                                    <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                                                    <input type="hidden" name="mail_backup" value="1">
                                                    <input type="hidden" name="custom_form" value="1">
                                                    <input type="hidden" name="mail_view" value="addon/mail/CustomFormMail">
                                                    <input type="hidden" name="link" value="{{$masters->anasayfa_duzenle->data->dynamic->formslider_form_title}}">
                                                    <input type="hidden" name="subject" value="{{$masters->anasayfa_duzenle->data->dynamic->formslider_form_title}}">
                                                    <input type="hidden" name="process" value="SendOnlyMail">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
    <!-- slider area -->


    <!-- makale -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="row g-5 align-items-center">

                <div class="col-lg-12">
                    <div class="about-progress-inner">
                        <div class="title-area">
                            @if(!empty($single->data->dynamic->makale_ust_baslik)) <h2><span>{{$single->data->dynamic->makale_ust_baslik}}</span></h2> @endif
                            @if(!empty($single->data->dynamic->makale_baslik)) <h3 class="title">{{$single->data->dynamic->makale_baslik}}</h3> @endif
                        </div>
                        @if(!empty($single->data->dynamic->makale))
                            <div class="inner">
                                <p class="disc">{!! $single->data->dynamic->makale !!}.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- makale -->











    <!-- sss -->
    <div class="rts-client-area pb--30 pt--30">

        <div class="container">

            <div class="title-area-style-six text-start">
                <p class="pre-title">
                   {{$single->data->dynamic->baslik}}
                </p>
                <h3 class="title">{{$translate->sikca_sorulan_sorular}}</h3>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="accordion accordion-flush" id="accordionFlushExample">

                        @foreach($sss_datas->data as $key => $sss_detay)

                            @if($sss_detay->dynamic->landing_page_kodu == $single->data->dynamic->kod)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading{{$key}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$key}}" aria-expanded="false" aria-controls="flush-collapse{{$key}}">
                                            {{$sss_detay->dynamic->baslik}}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$key}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            {!! $sss_detay->dynamic->detay !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sss -->

    <!-- gallery -->
    <div class="rts-client-area pb--30 pt--30">

        <div class="container">
            <div class="row">
                <div class="col-12">


                    <div id="gallery" >

                        @php $selectData = explode(',', $single->data->dynamic->galeri) @endphp

                        @foreach($selectData as $ky => $value)

                            <a href="">
                                <img alt="{{$single->data->dynamic->baslik}} {{$masters->seo->data->dynamic->keyword1}}"
                                     src="{{Helpers::CacheImageLink($value,array('ThumbsMode' => true, 'Mime' => 'webp'))}}"
                                     data-image="{{Helpers::CacheImageLink($value,array('ThumbsMode' => false, 'Mime' => 'webp'))}}"
                                     data-description=""
                                     style="display:none">
                                      <amp-img alt="{{$single->data->dynamic->baslik}}" src="{{Helpers::CacheImageLink($single->data->dynamic->mobil_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" layout="responsive" > </amp-img>
                            </a>
                        @endforeach


                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- gallery-->




    @if(!empty($single->data->dynamic->video))
    <!-- video -->
    <div class="rts-customer-feedback-area-six rts-section-gap bg-feedback-seven pt--50 pb--50" @if(!empty($masters->anasayfa_duzenle->data->dynamic->video_bg)) style="background-image:url({{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->video_bg,array('ThumbsMode' => false, 'Mime' => 'webp'))}});" @endif>
        <div class="container">

            <div class="row mt--40">


                {!! $single->data->dynamic->video !!}


            </div>
        </div>
    </div>
    <!-- video -->
    @endif


    <!-- YORUMLAR -->
    <!-- YORUMLAR -->
    <!-- YORUMLAR -->
    <div class="  row g-5 mt--20">
        <div class="col-12">
            <div itemscope itemtype="http://schema.org/ItemList" class="swiper mySwiperh2_clients swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-1228f7481dceb493" aria-live="off" style="transition-duration: 0ms; transform: translate3d(-1760px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="0" role="group" aria-label="1 / 4" style="width: 410px; margin-right: 30px;">
                        <!-- single client reviews -->

                        <!-- single client reviews End -->
                    </div>



                    @php
                        $where = [];
                        $multiple = Connections::DataGetAll('ea3eaaeb-d4c0-48ef-9ce4-bf300c714634',$lang,$where,null,'DESC',9);
                    @endphp
                    @foreach($multiple->data as $key => $yorum)
                        <div itemprop="itemListElement" itemscope itemtype="http://schema.org/Review" class="swiper-slide swiper-slide-next" data-swiper-slide-index="{{$key}}" role="group" aria-label="{{$key}} / 1" style="width: 410px; margin-right: 30px;">
                            <!-- single client reviews -->
                            <div class="rts-client-reviews-h2">
                                <div class="review-header">

                                    <div class="discription" itemprop="name">
                                        <a href="#">
                                            <h6 class="title">{{$yorum->dynamic->baslik}}</h6>
                                        </a>

                                    </div>
                                </div>
                                <div class="review-body" itemprop="description">
                                    <p class="disc">
                                        {{$yorum->dynamic->detay}}
                                    </p>
                                    <div class="body-end">

                                        <div class="star-icon icon-2">
                                                                <span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                                                    <meta itemprop="ratingValue" content="5" />
                                                                </span>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single client reviews End -->
                        </div>
                    @endforeach




                </div>


                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>








    </div>




    <!-- YORUMLAR -->
    <!-- YORUMLAR -->
    <!-- YORUMLAR -->

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
                                            <a type="button" href="http://pinterest.com/pin/create/button/?url=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&media={{Helpers::NoCacheImageLink($single->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}&description={{$single->data->dynamic->baslik}}" value="pinterest" target="_blank" class="button">Pinterest</a>
                                        @else
                                            <a type="button" href="http://pinterest.com/pin/create/button/?url=https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&media={{Helpers::NoCacheImageLink($single->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}&description={{$single->data->dynamic->baslik}}" value="pinterest" target="_blank" class="button">Pinterest</a>
                                        @endif



                                    </div>

                                    <!-- tags details End -->
                                </div>

                            </div>



                        </div>
                    </div>
                    <!-- ilgili linkler -->





@endsection
@section('customModuleContent')
    <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />
    <script type='text/javascript' src='/assets/unitegallery/themes/tiles/ug-theme-tiles.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery").unitegallery({
                tiles_type:"justified"

            });


        });



    </script>
@endsection
