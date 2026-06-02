@extends('theme.master')
 

@section('meta')
    <title>@if (empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->baslik}} | {{$single->component->seo->title}} @else {{$single->data->dynamic->meta_title}} @endif</title>

    <meta name="description" content="{{$single->data->dynamic->meta_description}}">
    @include('theme.partials.single.schema-and-meta', ['lang'=>$lang, 'single'=>$single, 'masters'=>$masters])

<style>
#lightbox-modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
#lightbox-modal img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
}
#lightbox-close {
    position: absolute;
    top: 20px; right: 30px;
    color: white;
    font-size: 2rem;
    cursor: pointer;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('lightbox-modal');
    const modalImg = document.getElementById('lightbox-img');
    const closeBtn = document.getElementById('lightbox-close');

    document.querySelectorAll('.lightbox-trigger').forEach(el => {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const imgSrc = this.getAttribute('data-image');
            modalImg.src = imgSrc;
            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
        modalImg.src = '';
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            modalImg.src = '';
        }
    });
});
</script>

@foreach($ladders->urun_kategorileri as $kategori)
  
        @if($single->data->dynamic->kategori[0] == $kategori->uuid )
          @php $kat_name = $kategori->name;   @endphp
          @php $kat_slug = $kategori->slug;   @endphp
          @php $kat_uuid = $kategori->uuid;   @endphp
          
        @else
            @if(isset($kategori->children))
            @foreach($kategori->children as $kategoriChild)
                @if($single->data->dynamic->kategori[0] == $kategoriChild->uuid )
                  @php $kat_name = $kategoriChild->name; @endphp
                  @php $kat_slug = $kategoriChild->slug;   @endphp
                  @php $kat_uuid = $kategori->uuid;   @endphp
                @endif
            @endforeach
            @endif
        @endif
 @endforeach
 
 
    <!-- Product Shema -->
   <!-- Product Shema -->


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{$single->data->dynamic->baslik}}",
   
  "description": "{{$single->data->dynamic->meta_description}}",
  @if(!empty($single->data->dynamic->resim))
  @php $selectResimData = explode(',', $single->data->dynamic->resim) @endphp
  @php $resim_key = 0; @endphp
  "image": [
      @foreach($selectResimData as $ky => $value)
        @if ($resim_key > 0), @endif
    "https://{{$_SERVER['SERVER_NAME']}}{{Helpers::CacheImageLink($value,array('ThumbsMode' => false, 'Mime' => 'webp'))}}"
    @php $resim_key++; @endphp
    @endforeach
  ],
  @endif
  "brand": {
        "@type": "Brand",
        "name": "{{$masters->iletisim->data->dynamic->baslik}}"
      },
       "sku": "{{$single->data->static->uuid}}",
      "mpn": "{{$single->data->static->uuid}}",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "97",
    "reviewCount": "97"
  },
  
  
  "review": [
            {
              "@type": "Review",
               "author": {
        "@type": "Person",
        "name": "Creaati",
        "url": "https://creaati.com"
      },
              "datePublished": "2024-12-10T22:15:06+03:00",
			  "dateModified": "{{date('Y-m-d H:i:s')}}",
              "reviewRating": {
				"@type": "Rating",
				"bestRating": "5",
				"ratingValue": "5",
				"worstRating": "1"
			   }			  
            }
          ]	
}
</script>
    <!-- Product Shema -->
    <!-- Product Shema -->
    
    <!-- sss shema -->
    <!-- sss shema -->
  @if(!empty($single->data->dynamic->sss))


  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        @php
          $items = explode('***', $single->data->dynamic->sss); // '***' ile parçala
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
        "name": "{{$single->component->seo->title}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$single->component->slug}}"
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "{{$kat_name}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$single->component->slug}}/{{$kat_slug}}"
      },{
        "@type": "ListItem",
        "position": 4,
        "name": "{{$single->data->dynamic->baslik}}",
        "item": "https://{{$_SERVER['SERVER_NAME']}}/{{$lang}}/{{$single->component->slug}}/{{$single->data->static->slug}}"
      }]
    }
    </script>
    <!-- BreadcrumbList shema -->
    <!-- BreadcrumbList shema -->

    
@endsection

@section('social')



@endsection

@section('content')



   
    
    <!-- start breadcrumb area -->
