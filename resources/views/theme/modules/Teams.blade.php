
@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .team{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif
    <div class="rts-team-area rts-section-gap style-4 {{$module->class}} team{{$datas->component->uuid}}">
        <div class="container">
            <div class="row g-5 mt--20 mt_md--30 mt_sm--0">
                @foreach ($datas->data as $key => $data)

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="team-inner-two inner">
                            <a href="#" class="thumbnail">
                                <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$masters->seo->data->dynamic->keyword1}} {{$masters->seo->data->dynamic->keyword2}}">
                            </a>
                            <!-- Acquaintance area -->
                            <div class="acquaintance-area">
                                <div class="header">
                                    <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                    <span>{{$data->dynamic->detay}}</span>
                                </div>

                                <div class="acquaintance-social">
                                    @if(!empty($data->dynamic->facebook)) <a href="{{$data->dynamic->facebook}}"><i class="fab fa-facebook-f"></i></a> @endif
                                    @if(!empty($data->dynamic->twitter))<a href="{{$data->dynamic->twitter}}"><i class="fab fa-twitter"></i></a> @endif
                                    @if(!empty($data->dynamic->instagram))<a href="{{$data->dynamic->instagram}}"><i class="fab fa-instagram"></i></a> @endif
                                </div>
                            </div>
                            <!-- Acquaintance area -->
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endif
