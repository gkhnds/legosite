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

    <!-- ContentScroller  -->
    <div class="rts-team-area rts-section-gap bg-team {{$module->class}} contentscroller{{$datas->component->uuid}}" @if(!empty($module->resim)) style="background-image:url({{Helpers::CacheImageLink($module->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});" @endif>
        <div class="container">
            @if($module->title_status == 'Aktif')
            <div class="row">
                <div class="col-12">
                    <div class="rts-title-area team text-center ">
                        <p class="pre-title">
                            {{$module->baslik}}
                        </p>
                        <h2 class="title">{{$module->baslik}}</h2>
                    </div>
                </div>
            </div>
            @endif
            <div class="row g-5 mt--0">

                <div class="swiper mySwiperh1_team">
                    <div class="swiper-wrapper">


                        @foreach($datas->data as $key => $data)
                            <div class="swiper-slide">
                                <div class="team-single-one-start">
                                    <div class="team-image-area">
                                        <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">
                                            <img src="{{Helpers::CacheImageLink($data->dynamic->liste_resmi,array('ThumbsMode'=>true,'Mime'=>'webp','Resize'=>array('Width'=>400,'Height'=>500)))}}" alt="{{$data->dynamic->baslik}}">

                                        </a>
                                    </div>
                                    <div class="single-details">
                                        <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">
                                            <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ContentScroller  -->
@endif
