@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .sliderform{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif



        <!-- sliderFrom -->
    <div class="rts-banner-area banner-bg-h7 {{$module->class}} sliderform{{$datas->component->uuid}}" style="background-image:url({{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->formslider_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">
            <div class="row">
                <div class="col-xl-7">
                    <!-- bannerq inner six -->
                    <div class="rts-banner-wrapper-seven">
                        <p class="pre-title"><span>{{$masters->anasayfa_duzenle->data->dynamic->formslider_ust_baslik}}</span></p>
                        <h1 class="banner-title">
                            {{$masters->anasayfa_duzenle->data->dynamic->formslider_baslik}}
                        </h1>
                        <p class="disc">
                            {{$masters->anasayfa_duzenle->data->dynamic->formslider_spot}}
                        </p>
                        <div class="button-area">
                            @if( !empty($masters->anasayfa_duzenle->data->dynamic->formslider_buton_title_1) )
                                <a href="{{$masters->anasayfa_duzenle->data->dynamic->formslider_buton_link_1}}" class="rts-btn btn-primary six mr--30">{{$masters->anasayfa_duzenle->data->dynamic->formslider_buton_title_1}}</a>
                            @endif

                            @if( !empty($masters->anasayfa_duzenle->data->dynamic->formslider_buton_title_2) )
                                <a href="{{$masters->anasayfa_duzenle->data->dynamic->formslider_buton_link_2}}" class="rts-btn btn-primary deactive">{{$masters->anasayfa_duzenle->data->dynamic->formslider_buton_title_2}}</a>
                            @endif
                        </div>
                    </div>
                    <!-- bannerq inner six ENd -->
                </div>



                @if($masters->anasayfa_duzenle->data->dynamic->formslider_form_durumu == 'Aktif')
                    <div class="col-xl-5">
                        <div class="rts-contact-form-area six">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rts-contact-fluid">
                                            <div class="rts-title-area contact-fluid text-center">
                                                <h2 class="title">{{$masters->anasayfa_duzenle->data->dynamic->formslider_form_title}}</h2>
                                            </div>
                                            <div class="form-wrapper">
                                                <div id="form-messages"></div>
                                                <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form SubmitForm">
                                                    <div class="name-email">
                                                        <input type="text" name="isim" placeholder="{{$translate->adiniz}}" required>
                                                        <input type="text" name="telefon" placeholder="{{$translate->telefon}}" required>
                                                    </div>
                                                    <input type="email" name="email" placeholder="{{$translate->email}}" required>

                                                    @if($masters->anasayfa_duzenle->data->dynamic->formslider_select_durum == 'Aktif')
                                                        <select name="Seçim" id="Seçim">

                                                            @php $selectData = explode(',', $masters->anasayfa_duzenle->data->dynamic->formslider_select_data) @endphp
                                                            @foreach($selectData as $ky => $value)
                                                                <option value="{{$value}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                    <textarea placeholder="{{$translate->mesaj}}" name="mesaj"></textarea>

                                                    <button class="g-recaptcha rts-btn btn-primary"  type="button" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain'  id="sbtn" name="submit-form">{{$translate->gonder}}</button>

                                                    <style>
                                                        .grecaptcha-badge{
                                                            display: none;
                                                        }
                                                    </style>
                                                    <input type="hidden" name="validate_message" value="{{$translate->form_uyari_mesaji}}">
                                                    <input type="hidden" name="accept_message" value="{{$translate->form_gonderildi}}">
                                                    <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                                                    <input type="hidden" name="mail_backup" value="1">
                                                    <input type="hidden" name="custom_form" value="1">
                                                    <input type="hidden" name="mail_view" value="addon/mail/CustomFormMail">
                                                    <input type="hidden" name="link" value="{{$masters->anasayfa_duzenle->data->dynamic->formslider_form_title}}">
                                                    <input type="hidden" name="subject" value="{{$masters->anasayfa_duzenle->data->dynamic->formslider_form_title}}">
                                                    <input type="hidden" name="process" value="SendOnlyMail">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
    <!-- sliderFrom -->


    @endif
















