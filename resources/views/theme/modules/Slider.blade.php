@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .rts-banner-area{
                    display: none;
                }
            }
        </style>
    @endif



        <!-- banner area start three -->
        <div class="rts-banner-area banner-three {{$module->class}}">
            <div class="swiper mySwiperh3_banner">
                <div class="swiper-wrapper">

                    @foreach($datas->data as $data)
                     <div class="swiper-slide">
                        <div class="bg_banner-three bg_image rts-section-gap position-relative">
                        <img
                        src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode'=>false,'Mime'=>'webp','Resize'=>array('Width'=>1920,'Height'=>800)))}}"
                        alt="{{ $data->dynamic->baslik2 ?? 'Packaging Banner' }}"
                        width="1920"
                        height="800"
                        style="width: 100%; height: auto; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;"
                        fetchpriority="high"
                        decoding="async"
                        loading="eager" />



                    
                            <div class="container position-relative">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="banner-three-inner">
                                            @if(!empty($data->dynamic->baslik))
                                                <span class="subtitle-banner">{{ $data->dynamic->baslik }}</span>
                                            @endif
                                            @if(!empty($data->dynamic->baslik2))
                                                <h1 class="title cd-headline clip is-full-width">
                                                    {{ $data->dynamic->baslik2 }}
                                                </h1>
                                            @endif
                                            @if(!empty($data->dynamic->spot))
                                                <p class="disc">
                                                    {{ $data->dynamic->spot }}
                                                </p>
                                            @endif
                    
                                            <div class="button-group">
                                                @if(!empty($data->dynamic->buton_baslik) && !empty($data->dynamic->buton_link))
                                                    <a href="{{ $data->dynamic->buton_link }}" class="rts-btn btn-primary-3">{{ $data->dynamic->buton_baslik }}</a>
                                                @endif
                                                @if(!empty($data->dynamic->buton_baslik2) && !empty($data->dynamic->buton_link2))
                                                    <a href="{{ $data->dynamic->buton_link2 }}" class="rts-btn btn-primary-3 transparent">{{ $data->dynamic->buton_baslik2 }}</a>
                                                @endif
                                            </div>
                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach

                </div>
            </div>
        </div>
        <!-- banner area end three -->


    @endif
















