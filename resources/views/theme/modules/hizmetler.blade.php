@if(!empty($datas->data)) @if($module->mobile_status == 'Pasif')
    <style>
        @media only screen and (max-width: 768px) {
            .sector{{$datas->component->uuid}} {
                display: none;
            }
        }
    </style>
@endif

 <!--portfolio-area start-->
    <section class="portfolio-area style-5 pt--120 pb--120 pt_xs--60 pt_xs--60">
        <div class="container">
            <div class="row">
                 @foreach($datas->data as $key => $data)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item">
                            <div class="portfolio-wrapper">
                                @if(!empty($data->dynamic->resim))
                                    <div class="img-fluid">
                                        <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}} {{$masters->seo->data->dynamic->keyword1}}">
                                    </div>

                                @endif

                                <div class="single-portfolio">

                                    <h4 class="portfolio-title text-white">{{$data->dynamic->baslik}}</h4>
                                    <span>{{$data->dynamic->spot}}</span>
                                </div>
                                <a class="pf-btn" href="{{$lang}}/{{$datas->component->slug}}/{{$data->static->slug}}"><i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!--portfolio-area end-->
@endif
