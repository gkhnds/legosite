@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .rts-cta-section-start{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- SAYAÇ -->
    <div class="rts-counter-up-area rts-section-gap  {{$module->class}}" style="background-color: {{$masters->anasayfa_duzenle->data->dynamic->sayac_bg}};">
        <div class="container">
            <div class="row">

                @if(!empty($masters->anasayfa_duzenle->data->dynamic->sayac_rakam1))
                <!-- counter up area -->
                <div class="{{$module->extra}} text-center col-lg-4 col-md-6 col-sm-6 col-12 mb--20">
                    <div class="single-counter">
                        <div class="counter-details">
                            <h2 class="title"><span class="counter animated fadeInDownBig">{{$masters->anasayfa_duzenle->data->dynamic->sayac_rakam1}}</span></h2>
                            <p class="disc">{{$masters->anasayfa_duzenle->data->dynamic->sayac_detay1}}</p>
                        </div>
                    </div>
                </div>
                <!-- counter up area -->
                @endif
                @if(!empty($masters->anasayfa_duzenle->data->dynamic->sayac_rakam2))
                <!-- counter up area -->
                <div class="{{$module->extra}} text-center col-lg-4 col-md-6 col-sm-6 col-12 mb--20">
                    <div class="single-counter">
                        <div class="counter-details">
                            <h2 class="title"><span class="counter animated fadeInDownBig">{{$masters->anasayfa_duzenle->data->dynamic->sayac_rakam2}}</span></h2>
                            <p class="disc">{{$masters->anasayfa_duzenle->data->dynamic->sayac_detay2}}</p>
                        </div>
                    </div>
                </div>
                <!-- counter up area -->
                    @endif
                @if(!empty($masters->anasayfa_duzenle->data->dynamic->sayac_rakam3))
                <!-- counter up area -->
                <div class="{{$module->extra}} text-center col-lg-4 col-md-6 col-sm-6 col-12 mb--20">
                    <div class="single-counter">
                        <div class="counter-details">
                            <h2 class="title"><span class="counter animated fadeInDownBig">{{$masters->anasayfa_duzenle->data->dynamic->sayac_rakam3}}</span></h2>
                            <p class="disc">{{$masters->anasayfa_duzenle->data->dynamic->sayac_detay3}}</p>
                        </div>
                    </div>
                </div>
                <!-- counter up area -->
                    @endif
                @if(!empty($masters->anasayfa_duzenle->data->dynamic->sayac_rakam4))
                <!-- counter up area -->
                <div class="{{$module->extra}} text-center col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="single-counter">
                        <div class="counter-details">
                            <h2 class="title"><span class="counter animated fadeInDownBig">{{$masters->anasayfa_duzenle->data->dynamic->sayac_rakam4}}</span></h2>
                            <p class="disc">{{$masters->anasayfa_duzenle->data->dynamic->sayac_detay4}}</p>
                        </div>
                    </div>
                </div>
                <!-- counter up area -->
                    @endif

            </div>
        </div>
    </div>
    <!-- SAYAÇ -->
@endif
