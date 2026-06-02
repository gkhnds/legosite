@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .contentscroller{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- ContentScroller2  -->
    <div class="rts-service-area rts-section-gap {{$module->class}} contentscroller{{$datas->component->uuid}}" @if(!empty($module->resim)) style="background-image:url({{Helpers::CacheImageLink($module->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});" @endif>
        <div class="container">
            @if($module->title_status == 'Aktif')
                <div class="row">
                    <div class="col-12">
                        <div class="text-center title-service-three">

                            <h3 class="title">
                                {{$module->baslik}}
                            </h3>

                        </div>
                    </div>
                </div>
            @endif
            <div class="row g-5 ">
                <div class="col-12">
                    <div class="swiper mySwiperh2_Service">
                        <div class="swiper-wrapper">

                            @foreach($datas->data as $key => $data)
                                <div class="swiper-slide">
                                    <div class="service-one-inner-four">
                                        <div class="big-thumbnail-area">
                                            <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}" class="thumbnail">
                                                <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode'=>true,'Mime'=>'webp','Resize'=>array('Width'=>400,'Height'=>420)))}}" alt="{{$data->dynamic->baslik}}">
                                            </a>
                                            <div class="content">

                                                <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                                <p class="disc">
                                                    @php $detay_modul = \Illuminate\Support\Str::words(strip_tags($data->dynamic->detay), 15,'...');  @endphp
                                                {{$detay_modul}}</p>
                                            </div>
                                            <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}" class="over_link"></a>
                                        </div>

                                    </div>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt--10">
                <div class="col-12">
                    <div class="pagination-arrow navigation-center-bottom service text-center position-relative">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ContentScroller  -->
@endif
