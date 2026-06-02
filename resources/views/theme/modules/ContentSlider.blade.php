@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .nedenbiz{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- NEDEN BİZ -->
    <div class="rts-gallery-area mt--30 rts-section-gap gallery-bg bg_image {{$module->class}} nedenbiz{{$datas->component->uuid}}">
        <div class="container">
            @if($module->title_status == 'Aktif')
                <div class="row">
                    <div class="rts-title-area gallery text-start pl_sm--20">
                        <h2 class="title">{{$module->baslik}}</h2>
                    </div>
                </div>
            @endif

            <div class="row mt--45">
                <div class="col-12">
                    <div class="swiper mygallery mySwipers">
                        <div class="swiper-wrapper gallery">

                            @foreach($datas->data as $key => $data)
                                <div class="swiper-slide">
                                    <div class="row g-5 w-g-100">
                                        <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                                            <div class="thumbnail-gallery">
                                                <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                                            <div class="bg-right-gallery" style="background-image:url({{Helpers::CacheImageLink($module->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">

                                                <a href="#">
                                                    <h4 class="title">{{$data->dynamic->baslik}}</h4>
                                                </a>

                                                <p class="disc" style="max-width: 300px">@php $detay = \Illuminate\Support\Str::words(strip_tags($data->dynamic->detay), 20,'...');  @endphp
                                                    {{str_replace('&nbsp;', ' ', $detay)}}
                                                </p>
                                                <a class="rts-btn btn-primary" href="/{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">{{$translate->detay}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NEDEN BİZ  -->
@endif
