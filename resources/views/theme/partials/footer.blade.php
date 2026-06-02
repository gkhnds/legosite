<!-- start header area -->
<!-- footer area start -->
<div class="rts-footer-area rts-section-gap footer-two footer-bg-two mt--120 mt_md--80 mt_sm--60">
    <div class="container">
        <div class="row">
            <!-- single wized -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="footer-two-single-wized left">
                    <a href="/{{$lang}}" class="logo_footer ">
                        <img width="139" height="80" src="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false,'Mime' => 'webp'))}}" alt="{{$masters->iletisim->data->dynamic->baslik}}">
                    </a>
                    <p class="disc mt--20">
                        {{$masters->anasayfa_duzenle->data->dynamic->slogan_alt}}
                    </p>
                    <ul class="social-three-wrapper">
                        @if(!empty($masters->iletisim->data->dynamic->instagram))<li><a href="{{$masters->iletisim->data->dynamic->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li> @endif
                        @if(!empty($masters->iletisim->data->dynamic->facebook))<li><a href="{{$masters->iletisim->data->dynamic->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li> @endif
                        @if(!empty($masters->iletisim->data->dynamic->twitter))<li><a href="{{$masters->iletisim->data->dynamic->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li> @endif
                        @if(!empty($masters->iletisim->data->dynamic->youtube))<li><a href="{{$masters->iletisim->data->dynamic->youtube}}" target="_blank"><i class="fab fa-pinterest"></i></a></li> @endif


                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 mt_sm--50">
                <div class="footer-two-single-wized two">
                    <div class="wized-title-area">
                        <h6 class="wized-title">{{$translate->footer_menu_title}}</h6>

                    </div>
                    <div class="wized-2-body">


                        {!!Helpers::NavigationMenuCreator($ladders->resources,array('lang'=>$lang,'addClass'=>'','addParentClass'=>'','addItemParentClass'=>'','addItemClass'=>''),0)!!}




                    </div>
                </div>
            </div>
            <!-- single wized -->
            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 col-12 mt_sm--30 mt_md--30">
                <div class="footer-two-single-wized">

                    <div class="wized-2-body">

                        @if (!empty($masters->iletisim->data->dynamic->telefon))
                            <div class="contact-info-1">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="disc">
                                    <span>{{$translate->bize_ulasin}}</span>
                                    <a href="tel:{{$masters->iletisim->data->dynamic->telefon}}">{{$masters->iletisim->data->dynamic->telefon}}</a>
                                </div>
                            </div>
                        @endif
                        @if (!empty($masters->iletisim->data->dynamic->telefon2))
                            <div class="contact-info-1">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="disc">
                                    <span>{{$translate->bize_ulasin}}</span>
                                    <a href="tel:{{$masters->iletisim->data->dynamic->telefon2}}">{{$masters->iletisim->data->dynamic->telefon2}}</a>
                                </div>
                            </div>
                        @else
                            @if (!empty($masters->iletisim->data->dynamic->email))
                                <div class="contact-info-1">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="disc">
                                        <span>{{$translate->sorularinizi_sorun}}</span>
                                        <a href="mailto:{{$masters->iletisim->data->dynamic->email}}">{{$masters->iletisim->data->dynamic->email}}</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- single wized -->
            <!-- single wized -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="footer-two-single-wized ">
                    <div class="wized-2-body">
                        @if (!empty($masters->iletisim->data->dynamic->telefon2))
                            @if (!empty($masters->iletisim->data->dynamic->email))
                                <div class="contact-info-1">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="disc">
                                        <span>{{$translate->sorularinizi_sorun}}</span>
                                        <a href="mailto:{{$masters->iletisim->data->dynamic->email}}">{{$masters->iletisim->data->dynamic->email}}</a>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if (!empty($masters->iletisim->data->dynamic->adres))
                            <div class="contact-info-1">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="disc">
                                    <span>{{$translate->bizi_ziyaret_edin}}</span>
                                    <a href="#">{{$masters->iletisim->data->dynamic->adres}}</a>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
            <!-- single wized -->
        </div>
    </div>
</div>
<!-- footer area end -->

<!-- copyright-area start -->
<div class="rts-copy-right ptb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-h-2-wrapper">
                        <p class="disc">
                            ATI
                        </p>
                        <div class="right">
                            <ul> 
                                @foreach($ladders->sub_footer as $key => $sub_footer_menu)
                                @if($sub_footer_menu->link == null)
                                <li><a href="/{{$sub_footer_menu->slug}}">{{$sub_footer_menu->name}}</a></li>
                                @else
                                <li><a href="{{$sub_footer_menu->link}}" target="_blank">{{$sub_footer_menu->name}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- copyright-area end -->
<!-- ENd Header Area -->



