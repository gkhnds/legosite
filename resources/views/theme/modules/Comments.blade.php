@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .yorum{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif
    <!-- MÜŞTERİ YORUM -->
    <div class="rts-client-review-two rts-section-gapTop  {{$module->class}} yorum{{$datas->component->uuid}}">
        <div class="container">
            @if($module->title_status == 'Aktif')
            <div class="row mt--30">
                <div class="title-area left-right testimonial-h2">
                    <div class="title-left">

                        <h2 class="title mt--15">
                            {{$module->baslik}}
                        </h2>
                    </div>

                </div>
            </div>
            @endif
            <div class="row g-5 mt--20">
                <div class="col-12">
                    <div class="swiper mySwiperh2_clients">
                        <div class="swiper-wrapper">

                            @foreach($datas->data as $key => $data)
                                <div class="swiper-slide">
                                    <!-- single client reviews -->
                                    <div class="rts-client-reviews-h2">
                                        <div class="review-header">

                                            <div class="discription">
                                                <a href="#">
                                                    <h6 class="title">{{$data->dynamic->baslik}}</h6>
                                                </a>

                                            </div>
                                        </div>
                                        <div class="review-body">
                                            <p class="disc">
                                                {{$data->dynamic->detay}}
                                            </p>
                                            <div class="body-end">

                                                <div class="star-icon">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MÜŞTERİ YORUM -->
@endif
