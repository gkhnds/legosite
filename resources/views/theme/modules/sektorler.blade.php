@if(!empty($datas->data)) @if($module->mobile_status == 'Pasif')
    <style>
        @media only screen and (max-width: 768px) {
            .sector{{$datas->component->uuid}} {
                display: none;
            }
        }
    </style>
@endif

<!-- SEKTÖRLER REFERANSLAR -->
<div class="rts-portfolio-area {{$module->class}} sector{{$datas->component->uuid}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-area-with-btn-home-7 portfolio-area">
                    @if($module->title_status == 'Aktif')
                        <div class="title-area-style-six text-start">
                            <div class="title">
                                <img src="/assets/images/banner/shape/pre-title.png" alt="{{$module->baslik}}">
                                <span class="pre">{{$module->baslik}}</span>
                                <img class="two" src="/assets/images/banner/shape/pre-title.png" alt="{{$module->baslik}}">
                            </div>

                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="row mt--20">
            <div class="col-lg-12">
                <div class="tab-content" id="myTabContent">

                    @foreach($ladders->sektor_kategorileri as $key2 => $kategori) @php $kategoriArray[$kategori->uuid] = $kategori->name; @endphp
                    <div class="tab-pane fade @if ($key2==0) show active @endif" id="{{$kategori->uuid}}" role="tabpanel" aria-labelledby="{{$kategori->uuid}}-tab">
                        <div class="row g-5">

                            @foreach ($datas->data as $key => $data) @if($data->dynamic->kategori[0] == $kategori->uuid )
                                <div class="{{$module->extra}}">
                                    <!-- single business case -->
                                    <div class="rts-business-case-s-2 style-home-7S">
                                        <a href="/{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}" class="thumbnail">
                                            <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode'=> true,'Mime'=>'webp'))}}" alt="{{$data->dynamic->baslik}}">
                                        </a>
                                        <div class="inner">
                                            <a href="/{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}">
                                                <h5 class="title">
                                                    {{$data->dynamic->baslik}}
                                                </h5>
                                            </a>

                                        </div>
                                        <a href="/{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}" class="over_link"></a>
                                    </div>
                                    <!-- single business case End -->
                                </div>
                            @endif @endforeach



                        </div>
                    </div>

                    @endforeach




                </div>
            </div>
        </div>
    </div>
</div>
<!-- SEKTÖRLER REFERANSLAR -->

@endif
