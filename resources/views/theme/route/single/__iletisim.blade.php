@extends('theme.master')

@section('title', $single->component->seo->title)

@section('meta')
    <title>{{$single->data->dynamic->baslik}} - {{$single->component->seo->title}}</title>

    <meta name="description" content="{{$single->component->seo->desc}}">
    <meta name="keywords" content="{{$single->component->seo->keywords}}">


    <!-- Creaati Seo Tools CONTACT -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Corporation",
      "name": "{{$single->component->seo->title}}",
      "url": "{{url('/')}}/{{$lang}}",
      "logo": "{{$masters->tasarim_ayarlari->data->dynamic->logo}}"
    }
    </script>
    <!-- Creaati Seo Tools CONTACT -->

@endsection

@section('content')


    <div class="rts-about-area-two rts-section-gap about-two-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pl_md--15 pl_sm--15">
                    <div class="about-right-three">
                        <div class="title-area-about-three text-center">
                            <h1 class="sub">{{$masters->iletisim->data->dynamic->baslik}}</h1>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>








    <!-- conact us form fluid start -->
    <div class="rts-contact-form-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rts-contact-fluid rts-section-gap">
                        <div class="rts-title-area contact-fluid text-center mb--50">
                            <p class="pre-title">
                                {{$translate->contact_h2}}
                            </p>

                        </div>
                        <div class="form-wrapper">
                            <div id="form-messages"></div>
                            <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form SubmitForm">
                                <div class="name-email">
                                    <input type="text" name="isim" placeholder="{{$translate->ad_soyad}}" required>
                                    <input type="email" name="email" placeholder="{{$translate->email}}" required>
                                    <input type="text" name="telefon" placeholder="{{$translate->telefon}}" required>
                                </div>

                                <textarea  name="mesaj"> {{$translate->mesaj}} </textarea>

                                <button class="g-recaptcha rts-btn btn-primary"  type="button" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain'  id="sbtn" name="submit-form">{{$translate->gonder}}</button>

                                <style>
                                    .grecaptcha-badge{
                                        display: none;
                                    }
                                </style>
                                <input type="hidden" name="componentId" value="475f9997-c1bf-43ca-a1c9-cb3de7e103b5">
                                <input type="hidden" name="accept_message"  value="{{$translate->form_gonderildi}}">
                                <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                                <input type="hidden" name="subject" value="{{$single->component->seo->title}}">
                                <input type="hidden" name="mail_backup" value="1">
                                <input type="hidden" name="custom_form" value="0">
                                <input type="hidden" name="mail_view" value="addon/mail/FormMail">
                                <input type="hidden" name="link"  value="{{$single->component->seo->title}}">
                                <input type="hidden" name="process" value="InsertToMail">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- conact us form fluid end -->


    <!-- map area start -->
    <div class="rts-map-area bg-light-white">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- map area left -->
                    <div class="mapdetails-inner-one">
                        <div class="left-area single-wized">
                            <h5 class="title">{{$translate->iletisim}}</h5>
                            <div class="details">
                                <p>{{$translate->bize_ulasin}}</p>

                                <a class="number" href="tel:{{$masters->iletisim->data->dynamic->telefon}}">{{$masters->iletisim->data->dynamic->telefon}}</a>
                                @if (!empty($masters->iletisim->data->dynamic->telefon2))
                                   <br> <a class="number" href="tel:{{$masters->iletisim->data->dynamic->telefon2}}">{{$masters->iletisim->data->dynamic->telefon2}}</a>
                                @endif
                                @if (!empty($masters->iletisim->data->dynamic->telefon3))
                                    <br> <a class="number" href="tel:{{$masters->iletisim->data->dynamic->telefon3}}">{{$masters->iletisim->data->dynamic->telefon3}}</a>
                                @endif

                                @if (!empty($masters->iletisim->data->dynamic->email))
                                    <p class="headoffice pt--10">
                                        {{$translate->sorularinizi_sorun}}
                                    </p>
                                    <p class="office"><a class="number" href="mailto:{{$masters->iletisim->data->dynamic->email}}">{{$masters->iletisim->data->dynamic->email}}</a>
                                    <br><br>
                                    <a class="btn-primary-2 menu-block-none" href="https://wa.me/{{$masters->iletisim->data->dynamic->whatsapp}}" style="background-color: #25D366; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Icon" style="width: 20px; height: 20px; margin-right: 8px;">
  WhatsApp
