@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .infobox{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- INFOBOX   -->
    <div class="working-process-area rts-section-gap working-process-bg {{$module->class}} infobox{{$datas->component->uuid}}">
        <div class="container">
            @if($module->title_status == 'Aktif')
                <div class="row mt--0">
                    <div class="title-area text-center working-process">

                        <h2 class="title">{{$module->baslik}}</h2>
                    </div>
                </div>
            @endif
            <div class="row g-5 mt--20 align-items-center">

                @foreach($datas->data as $key => $data)
                    <div class="{{$module->extra}} col-lg-4 col-md-6 col-sm-6 col-12">
                        <!-- single wirking process -->
                        <div class="rts-working-process-1 text-center">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{Helpers::CacheImageLink($data->dynamic->ikon,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}}" style="max-width: 100px;">
                                </div>
                            </div>
                            <div class="content">
                                <h6 class="title">{{$data->dynamic->baslik}}</h6>
                                <p class="disc">
                                    {{$data->dynamic->spot}}
                                </p>
                            </div>
                        </div>
                        <!-- single wirking process End -->
                    </div>
                @endforeach



            </div>
        </div>
    </div>
    <!-- INFOBOX   -->
@endif