<div class="rts-breadcrumb-area bg_image " style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                <h1 class="title">{{$single->data->dynamic->baslik}}</h3>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                
               
                <div class="bread-tag">
                    <a href="/{{$lang}}">{{$translate->anasayfa}}</a>
                        <span> / </span> 
                    &nbsp;<a href="/{{$lang}}/{{$single->component->slug}}">{{$single->component->seo->title}}</a>
                        <span> / </span>  
                        &nbsp;<a href="/{{$lang}}/{{$single->component->slug}}/{{$kat_slug}}" class="active">{{$kat_name}}</a>
                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb area -->
 

 
        
        
    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">


                <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                    <!-- service details left area start -->
                    <div class="blog-single-post-listing details mb--0">

                        @if(!empty($single->data->dynamic->header_resim))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}}">
                        </div>
                        @endif

                        



                        <p class="disc">
                            
                         {!! $single->data->dynamic->detay !!}

                        </p>
                        
                        
                        @if(!empty($single->data->dynamic->ara_resim))
                        <div class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($single->data->dynamic->ara_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}} detail">
                        </div>
                        @endif
                        
                        @if(!empty($single->data->dynamic->video))
                            <hr>
                            <iframe id="player" type="text/html" width="640" height="390"
                                    src="{{Helpers::GetVideoPlayerLinkChange($single->data->dynamic->video)}}"
                                    frameborder="0"></iframe>

                        @endif
                        
                         <!-- Benefits -->
                         <!-- Benefits -->
                         @if(!empty($single->data->dynamic->benefits))

                    <hr>
                    <div class="col-lg-12 pr--70 pr_md--0 pr_sm--0 mb--30">
                        <div class="title-area-style-six text-start">
                            <div class="pre-title">
                                
                                <span class="pre">{{$translate->benefits_title}}</span>
                               
                            </div>
                            
                        </div>
                        <div class="about-content-inner-style-six">
                            
                            <div class="item-check-inner">
                                <div class="single-col">
                                    @php $tags = $single->data->dynamic->benefits; $tags = explode('***',$tags); @endphp

                                        @foreach($tags as $tag)

                                            <div class="single-check">
                                                <i class="fas fa-check-circle"></i>
                                                {{$tag}}
                                            </div>

                                        @endforeach




                                     
                                </div>

                                
                            </div>
                            
                        </div>
                    </div>
                    @endif
                    <!-- Benefits -->
                    <!-- Benefits -->
                    
                    
                    <!-- custom productions - imalatlar -->
    <!-- custom productions - imalatlar -->



                        @php
                            $where = [];
                           // $where[] = 'uuid,=,'.$single->data->static->uuid;
                            $custom_imalatlar = Connections::DataGetAll("951e08c0-0924-4073-884c-40e781cdffd5",$lang,$where,null,null,null,100,1);
                        @endphp
                        
                       
        
         @if(isset($custom_imalatlar->data) && count($custom_imalatlar->data) > 0)
            <div class="row g-5 mb--50">
       
             @foreach($custom_imalatlar->data as $key => $ozellik)
             
                             
                 
                 @if (strstr($ozellik->dynamic->urun_uuid, $single->data->static->uuid))
               
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        @if(!empty($ozellik->dynamic->resim))
                        <a href="/{{$lang}}/{{$custom_imalatlar->component->slug}}/{{$ozellik->static->slug}}" class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($ozellik->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}} mobile teaser">
                        </a>
                        @endif
                        <div class="body">
                            <a href="/{{$lang}}/{{$custom_imalatlar->component->slug}}/{{$ozellik->static->slug}}">
                                <h6 class="">{{$ozellik->dynamic->baslik}}</h6>
                            </a>
                           
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
                @endif
             @endforeach
       </div>
        
       @endif
        
        
        
        
      
    
    
    <!-- custom productions - imalatlar -->
    <!-- custom productions - imalatlar -->
    
    
                    <!-- detay_alt -->
                    @if(!empty($single->data->dynamic->detay_alt))
                    <hr>
                    <p class="disc">
                            
                         {!! $single->data->dynamic->detay_alt !!}

                    </p>
                    @endif
                     <!-- detay_alt -->




       <!-- Ürün Özelikleri prodcuts functions-->
       <!-- Ürün Özelikleri -->



        @foreach($ladders->urun_ozellik_gruplari as $ozellik_ladder)
        
         
        @php
            $where = [];
            // $where[]      = 'urun_uuid,=,'.$single->data->static->uuid;
            $where[]      = 'kategori,=,'.$ozellik_ladder->uuid;
            $ozellik_datas = Connections::DataGetAll("c76ab74d-a6c5-4ee0-b9b8-5db8a700db1d",$lang,$where,null,null,null,100,1);
        @endphp
        
        @if(isset($ozellik_datas->data) && count($ozellik_datas->data) > 0) 
        
        
        
            <div class="row g-5 mb--50">
       
             @foreach($ozellik_datas->data as $key => $ozellik)
              
                @if (strstr($ozellik->dynamic->urun_uuid, $single->data->static->uuid))
                
                 @if ($key == 0) <h3 class="title"><a href="/{{$lang}}/{{$ozellik_datas->component->slug}}/{{$ozellik_ladder->slug}}" target="new">{{$ozellik_ladder->name}}</a></h3> @endif
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        @if(!empty($ozellik->dynamic->resim))
                        <a href="/{{$lang}}/{{$ozellik_datas->component->slug}}/{{$ozellik->static->slug}}" class="thumbnail">
                            <img src="{{Helpers::CacheImageLink($ozellik->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$single->data->dynamic->baslik}} mobile teaser">
                        </a>
                        @endif
                        <div class="body">
                            <a href="/{{$lang}}/{{$ozellik_datas->component->slug}}/{{$ozellik->static->slug}}">
                                <h6 class="">{{$ozellik->dynamic->baslik}} </h6>
                            </a>
                            @if(!empty($ozellik->dynamic->spot))
                            <p class="disc">
                                {{$ozellik->dynamic->spot}}  
                            </p>
                            @endif
                            <a href="/{{$lang}}/{{$ozellik_datas->component->slug}}/{{$ozellik->static->slug}}" class="btn-red-more">{{$translate->detay}}<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
                @endif
             @endforeach
       </div>
        
       @endif
        
        
        
        
      
    @endforeach
    
    <!-- Ürün Özelikleri -->
    <!-- Ürün Özelikleri -->
            
                
    
                
        
   
   @if(!empty($single->data->dynamic->resim))
    
                    <!-- Galeri -->
                     <!-- Galeri -->
    
                            <div class="title-area-style-six text-start">
                            <div class="pre-title">
                                
                                <span class="pre">{{$translate->sample_gallery_title}}</span>
                               
                            </div>
                            <hr>
                        </div>
                        <div id="gallery" >
 
                        @php $selectData = explode(',', $single->data->dynamic->resim) @endphp

                        @foreach($selectData as $ky => $value)

                            <a href="#" class="lightbox-trigger" data-image="{{ Helpers::CacheImageLink($value, ['ThumbsMode' => false, 'Mime' => 'webp']) }}">
    <img 
        alt="{{ $single->data->dynamic->baslik }} sample {{ $ky }}"
        src="{{ Helpers::CacheImageLink($value, ['ThumbsMode' => true, 'Mime' => 'webp']) }}"
        loading="lazy"
        width="300"
        height="auto"
    >
