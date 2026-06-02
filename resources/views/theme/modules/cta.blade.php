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

    <!-- CTA 1  -->
    <div class="rts-cta-section-start rts-section-gap {{$module->class}}" style="background-image:url({{Helpers::CacheImageLink($masters->anasayfa_duzenle->data->dynamic->cta_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});" >
        <div class="container">
            <div class="row">
                <div class="cta-h2-wrapper text-center">

                    <div class="body">
                        <p class="info"><span>{{$masters->anasayfa_duzenle->data->dynamic->cta_spot}}</span></p>
                        <a href="{{$masters->anasayfa_duzenle->data->dynamic->cta_link}}" class="number">{{$masters->anasayfa_duzenle->data->dynamic->cta_no}}</a>
                        <a href="{{$masters->anasayfa_duzenle->data->dynamic->cta_link}}" class="rts-btn btn-primary-2">{{$masters->anasayfa_duzenle->data->dynamic->cta_button_title}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA 1  -->
@endif
