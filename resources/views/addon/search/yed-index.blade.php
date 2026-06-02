@extends('theme.master')

@section('meta')
    <title>{{$tag}} {{$translate->seach_results}}</title>

                         <meta name="description" content="{{$tag}} {{$translate->search_page_desc}}">
@endsection

@section('content')
    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area bg_image" style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">{{$tag}}</h1>
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


                        @php $datais = 0; @endphp
                        @foreach($multiple as $data)

                            @if(isset($data->data))
                                @if(!empty($data->data))
                                    @php $datais = 1; @endphp
                                @endif
                                @foreach ($data->data as $key => $value)

                                    
                                    
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <!-- single service start -->
                                        <div class="rts-single-service-h2">
                                            <a href="/{{$lang}}/{{$data->component->slug}}/{{$value->static->slug}}" class="thumbnail">
                                                @if(isset($value->dynamic) && isset($value->dynamic->liste_resmi))
                                                    <img src="{{ Helpers::CacheImageLink($value->dynamic->liste_resmi, ['ThumbsMode' => true, 'Mime' => 'webp']) }}" alt="{{ $value->dynamic->baslik }}">
                                                @elseif(isset($value->dynamic) && isset($value->dynamic->resim) && !empty($value->dynamic->resim))
                                                    <img src="{{ Helpers::CacheImageLink($value->dynamic->resim, ['ThumbsMode' => true, 'Mime' => 'webp']) }}" alt="{{ $value->dynamic->baslik }}">
                                                @endif
                                            </a>
                                            <div class="body">
                                                <a href="/{{$lang}}/{{$data->component->slug}}/{{$value->static->slug}}">
                                                    <h5 class="title">{{$value->dynamic->baslik}}</h5>
                                                </a>
                                                @if(!empty($value->dynamic->spot_baslik))
                                                <span>{{$value->dynamic->spot_baslik}}</span>
                                                @endif
                                                @if(!empty($value->dynamic->spot))
                                                <span>{{$value->dynamic->spot}}</span>
                                                @endif
                                                                            
                                            </div>
                                        </div>
                                        <!-- single service End -->
                                    </div>

                                @endforeach


                            @endif



                        @endforeach
                       @if($datais == 0)
                        <?php
                        // Arama terimini ve dili al
                        $search_term = urldecode($tag); // Aranan terimi alıyoruz
                        // $lang = app()->getLocale(); // Sistemin dil ayarını alıyoruz (örneğin "en", "tr")
                    
                        // ai_search.php dosyasına POST isteği yaparak sonuçları alma
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://turkkraft.com/ai_search.php");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                            'question' => $search_term,
                            'lang' => $lang
                        ]));
                    
                        // Yanıtı al ve çözümle
                        $response = curl_exec($ch);
                        curl_close($ch);
                        
                        if (!$response) {
                            $response = "Arama sırasında bir hata oluştu.";
                        }
                        ?>
                    
                        <div class="col-lg-12 mb-3">
                             
                            <h3>{{$translate->suggestions}}</h3>
                            <div>
                                {!! $response !!} <!-- AI Arama sonucunu burada gösteriyoruz -->
                            </div>
                        </div>
                        
                        @php
                            $where = [];
                            $products_datas = Connections::DataGetAll("69e1ffcb-79e2-407c-a0ab-cde87c701a4b",$lang,$where,null,null,null,100,1);
                        @endphp
                        
                        @foreach ($products_datas->data as $key => $value)
                            @if($value->dynamic->durum == 'Aktif')
                             

                                    
                                    
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <!-- single service start -->
                                        <div class="rts-single-service-h2">
                                            <a href="/{{$lang}}/{{$data->component->slug}}/{{$value->static->slug}}" class="thumbnail">
                                                @if(isset($value->dynamic) && isset($value->dynamic->liste_resmi))
                                                    <img src="{{ Helpers::CacheImageLink($value->dynamic->liste_resmi, ['ThumbsMode' => true, 'Mime' => 'webp']) }}" alt="{{ $value->dynamic->baslik }}">
                                                @elseif(isset($value->dynamic) && isset($value->dynamic->resim) && !empty($value->dynamic->resim))
                                                    <img src="{{ Helpers::CacheImageLink($value->dynamic->resim, ['ThumbsMode' => true, 'Mime' => 'webp']) }}" alt="{{ $value->dynamic->baslik }}">
                                                @endif
                                            </a>
                                            <div class="body">
                                                <a href="/{{$lang}}/{{$data->component->slug}}/{{$value->static->slug}}">
                                                    <h5 class="title">{{$value->dynamic->baslik}}</h5>
                                                </a>
                                                @if(!empty($value->dynamic->spot_baslik))
                                                <span>{{$value->dynamic->spot_baslik}}</span>
                                                @endif
                                                @if(!empty($value->dynamic->spot))
                                                <span>{{$value->dynamic->spot}}</span>
                                                @endif
                                                                            
                                            </div>
                                        </div>
                                        <!-- single service End -->
                                    </div>

                                
                            @endif
                        @endforeach
                        
                        
                        
                    @endif


                    
    @php
    // Arama terimini URL'den alma
    $url_parts = explode('/', $_SERVER['REQUEST_URI']);
    $search_term = urldecode($url_parts[3]);  // URL'in üçüncü segmentindeki arama terimi
    $lang = $url_parts[1]; // Dil kodunu URL'den al (örneğin "en", "tr")

    // Son aramalar dosyasının yolu
    $last_searches_file = 'last_searches.json';

    // Mevcut son aramaları oku veya boş bir dizi başlat
    $last_searches = file_exists($last_searches_file) ? json_decode(file_get_contents($last_searches_file), true) : [];

    // Aynı arama daha önce yapılmamışsa son aramalara ekle
    if (!in_array($search_term, $last_searches)) {
        array_unshift($last_searches, $search_term); // Yeni aramayı başa ekle
        if (count($last_searches) > 70) {
            array_pop($last_searches); // En fazla 20 arama sakla
        }
        file_put_contents($last_searches_file, json_encode($last_searches)); // Güncellenmiş son aramaları kaydet
    }
@endphp

<div class="rts-single-wized">
    <div class="wized-header">
        <h6 class="title">
           {{$translate->recent_searches}}
        </h6>
    </div>
    <div class="wized-body">
        <div class="tags-wrapper">
            @foreach ($last_searches as $term)
                @php $encoded_term = urlencode($term); 
                $encoded_term = str_replace('+', '%20', $encoded_term); // + karakterini %20 ile değiştir
                @endphp
                <a href="/{{ $lang }}/search/{{ $encoded_term }}/1" title="{{ $term }}">{{ $term }}</a>
            @endforeach
        </div>
    </div>
</div>



                        
                        


                    </div>

                </div>
                <!--rts blog wized area -->

            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->



@endsection

