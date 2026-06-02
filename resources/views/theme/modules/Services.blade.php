@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .services{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- services -->
    <div class="rts-service-area rts-section-gap  {{$module->class}} services{{$datas->component->uuid}}">
        <div class="container">
            @if($module->title_status == 'Aktif')
                <div class="row">
                    <div class="title-area service-h2">
                        <h2 class="title"><a href="{{$lang}}/{{$datas->component->slug}}">{{$module->baslik}}</a> </h2>
                    </div>
                </div>
            @endif
            <div class="row g-5 ">

                @foreach($datas->data as $key => $data)
                    <div class="{{$module->extra}} col-lg-4 col-md-6 col-sm-6 col-12">
                        <!-- single service start -->
                        <div class="rts-single-service-h2">
                            <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}" class="thumbnail">
                                <img width="550" height="350" src="{{Helpers::CacheImageLink($data->dynamic->liste_resmi,array('ThumbsMode' => true,'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                <amp-img alt="{{$data->dynamic->baslik}} {{$masters->seo->data->dynamic->keyword1}}" src="{{Helpers::CacheImageLink($data->dynamic->liste_resmi,array('ThumbsMode' => true,'Mime' => 'webp'))}}" width="250" height="159" layout="responsive" > </amp-img>
                            </a>
                            <div class="body">
                                <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">
                                    <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                </a>
                                @if(!empty($data->dynamic->spot))
                                    <p class="disc">
                                        {{$data->dynamic->spot}}
                                    </p>
                                @endif
                                    <a href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}" class="btn-red-more">{{$translate->detay}}<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!-- single service End -->
                    </div>

                @endforeach

            </div>
        </div>
    </div>
    <!-- services End -->
@endif
