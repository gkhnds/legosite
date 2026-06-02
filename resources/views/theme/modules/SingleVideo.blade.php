@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .video{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif





    <div class="rts-customer-feedback-area-six rts-section-gap bg-feedback-seven {{$module->class}} video{{$datas->component->uuid}}" @if(!empty($module->resim)) style="background-image:url({{Helpers::CacheImageLink($module->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});" @endif>
        <div class="container">

            <div class="row mt--40">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="thumbnail-image-gallery text-center" >
                                <img src="{{Helpers::GetVideoThumbnail($masters->anasayfa_duzenle->data->dynamic->video)}}" alt="thumbnail-image">
                                <a href="#" class="vedio-icone" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <span id="" class="video-play-button">
                                    <img src="/assets/images/about/shape/play-btn.png" alt="{{$masters->seo->data->dynamic->keyword1}} {{$masters->seo->data->dynamic->keyword2}}">
                                    <span></span>
                                </span>
                                    <div id="video-overlay" class="video-overlay">
                                        <span class="video-overlay-close">×</span>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>











    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe width="700" height="355" src="{{Helpers::GetVideoPlayerLinkChange($masters->anasayfa_duzenle->data->dynamic->video)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicVideoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 d-flex align-items-center">
                    <div class="ratio ratio-4x3" id="player">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" id="playBtn">Play</button>
                    <button type="button" class="btn btn-dark" id="pauseBtn">Pause</button>
                </div>
            </div>
        </div>
    </div>








@endif
