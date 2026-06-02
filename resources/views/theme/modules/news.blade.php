@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .news{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- news -->
    <div class="rts-blog-area rts-section-gap  {{$module->class}} news{{$datas->component->uuid}}">
        <div class="container">
            @if($module->title_status == 'Aktif')
                <div class="row">
                    <div class="col-12">
                        <div class="title-area text-center">

                            <h2 class="title" style="color: var(--font3) !important;" >{{$module->baslik}}</h2>
                        </div>
                    </div>
                </div>
            @endif
            <div class="g-5 mt--20">
                <div class="swiper mySwiperh1_blog">
                    <div class="swiper-wrapper">

                        @foreach($datas->data as $key => $data)
                            <div class="swiper-slide">
                                <div class="single-blog-one-wrapper">
                                    <div class="thumbnail">
                                        <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode'=>true,'Mime'=>'webp'))}}" alt="{{$data->dynamic->baslik}}">

                                    </div>
                                    <div class="blog-content">

                                        <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">
                                            <h5 class="title">{{$data->dynamic->baslik}} </h5>
                                        </a>
                                        <a class="rts-read-more btn-primary" href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}"><i
                                                class="far fa-arrow-right"></i>{{$translate->detay}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news -->
@endif