</a>

                                    </p>
                                @endif

                            </div>
                        </div>
                        <div class="right-area single-wized">
                            <h5 class="title">{{$translate->bize_ulasin}}</h5>
                            <div class="details">
                                <p>{{$translate->bizi_ziyaret_edin}}</p>
                                <a href="#">{{$masters->iletisim->data->dynamic->adres}}</a>



                                <p class="time-header pt--10">
                                    {{$translate->calisma_saatleri}}
                                </p>
                                <p class="time">
                                    <a class="number" >{{$masters->anasayfa_duzenle->data->dynamic->calisma_saatleri}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- map area right -->
                </div>
                <div class="col-lg-6">
                    {!! $single->data->dynamic->harita !!}
                </div>
            </div>

        </div>
    </div>
    <!-- map area end -->


<!-- iletisim_detay -->
<div class="rts-blog-list-area ">
        <div class="container">
            <div class="row g-5">
                <!-- rts blo post area -->
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <!-- single post -->
                    <div class="blog-single-post-listing details mb--0">
                        <hr>
                        <div class="">
                            
                                                         <p class="disc mt--30">
                               
                                                        {!! $masters->anasayfa_duzenle->data->dynamic->iletisim_detay !!}
                                                        </p>
                                                        <div class="row  align-items-center">
                                <div class="col-lg-12 col-md-12">
                                    <!-- tags details -->
                                    <div class="details-tag">
                                        
                                        
                                    </div>
                                    <!-- tags details End -->
                                </div>
                                
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <!-- single post End-->
                </div>
                <!-- rts-blog post end area -->
                <!--rts blog wizered area -->
                
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>
<!-- iletisim_detay -->

    @if(!empty($masters->iletisim->data->dynamic->sube_baslik))
        <div class="rts-project-area rts-section-gap bg-project-three margin-controlerproject mt--50 mt_sm--0">
            <div class="container controler">
                <div class="row g-0">
                    <div class="col-lg-7">
                        <!-- project area left wrapper -->
                        <div class="title-area-project-w-in">

                            <h2 class="title">
                                <span>{{$masters->iletisim->data->dynamic->sube_baslik}}</span>
                            </h2>

                            <div class="bg-email">
                                <div class="content-wrapper">
                                    <!-- single-contact info -->
                                    <div class="contact-info">
                                        <div class="icon">
                                            <img src="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->iletisim_telefon_ikon,array('ThumbsMode' => false,'Mime' => 'webp'))}}" style="max-height: 60px;">
                                        </div>
                                        <div class="discription">
                                            <span>{{$translate->bize_ulasin}}</span>
                                            <h5 class="title-sm">{{$masters->iletisim->data->dynamic->sube_telefon}}</h5>
                                        </div>
                                    </div>
                                    <!-- single-contact info End -->
                                    <!-- single-contact info -->
                                    <div class="contact-info">
                                        <div class="icon">
                                            <img src="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->iletisim_mail_ikon,array('ThumbsMode' => false,'Mime' => 'webp'))}}" style="max-height: 60px;">
                                        </div>
                                        <div class="discription">
                                            <span>{{$translate->sorularinizi_sorun}}</span>
                                            <h5 class="title-sm">{{$masters->iletisim->data->dynamic->sube_email}}</h5>
                                        </div>
                                    </div>

                                    <div class="contact-info">
                                        <div class="icon">
                                            <img src="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->iletisim_adres_ikon,array('ThumbsMode' => false,'Mime' => 'webp'))}}" style="max-height: 60px;">
                                        </div>
                                        <div class="discription">
                                            <span>{{$translate->bizi_ziyaret_edin}}</span>
                                            <h5 class="title-sm" style="font-size: 16px;">{{$masters->iletisim->data->dynamic->sube_adres}}</h5>
                                        </div>
                                    </div>
                                    <!-- single-contact info End -->
                                </div>
                            </div>
                        </div>
                        <!-- project area left wrapper end -->
                    </div>
                    <div class="col-lg-4">
                        <div class="bg-input-project">
                            {!! $single->data->dynamic->sube_harita !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif




@stop

@section('customModuleContent')
    <script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
@endsection