</a>
<amp-img alt="{{ $single->data->dynamic->baslik }}" 
         src="{{ Helpers::CacheImageLink($value, ['ThumbsMode' => false, 'Mime' => 'webp']) }}" 
         layout="responsive" 
         width="300" height="200">
</amp-img>
                        @endforeach


                    </div>
                     <!-- Galeri -->
                      <!-- Galeri -->
@endif



<div id="lightbox-modal" style="display:none;">
    <span id="lightbox-close">&#10006;</span>
    <img id="lightbox-img" alt="Expanded image">
</div>


                   
                    



                            <!-- sss -->
                            <!-- sss -->
                            @if(!empty($single->data->dynamic->sss))
                                <div class="title-area-style-six text-start mt--50">
                                    <div class="pre-title">

                                        <span class="pre">{{$translate->sss}}</span>

                                    </div>
                                    <hr>
                                </div>
                                <div class="accordion-one-inner">
                                    <div class="accordion" id="accordionExample2">


                                        @php
                                            // Veriyi diziye dönüştürme
                                            $items = explode('***', $single->data->dynamic->sss); // '***' ile parçala
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
                    <!-- service details left area end -->


 
                </div>
                
 <!-- SIDEBAR -->
 <!-- SIDEBAR -->
 <!-- SIDEBAR -->
                <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">



                    @if($masters->anasayfa_duzenle->data->dynamic->teklif_durumu == 'Aktif')
                        <!-- Fiyat Talep Formu -->
                        <!-- Fiyat Talep Formu -->
                    <div class="rts-contact-fluid" style="padding: 10px;background: #e6e6e6;">
                        <div class="form-wrapper">
                        <div id="form-messages"></div>
                            <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form SubmitForm">
                            <div class="ps-product__feature">
                                <div class="ps-product__title mb--10" style=" color: darkcyan; font-weight: bolder; text-align: center; font-size: 24px; "><a href="#"><a href="#">{{$translate->form_request_for_quote}}</a></div>

                                <div class="ps-product__quantity">
                                    <input class="form-control ps-form__input" type="text" name="telefon" placeholder="{{$translate->telefon}}" required="" required style="margin-bottom: 9px;height: 40px; ">
                                </div>

                                <div class="ps-product__quantity">
                                    <input class="form-control ps-form__input" type="email" name="email" placeholder="{{$translate->email}}" required="" required style=" margin-bottom: 9px;height: 40px;">
                                </div>

                                <div class="ps-product__quantity">

                                        <input class="form-control ps-form__input" type="number" id="adet" name="adet" placeholder="{!! $translate->form_uretim_adedi !!}"    data-toggle="tooltip" data-placement="top" data-html="true" title="{!! $translate->form_uretim_adedi_ornek !!}" required="" style="margin-bottom: 9px;height: 40px; ">
                                    
                                </div>


                                <div class="ps-product__quantity">
                                    <input class="form-control ps-form__input " name="ebat" type="text" placeholder="{{$translate->form_dimensions}}" data-toggle="tooltip" data-placement="top" data-html="true" title="{{$translate->form_dimensions_tooltip}}" required="" style="margin-bottom: 9px;height: 40px; ">
                                </div>



                                @php // Ziyaretçinin ülke kodunu al
                                            $visitorCountryCode = $_SERVER["HTTP_CF_IPCOUNTRY"];
                                            // Ülke kodlarını ve isimlerini bir dizi olarak tanımla
                                            $countries = array(
  'US' => 'United States',
  'DE' => 'Germany',
  'GB' => 'United Kingdom',
  'FR' => 'France',
  'IQ' => 'Iraq',
  'IT' => 'Italy',
  'RU' => 'Russia',
  'NL' => 'Netherlands',
  'BE' => 'Belgium',
  'CZ' => 'Czech Republic',
  'ES' => 'Spain',
  'JP' => 'Japan',
  'BG' => 'Bulgaria',
  'AU' => 'Australia',
  'EG' => 'Egypt',
  // Diğer tüm ülkeler alfabetik sırayla eklenmiştir

  'AL' => 'Albania',
  'DZ' => 'Algeria',
  'AD' => 'Andorra',
  'AO' => 'Angola',
  'AG' => 'Antigua and Barbuda',
  'AR' => 'Argentina',
  'AM' => 'Armenia',
  'AT' => 'Austria',
  'AZ' => 'Azerbaijan',
  'BS' => 'Bahamas',
  'BH' => 'Bahrain',
  'BD' => 'Bangladesh',
  'BB' => 'Barbados',
  'BY' => 'Belarus',
  'BZ' => 'Belize',
  'BJ' => 'Benin',
  'BT' => 'Bhutan',
  'BO' => 'Bolivia',
  'BA' => 'Bosnia and Herzegovina',
  'BW' => 'Botswana',
  'BR' => 'Brazil',
  'BN' => 'Brunei',
  'BF' => 'Burkina Faso',
  'BI' => 'Burundi',
  'KH' => 'Cambodia',
  'CM' => 'Cameroon',
  'CA' => 'Canada',
  'CV' => 'Cape Verde',
  'CF' => 'Central African Republic',
  'TD' => 'Chad',
  'CL' => 'Chile',
  'CN' => 'China',
  'CO' => 'Colombia',
  'KM' => 'Comoros',
  'CG' => 'Congo - Brazzaville',
  'CD' => 'Congo - Kinshasa',
  'CR' => 'Costa Rica',
  'HR' => 'Croatia',
  'CU' => 'Cuba',
  'CY' => 'Cyprus',
  'DK' => 'Denmark',
  'DJ' => 'Djibouti',
  'DM' => 'Dominica',
  'DO' => 'Dominican Republic',
  'EC' => 'Ecuador',
  'SV' => 'El Salvador',
  'GQ' => 'Equatorial Guinea',

  'EE' => 'Estonia',
  'SZ' => 'Eswatini',
  'ET' => 'Ethiopia',
  'FJ' => 'Fiji',
  'FI' => 'Finland',
  'GA' => 'Gabon',
  'GM' => 'Gambia',
  'GE' => 'Georgia',
  'GH' => 'Ghana',
  'GR' => 'Greece',
  'GD' => 'Grenada',
  'GT' => 'Guatemala',
  'GN' => 'Guinea',
  'GW' => 'Guinea-Bissau',
  'GY' => 'Guyana',
  'HT' => 'Haiti',
  'HN' => 'Honduras',
  'HU' => 'Hungary',
  'IS' => 'Iceland',
  'IN' => 'India',
  'ID' => 'Indonesia',
  'IR' => 'Iran',
  'IE' => 'Ireland',
  'IL' => 'Israel',
  'JM' => 'Jamaica',
  'JO' => 'Jordan',
  'KZ' => 'Kazakhstan',
  'KE' => 'Kenya',
  'KI' => 'Kiribati',
  'KR' => 'South Korea',
  'KW' => 'Kuwait',
  'KG' => 'Kyrgyzstan',
  'LA' => 'Laos',
  'LV' => 'Latvia',
  'LB' => 'Lebanon',
  'LS' => 'Lesotho',
  'LR' => 'Liberia',
  'LY' => 'Libya',
  'LI' => 'Liechtenstein',
  'LT' => 'Lithuania',
  'LU' => 'Luxembourg',
  'MG' => 'Madagascar',
  'MW' => 'Malawi',
  'MY' => 'Malaysia',
  'MV' => 'Maldives',
  'ML' => 'Mali',
  'MT' => 'Malta',
  'MH' => 'Marshall Islands',
  'MR' => 'Mauritania',
  'MU' => 'Mauritius',
  'MX' => 'Mexico',
  'FM' => 'Micronesia',
  'MD' => 'Moldova',
  'MC' => 'Monaco',
  'MN' => 'Mongolia',
  'ME' => 'Montenegro',
  'MA' => 'Morocco',
  'MZ' => 'Mozambique',
  'MM' => 'Myanmar',
  'NA' => 'Namibia',
  'NR' => 'Nauru',
  'NP' => 'Nepal',
  'NZ' => 'New Zealand',
  'NI' => 'Nicaragua',
  'NE' => 'Niger',
  'NG' => 'Nigeria',
  'MK' => 'North Macedonia',
  'NO' => 'Norway',
  'OM' => 'Oman',
  'PK' => 'Pakistan',
  'PW' => 'Palau',
  'PS' => 'Palestine',
  'PA' => 'Panama',
  'PG' => 'Papua New Guinea',
  'PY' => 'Paraguay',
  'PE' => 'Peru',
  'PH' => 'Philippines',
  'PL' => 'Poland',
  'PT' => 'Portugal',
  'QA' => 'Qatar',
  'RO' => 'Romania',

  'RW' => 'Rwanda',
  'KN' => 'Saint Kitts and Nevis',
  'LC' => 'Saint Lucia',
  'VC' => 'Saint Vincent and the Grenadines',
  'WS' => 'Samoa',
  'SM' => 'San Marino',
  'ST' => 'Sao Tome and Principe',
  'SA' => 'Saudi Arabia',
  'SN' => 'Senegal',
  'RS' => 'Serbia',
  'SC' => 'Seychelles',
  'SL' => 'Sierra Leone',
  'SG' => 'Singapore',
  'SK' => 'Slovakia',
  'SI' => 'Slovenia',
  'SB' => 'Solomon Islands',
  'SO' => 'Somalia',
  'ZA' => 'South Africa',

  'LK' => 'Sri Lanka',
  'SD' => 'Sudan',
  'SR' => 'Suriname',
  'SE' => 'Sweden',
  'CH' => 'Switzerland',
  'SY' => 'Syria',
  'TJ' => 'Tajikistan',
  'TZ' => 'Tanzania',
  'TH' => 'Thailand',
  'TL' => 'Timor-Leste',
  'TG' => 'Togo',
  'TO' => 'Tonga',
  'TT' => 'Trinidad and Tobago',
  'TN' => 'Tunisia',
  'TR' => 'Türkiye',
  'TM' => 'Turkmenistan',
  'TV' => 'Tuvalu',
  'UG' => 'Uganda',
  'UA' => 'Ukraine',
  'AE' => 'United Arab Emirates',
  'UY' => 'Uruguay',
  'UZ' => 'Uzbekistan',
  'VU' => 'Vanuatu',
  'VE' => 'Venezuela',
  'VN' => 'Vietnam',
  'YE' => 'Yemen',
  'ZM' => 'Zambia',
  'ZW' => 'Zimbabwe'
);

                                            // Diğer ülkeleri buraya ekleyebilirsiniz
                                            // Ziyaretçinin ülke koduna göre ülke ismini al
                                             $visitorCountryName = $countries[$visitorCountryCode];
                                @endphp

                                <div class="ps-product__quantity mt--20">
                                    <label for="targetcountry" class="form-label">{{$translate->select_delivery_country}}</label>
                                    <select class="form-control" id="targetcountry">
                                        <?php // İlk seçenek olarak ziyaretçinin ülkesini ekle
                                        echo "<option value='$visitorCountryCode'>$visitorCountryName</option>";
                                        // Diğer ülkeleri ekle
                                        foreach ($countries as $code => $name) { if ($code !== $visitorCountryCode) { echo "<option value='$code'>$name</option>"; } } ?>
                                    </select>
                                </div>


                                <div class="ps-product__quantity mb--20" >
                                    <textarea class="form-control ps-form__textarea" style=" " name="mesaj" rows="2" placeholder="{{$translate->form_siparis_notu}}"></textarea>
                                </div>

                                <input type="button" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}" data-badge="inline" data-callback='onSubmitMain' value="{{$translate->gonder}}" class="g-recaptcha rts-btn btn-primary" style="" id="recaptchaButton">
                                <style>
                                    .grecaptcha-badge{
                                        display: none;
                                    }
                                </style>
                                <script>
                                    document.getElementById('recaptchaButton').addEventListener('click', function() {
                                        // Butonu gizle
                                        this.style.display = 'none';

                                        // Eğer geri bildirim vermek isterseniz
                                        console.log('Butona basıldı, buton gizlendi.');
                                    });
                                </script>


                            </div>



                            <input type="hidden" name="accept_message"  value="{{$translate->form_gonderildi}}">
                            <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                            <input type="hidden" name="subject" value="{{$translate->form_request_for_quote}}">
                            <input type="hidden" name="mail_backup" value="1">
                            <input type="hidden" name="custom_form" value="1">
                                <input type="hidden" name="mail_view" value="addon/mail/CustomFormMail">
                            <input type="hidden" name="link"  value="https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}">
                             <input type="hidden" name="process" value="SendOnlyMail">



                        </form>
                        </div>
                        </div>
                        <!-- Fiyat Talep Formu -->
                        <!-- Fiyat Talep Formu -->
                    @endif


                        @if($masters->anasayfa_duzenle->data->dynamic->teklif_durumu == 'Whatsapp')
                            <!-- Fiyat Talep Formu -->
                            <!-- Fiyat Talep Formu -->
                            <div class="rts-contact-fluid" style="padding: 10px;background: #e5e5e5;">
                                <div class="form-wrapper">
                                    <div id="form-messages"></div>
                                    <form id="teklifForm" method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form SubmitForm">
                                        <div class="ps-product__feature">
                                            <div class="ps-product__title mb--10" style=" color: darkcyan; font-weight: bolder; text-align: center; font-size: 24px; "><a href="#"><a href="#">{{$translate->form_request_for_quote}}</a></div>

                                            <div class="ps-product__quantity">
                                                <input class="form-control ps-form__input" type="text" name="telefon" placeholder="{{$translate->telefon}}" required="" required style="margin-bottom: 9px;height: 40px; ">
                                            </div>

                                            <div class="ps-product__quantity">
                                                <input class="form-control ps-form__input" type="email" name="email" placeholder="{{$translate->email}}" required="" required style=" margin-bottom: 9px;height: 40px;">
                                            </div>

                                            <div class="ps-product__quantity">

                                                <input class="form-control ps-form__input" type="number" id="adet" name="adet" placeholder="{!! $translate->form_uretim_adedi !!}"    data-toggle="tooltip" data-placement="top" data-html="true" title="{!! $translate->form_uretim_adedi_ornek !!}" required="" style="margin-bottom: 9px;height: 40px; ">

                                            </div>



                                            <div class="ps-product__quantity">
                                                <input class="form-control ps-form__input " name="ebat" type="text" placeholder="{{$translate->form_dimensions}}" data-toggle="tooltip" data-placement="top" data-html="true" title="{{$translate->form_dimensions_tooltip}}" required="" style="margin-bottom: 9px;height: 40px; ">
                                            </div>

                                            @php // Ziyaretçinin ülke kodunu al
                                            $visitorCountryCode = $_SERVER["HTTP_CF_IPCOUNTRY"];
                                            // Ülke kodlarını ve isimlerini bir dizi olarak tanımla
                                            $countries = array(
  'US' => 'United States',
  'DE' => 'Germany',
  'GB' => 'United Kingdom',
  'FR' => 'France',
  'IQ' => 'Iraq',
  'IT' => 'Italy',
  'RU' => 'Russia',
  'NL' => 'Netherlands',
  'BE' => 'Belgium',
  'CZ' => 'Czech Republic',
  'ES' => 'Spain',
  'JP' => 'Japan',
  'BG' => 'Bulgaria',
  'AU' => 'Australia',
  'EG' => 'Egypt',
  // Diğer tüm ülkeler alfabetik sırayla eklenmiştir

  'AL' => 'Albania',
  'DZ' => 'Algeria',
  'AD' => 'Andorra',
  'AO' => 'Angola',
  'AG' => 'Antigua and Barbuda',
  'AR' => 'Argentina',
  'AM' => 'Armenia',
  'AT' => 'Austria',
  'AZ' => 'Azerbaijan',
  'BS' => 'Bahamas',
  'BH' => 'Bahrain',
  'BD' => 'Bangladesh',
  'BB' => 'Barbados',
  'BY' => 'Belarus',
  'BZ' => 'Belize',
  'BJ' => 'Benin',
  'BT' => 'Bhutan',
  'BO' => 'Bolivia',
  'BA' => 'Bosnia and Herzegovina',
  'BW' => 'Botswana',
  'BR' => 'Brazil',
  'BN' => 'Brunei',
  'BF' => 'Burkina Faso',
  'BI' => 'Burundi',
  'KH' => 'Cambodia',
  'CM' => 'Cameroon',
  'CA' => 'Canada',
  'CV' => 'Cape Verde',
  'CF' => 'Central African Republic',
  'TD' => 'Chad',
  'CL' => 'Chile',
  'CN' => 'China',
  'CO' => 'Colombia',
  'KM' => 'Comoros',
  'CG' => 'Congo - Brazzaville',
  'CD' => 'Congo - Kinshasa',
  'CR' => 'Costa Rica',
  'HR' => 'Croatia',
  'CU' => 'Cuba',
  'CY' => 'Cyprus',
  'DK' => 'Denmark',
  'DJ' => 'Djibouti',
  'DM' => 'Dominica',
  'DO' => 'Dominican Republic',
  'EC' => 'Ecuador',
  'SV' => 'El Salvador',
  'GQ' => 'Equatorial Guinea',

  'EE' => 'Estonia',
  'SZ' => 'Eswatini',
  'ET' => 'Ethiopia',
  'FJ' => 'Fiji',
  'FI' => 'Finland',
  'GA' => 'Gabon',
  'GM' => 'Gambia',
  'GE' => 'Georgia',
  'GH' => 'Ghana',
  'GR' => 'Greece',
  'GD' => 'Grenada',
  'GT' => 'Guatemala',
  'GN' => 'Guinea',
  'GW' => 'Guinea-Bissau',
  'GY' => 'Guyana',
  'HT' => 'Haiti',
  'HN' => 'Honduras',
  'HU' => 'Hungary',
  'IS' => 'Iceland',
  'IN' => 'India',
  'ID' => 'Indonesia',
  'IR' => 'Iran',
  'IE' => 'Ireland',
  'IL' => 'Israel',
  'JM' => 'Jamaica',
  'JO' => 'Jordan',
  'KZ' => 'Kazakhstan',
  'KE' => 'Kenya',
  'KI' => 'Kiribati',
  'KR' => 'South Korea',
  'KW' => 'Kuwait',
  'KG' => 'Kyrgyzstan',
  'LA' => 'Laos',
  'LV' => 'Latvia',
  'LB' => 'Lebanon',
  'LS' => 'Lesotho',
  'LR' => 'Liberia',
  'LY' => 'Libya',
  'LI' => 'Liechtenstein',
  'LT' => 'Lithuania',
  'LU' => 'Luxembourg',
  'MG' => 'Madagascar',
  'MW' => 'Malawi',
  'MY' => 'Malaysia',
  'MV' => 'Maldives',
  'ML' => 'Mali',
  'MT' => 'Malta',
  'MH' => 'Marshall Islands',
  'MR' => 'Mauritania',
  'MU' => 'Mauritius',
  'MX' => 'Mexico',
  'FM' => 'Micronesia',
  'MD' => 'Moldova',
  'MC' => 'Monaco',
  'MN' => 'Mongolia',
  'ME' => 'Montenegro',
  'MA' => 'Morocco',
  'MZ' => 'Mozambique',
  'MM' => 'Myanmar',
  'NA' => 'Namibia',
  'NR' => 'Nauru',
  'NP' => 'Nepal',
  'NZ' => 'New Zealand',
  'NI' => 'Nicaragua',
  'NE' => 'Niger',
  'NG' => 'Nigeria',
  'MK' => 'North Macedonia',
  'NO' => 'Norway',
  'OM' => 'Oman',
  'PK' => 'Pakistan',
  'PW' => 'Palau',
  'PS' => 'Palestine',
  'PA' => 'Panama',
  'PG' => 'Papua New Guinea',
  'PY' => 'Paraguay',
  'PE' => 'Peru',
  'PH' => 'Philippines',
  'PL' => 'Poland',
  'PT' => 'Portugal',
  'QA' => 'Qatar',
  'RO' => 'Romania',

  'RW' => 'Rwanda',
  'KN' => 'Saint Kitts and Nevis',
  'LC' => 'Saint Lucia',
  'VC' => 'Saint Vincent and the Grenadines',
  'WS' => 'Samoa',
  'SM' => 'San Marino',
  'ST' => 'Sao Tome and Principe',
  'SA' => 'Saudi Arabia',
  'SN' => 'Senegal',
  'RS' => 'Serbia',
  'SC' => 'Seychelles',
  'SL' => 'Sierra Leone',
  'SG' => 'Singapore',
  'SK' => 'Slovakia',
  'SI' => 'Slovenia',
  'SB' => 'Solomon Islands',
  'SO' => 'Somalia',
  'ZA' => 'South Africa',

  'LK' => 'Sri Lanka',
  'SD' => 'Sudan',
  'SR' => 'Suriname',
  'SE' => 'Sweden',
  'CH' => 'Switzerland',
  'SY' => 'Syria',
  'TJ' => 'Tajikistan',
  'TZ' => 'Tanzania',
  'TH' => 'Thailand',
  'TL' => 'Timor-Leste',
  'TG' => 'Togo',
  'TO' => 'Tonga',
  'TT' => 'Trinidad and Tobago',
  'TN' => 'Tunisia',
  'TR' => 'Turkey',
  'TM' => 'Turkmenistan',
  'TV' => 'Tuvalu',
  'UG' => 'Uganda',
  'UA' => 'Ukraine',
  'AE' => 'United Arab Emirates',
  'UY' => 'Uruguay',
  'UZ' => 'Uzbekistan',
  'VU' => 'Vanuatu',
  'VE' => 'Venezuela',
  'VN' => 'Vietnam',
  'YE' => 'Yemen',
  'ZM' => 'Zambia',
  'ZW' => 'Zimbabwe'
);

                                            // Diğer ülkeleri buraya ekleyebilirsiniz
                                            // Ziyaretçinin ülke koduna göre ülke ismini al
                                             $visitorCountryName = $countries[$visitorCountryCode];
                                            @endphp

                                            <div class="ps-product__quantity mt--20">
                                                <label for="targetcountry" class="form-label">{{$translate->select_delivery_country}}</label>
                                                <select class="form-control" id="targetcountry">
                                                    <?php // İlk seçenek olarak ziyaretçinin ülkesini ekle
                                                    echo "<option value='$visitorCountryCode'>$visitorCountryName</option>";
                                                    // Diğer ülkeleri ekle
                                                    foreach ($countries as $code => $name) { if ($code !== $visitorCountryCode) { echo "<option value='$code'>$name</option>"; } } ?>
                                                </select>
                                            </div>


                                            <div class="ps-product__quantity mb--20" >
                                                <textarea class="form-control ps-form__textarea" style=" " name="mesaj" rows="2" placeholder="{{$translate->form_siparis_notu}}"></textarea>
                                            </div>

                                            <input type="button" name="recaptchaButtonname" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}" data-badge="inline" data-callback='onSubmitMain' value="{{$translate->gonder}}" class="g-recaptcha rts-btn btn-primary" style="background-color: #25D366;" id="recaptchaButton">

                                            <style>
                                                .button{
                                                    background: url("https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg") no-repeat;
                                                    cursor:pointer;
                                                    border: none;
                                                }
                                            </style>

                                            <style>
                                                .grecaptcha-badge{
                                                    display: none;
                                                }
                                            </style>



                                        </div>



                                        <input type="hidden" name="accept_message"  value="{{$translate->form_gonderildi}}">
                                        <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                                        <input type="hidden" name="subject" value="{{$translate->form_request_for_quote}}">
                                        <input type="hidden" name="mail_backup" value="1">
                                        <input type="hidden" name="custom_form" value="1">
                                        <input type="hidden" name="mail_view" value="addon/mail/CustomFormMail">
                                        <input type="hidden" name="link"  value="https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}">
                                        <input type="hidden" name="process" value="SendOnlyMail">



                                    </form>
                                </div>
                            </div>
                            <!-- Fiyat Talep Formu -->
                            <!-- Fiyat Talep Formu -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var form = document.querySelector('.SubmitForm'); // SubmitForm class'ını hedef al

                                    form.addEventListener('submit', function(e) {
                                        e.preventDefault(); // Submit olayını tamamen durdur
                                        console.log('{{$translate->form_request_uyari}}');
                                    });
                                });
                            </script>
                            <script>
                                document.getElementById('recaptchaButton').addEventListener('click', function(e) {
                                    e.preventDefault(); // Butonun default davranışını durdur

                                    // Form alanlarını kontrol et
                                    var telefon = document.querySelector('input[name="telefon"]').value.trim();
                                    var email = document.querySelector('input[name="email"]').value.trim();
                                    var adet = document.querySelector('input[name="adet"]').value.trim();
                                    var ebat = document.querySelector('input[name="ebat"]').value.trim();
                                    var targetcountry = document.querySelector('input[name="targetcountry"]').value.trim();

                                    if (!telefon || !email || !adet || !ebat) {
                                        alert("{{$translate->form_request_uyari}}");
                                        return; // Eksik alan varsa işlem durdurulur
                                    }

                                    // Tüm alanlar doluysa düğmeyi gizle ve devam et
                                    this.style.display = 'none'; // Bu satır sadece doğrulama başarılıysa çalışır


                                    // WhatsApp mesajı oluşturma
                                    var mesaj = document.querySelector('textarea[name="mesaj"]').value.trim();
                                    var whatsappMessage = `{{$translate->form_request_for_quote}}:%0A`
                                        + `{{$translate->telefon}}: ${telefon}%0A`
                                        + `{{$translate->email}}: ${email}%0A`
                                        + `{{$translate->form_uretim_adedi}}: ${adet}%0A`
                                        + `{{$translate->form_dimensions}}: ${ebat}%0A`
                                        + `{{$translate->select_delivery_country}}: ${targetcountry}%0A`

                                        + `{{$translate->mesaj}}: ${mesaj}`;

                                    var whatsappLink = `https://wa.me/{{$masters->iletisim->data->dynamic->whatsapp}}?text=${whatsappMessage}`;
                                    window.open(whatsappLink, '_blank');
                                });





                            </script>






                        @endif


                    @if(!empty($single->data->dynamic->dosya))
                        <!-- single file start -->
                        <div class="rts-single-wized download service">
                            <div class="wized-header">
                                <h5 class="title">{{$translate->dokumanlar}}</h5>
                            </div>
                            <div class="wized-body">

                                @foreach(Helpers::FileList($single->data->dynamic->dosya) as $file)
                                    <!-- single downlaod area start -->
                                    <div class="single-download-area">
                                        <img src="/assets/images/service/icon/07.svg" alt="File {{$file->name}}">
                                        <div class="mid">
                                            <h6 class="title">
                                                <a class="rts-btn btn-primary" target="_blank" href="{{$file->url}}">{{$file->name}}</a>
                                            </h6>
                                             
                                        </div>

                                    </div>
                                    <!-- single downlaod area End -->
                                @endforeach

                            </div>

                            <!-- single file End -->

                        </div>
                        <!-- rts- blog wizered end area -->
                    @endif






                        <!-- İlgili ürünler -->
                        <!-- İlgili ürünler -->
                        @php
                            $where = [];
                           // $where[] = 'uuid,=,'.$single->data->static->uuid;
                            $ilgili_urunler = Connections::DataGetAll("69e1ffcb-79e2-407c-a0ab-cde87c701a4b",$lang,$where,null,null,null,100,1);
                        @endphp
                        
                        @if(isset($ilgili_urunler->data) && count($ilgili_urunler->data) > 0)
                            <div class="rts-single-wized Recent-post">
                                <div class="wized-header">
                                    <h5 class="title">
                                        {{$translate->ilgili_urunler}}
                                    </h5>
                                </div>
                                <div class="wized-body">
                                    <!-- recent-post -->

                                    @foreach($ilgili_urunler->data as $ilgili)
                                        @if (strstr($single->data->dynamic->ilgili, $ilgili->static->uuid))
                                            <div class="recent-post-single">
                                                <div class="thumbnail">
                                                    <a href="/{{$lang}}/{{$ilgili_urunler->component->slug}}/{{$ilgili->static->slug}}">
                                                        <img src="{{Helpers::CacheImageLink($ilgili->dynamic->header_resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$ilgili->dynamic->baslik}} image">
                                                    </a>
                                                </div>
                                                <div class="content-area">

                                                    <a class="post-title" href="/{{$lang}}/{{$ilgili_urunler->component->slug}}/{{$ilgili->static->slug}}">
                                                        <h6 class="title" style="word-break: keep-all;">{{$ilgili->dynamic->baslik}}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @endif
                        <!-- İlgili ürünler -->
                        <!-- İlgili ürünler -->
                    

                    
                   

                <!-- KEYWORDS -->
                    <div class="rts-single-wized">
                            <div class="wized-header">
                                <h6 class="title">
                                    {{$translate->etiketler}}
                                </h6>
                            </div>
                            <div class="wized-body">
                                <div class="tags-wrapper">
                                    @php $tags = $single->data->dynamic->keywords; $tags = explode(';',$tags); @endphp
                                    @if(!empty($tags))
                                        @foreach($tags as $tag)
                                            <a href="/{{$lang}}/search/{{$tag}}/1" target="new" title="{{$tag}}">{{$tag}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                  <!-- KEYWORDS -->
                  
                  
                   <!-- MODULS -->
                    @foreach($masters->moduller->data as $k => $modul)
                        @if($modul->dynamic->tipi == 'Right')
                            <div class="rts-single-wized  service">
                                <x-modules position="Right" view="{{$modul->dynamic->view}}" uuid="{{$modul->static->uuid}}"/>
                            </div>
                        @endif
                    @endforeach
                <!-- MODULS -->
                
                

                </div>


            </div>
        </div>
    </div>
    <!-- End service details area -->





@endsection
@section('customModuleContent')
 <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
   
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />
<script type='text/javascript' src='/assets/unitegallery/themes/tiles/ug-theme-tiles.js'></script>

 <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery").unitegallery({
                tiles_type:"justified",
                @if($masters->anasayfa_duzenle->data->dynamic->galeri_resim_baslik == 'Aktif')
                tile_enable_textpanel:true,
                tile_textpanel_title_text_align: "center",
                tile_textpanel_always_on:true,
                @endif
            });


        });



    </script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


@endsection
