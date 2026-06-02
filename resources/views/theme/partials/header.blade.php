<!-- start header area -->
<header class="header-two header--sticky">
    <div class="header-top">
        <div class="content">
            <div class="left-header-top">
                <p class="top-details">
                    {{$masters->anasayfa_duzenle->data->dynamic->slogan}}
                </p>
            </div>
            <div class="right-header-top">

                @if($masters->e_ticaret->data->dynamic->durum->value == 'True')
                    @if(Session::has('Cart.'.$lang)  and !empty(Session::get('Cart.'.$lang)))
                        <ul>
                            <li><a style="color: {{$masters->tasarim_ayarlari->data->dynamic->color1}}; margin-right: 10px;" href="/{{$lang}}/cart"><i class="far fa-shopping-cart"></i>({{count(Session::get('Cart.'.$lang))}})</a></li>
                        </ul>
                    @endif
                @endif
                <!-- header online time -->
                <div class="working-time" id="workingTime">
                    <i class="far fa-clock"></i>
                    <span id="turkeyTime">Turkey Time: Loading...</span>
                </div>

                <!-- header online time -->
                @if (count((array)$languages) > 1)
                    <div class="ht-social">
                        <ul>
                            @foreach ($languages as $mylang)
                                <li><a href="/{{$mylang->short_name}}" aria-label="{{$mylang->name}} page"><img alt="{{$mylang->name}}" width="27" height="27" src="/lego/main/flags/1x1/{{$mylang->short_name}}.svg" style="width: 27px;border-radius: 40px;"></a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="ht-social">

                    <ul>
                        @if(!empty($masters->iletisim->data->dynamic->instagram))<li><a href="{{$masters->iletisim->data->dynamic->instagram}}" aria-label=" instagram page" target="_blank"><i class="fab fa-instagram"></i></a></li> @endif
                        @if(!empty($masters->iletisim->data->dynamic->facebook))<li><a href="{{$masters->iletisim->data->dynamic->facebook}}" aria-label=" facebook page" target="_blank"><i class="fab fa-facebook-f"></i></a></li> @endif
                        @if(!empty($masters->iletisim->data->dynamic->twitter))<li><a href="{{$masters->iletisim->data->dynamic->twitter}}" aria-label=" twitter page" target="_blank"><i class="fab fa-twitter"></i></a></li> @endif
                        @if(!empty($masters->iletisim->data->dynamic->youtube))<li><a href="{{$masters->iletisim->data->dynamic->youtube}}" aria-label=" youtube page" target="_blank"><i class="fab fa-pinterest"></i></a></li> @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="content">
            <div class="header-left">
                <a class="thumbnail" href="/{{$lang}}">
                    <img width="80" height="80" src="{{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->logo,array('ThumbsMode' => false,'Mime' => 'webp'))}}" alt="{{$masters->iletisim->data->dynamic->baslik}}">
                </a>
                <nav class="nav-main mainmenu-nav d-none d-xl-block">


                    {!!Helpers::NavigationMenuCreator($ladders->header_menu,array('lang'=>$lang,'addClass'=>'mainmenu','addParentClass'=>'has-droupdown','addItemParentClass'=>'','addItemClass'=>'submenu menu-link3'),0)!!}


                </nav>
            </div>

            <div class="header-right">

                @if (!empty($masters->iletisim->data->dynamic->telefon))
                    <div class="call-area">
                        <div class="icon">
                            <img class="menu-dark" src="/assets/images/call-icon.png" width="40" height="40" alt="Menu-icon">
                        </div>
                        <div class="number-area">

                            <a href="tel:{{$masters->iletisim->data->dynamic->telefon}}">
                                <h6 class="call">{{$masters->iletisim->data->dynamic->telefon}}</h6>
                            </a>
                            @if (!empty($masters->iletisim->data->dynamic->telefon2))
                                <a href="tel:{{$masters->iletisim->data->dynamic->telefon2}}">
                                    <h6 class="call">{{$masters->iletisim->data->dynamic->telefon2}}</h6>
                                </a>
                            @endif

                        </div>
                    </div>
                @endif

                @if(!empty($masters->anasayfa_duzenle->data->dynamic->header_buton_linki) && !empty($masters->anasayfa_duzenle->data->dynamic->header_buton_adi))
                    <a class="rts-btn btn-primary-2 menu-block-none" href="{{$masters->anasayfa_duzenle->data->dynamic->header_buton_linki}}" target="new">{{$masters->anasayfa_duzenle->data->dynamic->header_buton_adi}}</a>
                @endif
                @if($masters->anasayfa_duzenle->data->dynamic->arama_durumu == 'Aktif')
                    <button id="search" title="{{$translate->ara}}"  aria-label="search" aria-labelledby="searchInput1" class="rts-btn btn-primary-alta ml--20"><i class="far fa-search"></i></button>
                @endif
                <button id="menu-btn" aria-label="menu" class="menu rts-btn btn-primary-alta ml--20">
                    <img class="menu-dark" src="/assets/images/icon/menu.png" alt="Menu-icon">
                    <img class="menu-light" src="/assets/images/icon/menu-light.png" alt="Menu-icon">
                </button>

            </div>
        </div>
    </div>
</header>

<div id="side-bar" class="side-bar">
    <button class="close-icon-menu" aria-label="close-sidebar"><i class="far fa-times"></i></button>
    <!-- inner menu area desktop start -->
    <div class="rts-sidebar-menu-desktop">
       

        <div class="body d-none d-xl-block">

        </div>
        <div class="body-mobile d-block d-xl-none">
            <nav class="nav-main mainmenu-nav">


                {!!Helpers::NavigationMenuCreator($ladders->header_menu,array('lang'=>$lang,'addClass'=>'mainmenu','addParentClass'=>'has-droupdown','addItemParentClass'=>'','addItemClass'=>'submenu'),0)!!}


            </nav>
           

            @if (count((array)$languages) > 1)
                <div class="social-wrapper-two menu mobile-menu">
                        @foreach ($languages as $mylang)
                            <a href="/{{$mylang->short_name}}" ><img alt="{{$mylang->name}}"   src="/lego/main/flags/1x1/{{$mylang->short_name}}.svg" width="27" height="27" style="border-radius: 40px;"></a>
                        @endforeach
                </div>
            @endif

            @if(!empty($masters->anasayfa_duzenle->data->dynamic->header_buton_linki) && !empty($masters->anasayfa_duzenle->data->dynamic->header_buton_adi))
                <a class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu" href="{{$masters->anasayfa_duzenle->data->dynamic->header_buton_linki}}">{{$masters->anasayfa_duzenle->data->dynamic->header_buton_adi}}</a>
            @endif

        </div>
    </div>
    <!-- inner menu area desktop End -->
</div>


<div id="anywhere-home"></div>

@if($masters->anasayfa_duzenle->data->dynamic->arama_durumu == 'Aktif')
    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <form action="/{{$lang}}/search" method="POST" data-action="/{{$lang}}/search" id="SearchForm" style="width: -webkit-fill-available;">
                        <input id="searchInput1" name="search-field" class="search-input searchInput" type="text" value="" placeholder="{{$translate->ara}}" required>
                        <button  type="submit" aria-label="search"><i class="far fa-search"></i></button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>
@endif
