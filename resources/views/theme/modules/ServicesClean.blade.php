@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .servicesClean{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- ServicesClean -->
    <div class="rts-service-area  rts-section-gapBottom {{$module->class}} servicesClean{{$datas->component->uuid}}">
        @if($module->title_status == 'Aktif')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="rts-title-area service text-center">
                            <p class="pre-title">
                                {{$module->baslik}}
                            </p>
                            <h2 class="title">{{$module->baslik}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid service-main plr--120-service  plr_md--0 pl_sm--0 pr_sm--0 ">
            <div class="background-service row">

                @foreach($datas->data as $key=> $data)
                    <!-- start single Service -->
                    <div class="{{$module->extra}} col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="service-one-inner one">

                            <div class="service-details">
                                <a href="/{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">
                                    <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                </a>
                                <p class="disc">@php $detay = \Illuminate\Support\Str::words(strip_tags($data->dynamic->detay), 20,'...');  @endphp
                                    {{str_replace('&nbsp;', ' ', $detay)}}
                                </p>
                                <a class="rts-read-more btn-primary" href="/{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}"><i
                                        class="far fa-arrow-right"></i>{{$translate->detay}}</a>
                            </div>
                        </div>
                    </div>
                    <!-- end single Services -->
                @endforeach
            </div>

        </div>
    </div>
    <!-- ServicesClean -->

@endif
