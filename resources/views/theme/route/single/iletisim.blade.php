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
    
    
    
     <style>
 * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

 
.parent-container {
  display: flex;
  justify-content: center; /* Yatayda ortalama */
  
}

.carousel-wrapper {
  background: #fff;
  padding: 20px;
  max-width: 700px;
  width: 100%;
  text-align: center;
  border-radius: 8px;
    
   margin: 0 auto; /* Ekstra güvenlik için */
  position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);

   
}

.carousel-items {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
}

.item {
  flex: 1 1 calc(30% - 10px);
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
  text-align: center;
  color: #b22222;
  font-weight: bold;
  cursor: pointer;
  transition: box-shadow 0.3s ease;
      background-color: aliceblue;
}

.item:hover {
  box-shadow: 0 0 10px rgba(178, 34, 34, 0.4);
}

.item p {
      font-weight: 500;
    color: #000;
}

.item img {
  width: 80px;
  margin-bottom: 10px;
  border-radius: 7px;
}

.hidden {
  display: none;
}

.back-btn {
  background: #adadad;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
    width: auto;
}

.back-btn:hover {
  background: #6a6666;
}

form input,
form textarea {
  width: 100%;
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

form button {
  background: #b22222;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

@media (max-width: 768px) {
  .carousel-items {
    flex-direction: column;
  }

  .item {
    width: 100%;
    margin: 5px 0;
  }
}




</style>

@endsection

@section('content')


    <div class="rts-about-area-two  about-two-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pl_md--15 pl_sm--15">
                    <div class="about-right-three">
                        <div class="title-area-about-three text-center">
                            <h1 class="sub">{{$translate->contact_h2}}</h1>

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
                         
                        <div class="form-wrapper">
                            <div id="form-messages"></div>
                           

 
  
 
 
    <div class="form-wrapper">
  <!-- Step 1: Sector Selection -->
  <div class="carousel-step" id="step-1">
  <div class="rts-title-area contact-fluid text-center mb--50">
  <p class="pre-title">{{$translate->seciniz}} <br>{{$single->data->dynamic->step_title_1}} </p>
  </div>
  <div class="carousel-items">
       
      
     @php  $step_opt_1 = explode('***', $single->data->dynamic->step_opt_1); @endphp
       @foreach($step_opt_1 as $opt)
        
        
        <div class="item" id="{{ $opt }}" onclick="selectOption(1, '{{ $opt }}'); nextStep(2);">
      
      <p>{{ $opt }}</p>
    </div>
    @endforeach
   
    
  </div>
</div>


  <!-- Step 2: Bag Type -->
  <div class="carousel-step hidden" id="step-2">
  
  <div class="rts-title-area contact-fluid text-center mb--50">
  <p class="pre-title">{{$single->data->dynamic->step_title_2}} </p>
  </div>
  <div class="carousel-items">
      
      
      @php  $step_opt_2 = explode('***', $single->data->dynamic->step_opt_2); @endphp
       @foreach($step_opt_2 as $opt)
        
        
        <div class="item" id="{{ $opt }}" onclick="selectOption(2, '{{ $opt }}'); nextStep(3);">
      
      <p>{{ $opt }}</p>
    </div>
    @endforeach
    
     
  </div>
  <button class="back-btn" onclick="prevStep(1)">← {{$translate->geri}}</button>
</div>


  <!-- Step 3: Quantity -->
  <div class="carousel-step hidden" id="step-3">
   
  <div class="rts-title-area contact-fluid text-center mb--50">
  <p class="pre-title">{{$single->data->dynamic->step_title_3}} </p>
  </div>
  <div class="carousel-items">
      
      @php  $step_opt_3 = explode('***', $single->data->dynamic->step_opt_3); @endphp
       @foreach($step_opt_3 as $opt)
        
        
        <div class="item" id="{{ $opt }}" onclick="selectOption(3, '{{ $opt }}'); nextStep(4);">
      
      <p>{{ $opt }}</p>
    </div>
    @endforeach
    
    
  </div>
  <button class="back-btn" onclick="prevStep(2)">← {{$translate->geri}}</button>
</div>


  <!-- Step 4: Filling -->
 <div class="carousel-step hidden" id="step-4">
   
  <div class="rts-title-area contact-fluid text-center mb--50">
  <p class="pre-title">{{$single->data->dynamic->step_title_4}} </p>
  </div>
  <div class="carousel-items">
      
        @php  $step_opt_4 = explode('***', $single->data->dynamic->step_opt_4); @endphp
       @foreach($step_opt_4 as $opt)
        
        
        <div class="item" id="{{ $opt }}" onclick="selectOption(4, '{{ $opt }}'); nextStep(5);">
      
      <p>{{ $opt }}</p>
    </div>
    @endforeach
    
    
  </div>
  <button class="back-btn" onclick="prevStep(3)">← {{$translate->geri}}</button>
</div>


  <!-- Step 5: Contact Form -->
  <div class="carousel-step hidden" id="step-5">
  
    
    
    <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form SubmitForm">
                                <div class="name-email">
                                    <input type="text" name="isim" placeholder="{{$translate->ad_soyad}}" required>
                                    <input type="email" name="email" placeholder="{{$translate->email}}" required>
                                    <input type="text" name="telefon" placeholder="{{$translate->telefon}}" required>
                                </div>

                                <textarea id="message" name="mesaj" placeholder="{{$translate->mesaj}}"></textarea>

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
    
    
    <button class="back-btn" onclick="prevStep(4)">← {{$translate->geri}}</button>
  </div>
 
</div>
    
   
 

 

 
 


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
                                    <a class="btn-primary-2 menu-block-none" href="https://wa.me/908505329200" style="background-color: #25D366; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
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
<script>
  // Seçilen seçeneklerin tutulacağı dizi
  let selectedOptions = [];

  // Her seçeneğe tıklanıldığında çağrılacak fonksiyon
  function selectOption(step, value) {
    selectedOptions[step] = value; // Adıma göre değeri kaydet
  }

  // Form gönderilmeden önce mesaj alanına seçenekleri ekleyelim
  document.getElementById("sbtn").addEventListener("click", function () {
    const messageField = document.getElementById("message");
    
    // Mevcut mesaj içeriğini al
    const currentMessage = messageField.value.trim();

    // Seçilen seçenekleri birleştirip mesaj alanına ekle
    const selectedMessage = "Selected Options:\n" + selectedOptions.filter(Boolean).join("\n");

    // Mevcut mesajı koruyarak seçilen seçenekleri ekle
    messageField.value = (currentMessage ? currentMessage + "\n\n" : "") + selectedMessage;
  });

  // Sonraki adıma geçiş fonksiyonu
  function nextStep(step) {
    document.querySelectorAll('.carousel-step').forEach(el => el.classList.add('hidden'));
    document.getElementById(`step-${step}`).classList.remove('hidden');
  }

  // Önceki adıma dönüş fonksiyonu
  function prevStep(step) {
    document.querySelectorAll('.carousel-step').forEach(el => el.classList.add('hidden'));
    document.getElementById(`step-${step}`).classList.remove('hidden');
  }
</script>
   
@endsection