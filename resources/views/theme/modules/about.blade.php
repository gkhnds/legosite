@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .about{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif



    <!-- ABOUT -->
    <div class="bg-shape-wrapper-main {{$module->class}} about{{$datas->component->uuid}}">
        <!-- rts about area start -->
        <div class="rts-about-area-start rts-section-gap Bottom ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 pr--70 pr_md--0 pr_sm--0">
                        <div class="title-area-style-six text-start">
                            <div class="pre-title">

                                <span class="pre">{{$masters->anasayfa_duzenle->data->dynamic->about_ust_baslik}}</span>

                            </div>
                            <h2 class="title">
                                {{$masters->anasayfa_duzenle->data->dynamic->about_baslik}}
                            </h2>
                        </div>
                        <div class="about-content-inner-style-six">
                            <p class="disc">
                                {{$masters->anasayfa_duzenle->data->dynamic->about_spot}}
                            </p>
                            <div class="item-check-inner">
                                <div class="single-col">
                                    <div class="single-check">
                                        <i class="fas fa-check-circle"></i>
                                        {{$masters->anasayfa_duzenle->data->dynamic->about_ozellik_1}}
                                    </div>
                                    <div class="single-check">
                                        <i class="fas fa-check-circle"></i>
                                        {{$masters->anasayfa_duzenle->data->dynamic->about_ozellik_2}}
                                    </div>

                                </div>
                                <div class="single-col">
                                    <div class="single-check">
                                        <i class="fas fa-check-circle"></i>
                                        {{$masters->anasayfa_duzenle->data->dynamic->about_ozellik_3}}

                                    </div>
                                    <div class="single-check">
                                        <i class="fas fa-check-circle"></i>
                                        {{$masters->anasayfa_duzenle->data->dynamic->about_ozellik_4}}
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="thumbnail-about-six">
                            <img width="612" height="533" src="{{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->about_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$masters->seo->data->dynamic->keyword1}} {{$masters->seo->data->dynamic->keyword2}}">
                            <amp-img alt="{{$masters->seo->data->dynamic->keyword1}}" src="{{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->about_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" width="250" height="159" layout="responsive" > </amp-img>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ABOUT -->
@endif
