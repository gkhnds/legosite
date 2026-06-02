@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .{{$module->view}}{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif



    <!-- sss TABS -->
    <div class="rts-about-our-company-h2 rts-section-gap {{$module->class}} {{$module->view}}{{$datas->component->uuid}}">
        <div class="container">
            <div class="row">
                <div class="@if(!empty($masters->anasayfa_duzenle->data->dynamic->sss_resim))col-xl-7 col-lg-7 @else col-xl-12 col-lg-12 @endif col-md-12 col-sm-12 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2 mt_sm--30">
                    @if(!empty($masters->anasayfa_duzenle->data->dynamic->sss_baslik))
                    <div class="title-area about-company">
                        <span>{{$masters->anasayfa_duzenle->data->dynamic->sss_baslik}}</span>
                        <h2 class="title">{{$masters->anasayfa_duzenle->data->dynamic->sss_baslik}}</h2>
                    </div>
                    @endif
                    <div class="about-company-wrapper">

                        <div class="rts-tab-style-one">
                            <div class="d-flex align-items-start contoler-company">
                                <div class="nav flex-column nav-pills me-3 button-area" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    @foreach($datas->data as $key=> $data)
                                        <button class="nav-link @if($key == 0) active @endif" id="data{{$key}}-tab" data-bs-toggle="pill" data-bs-target="#data{{$key}}" type="button" role="tab" aria-controls="data{{$key}}" aria-selected="@if($key == 0) true @else false @endif">{{$data->dynamic->baslik}}</button>
                                    @endforeach


                                </div>
                                <div class="tab-content" id="data{{$key}}-tabContent">

                                    @foreach($datas->data as $key=> $data)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="data{{$key}}" role="tabpanel" aria-labelledby="data{{$key}}-tab">

                                        <!-- start tab content -->
                                        <div class="rts-tab-content-one">
                                            <p class="disc">
@php $detay = \Illuminate\Support\Str::words(strip_tags($data->dynamic->detay), 60,'...');  @endphp

                                                {{str_replace('&nbsp;', ' ', $detay)}}
                                                <HR><a class="rts-read-more btn-primary" href="/{{$lang}}/{{$datas->component->slug}}"><i class="far fa-arrow-right"></i>{{$translate->detay}}</a>
                                            </p>



                                        </div>
                                        <!-- start tab content End -->
                                    </div>
                                    @endforeach



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($masters->anasayfa_duzenle->data->dynamic->sss_resim))
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 order-xl-1 order-lg-1 order-md-1 order-sm-1 order-1">
                    <div class="about-company-thumbnail" style="background-image:url({{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->sss_bg_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
                        <img src="{{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->sss_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- sss TABS -->
@endif
