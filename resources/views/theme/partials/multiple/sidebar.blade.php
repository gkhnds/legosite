<div class="blog-sidebar default-sidebar ">
    @if(isset($multiple->data))
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h3>{{($translate->son_haberler)}}</h3>
            </div>

            <div class="post-inner">
                <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                    @foreach ($multiple->data as $key => $value)
                        @if($key < 3)
                            <div class="post">
                                @if(!empty($value->dynamic->resim))
                                    <figure class="image-box">
                                        <img src="{{Helpers::CacheImageLink($value->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" data-src="{{Helpers::CacheImageLink($value->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" title="{{$value->dynamic->baslik}}" class="lazy" alt="{{$value->dynamic->baslik}}">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}" class="link"><i class="fas fa-angle-right"></i>{{($translate->detay)}}</a>
                                    </figure>
                                @endif
                                <div class="post-content">
                                    <h5><a href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}">{{$value->dynamic->baslik}}</a></h5>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif

        @foreach($masters->moduller->data as $k => $modul)
            @if($modul->dynamic->tipi == 'Right')
                <x-modules position="Right" view="{{$modul->dynamic->view}}" uuid="{{$modul->static->uuid}}"/>
            @endif
        @endforeach


    <div class="sidebar-widget tags-widget">
        <div class="widget-title">
            <h3>{{($translate->etiketler)}}</h3>
        </div>
        <div class="widget-content">
            <ul class="tags-list clearfix">
                @foreach(explode(',',$masters->seo->data->dynamic->keywords) as $key => $value)
                    <li><a href="#{{$masters->seo->data->dynamic->keyword1}} {{$value}}">{{$value}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>