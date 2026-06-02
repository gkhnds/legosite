@php $multiple = Connections::DataGetAll($single->component->uuid,$lang,null,null,'DESC',10); @endphp


@if(!empty($single->data->dynamic->dosya))
    <!-- single wizered start -->
    <div class="rts-single-wized download service">
        <div class="wized-header">
            <h5 class="title">{{$translate->dokumanlar}}</h5>
        </div>
        <div class="wized-body">

            @foreach(Helpers::FileList($single->data->dynamic->dosya) as $file)
                <!-- single downlaod area start -->
                <div class="single-download-area">
                    <img src="/assets/images/service/icon/07.svg" alt="{{$file->name}}">
                    <div class="mid">
                        <h6 class="title">
                            {{$file->name}}
                        </h6>
                        <span>{{$file->type}}</span>
                    </div>
                    <a class=" rts-btn btn-primary" href="{{$file->url}}"><i class="fal fa-arrow-right"></i></a>
                </div>
                <!-- single downlaod area End -->
            @endforeach





        </div>
    </div>

    <!-- single wizered End -->
@endif


    <!-- single wizered start -->
    <div class="rts-single-wized Categories service">
        <div class="wized-header">
            <h5 class="title">
                {{$multiple->component->seo->title}}
            </h5>
        </div>
        <div class="wized-body">
            @foreach ($multiple->data as $key => $value)
                <ul class="single-categories">
                    <li><a href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}" class=" @if($value->dynamic->baslik == $single->data->dynamic->baslik) current @endif"><i class="far fa-long-arrow-right"></i> {{$value->dynamic->baslik}} </a></li>
                </ul>
            @endforeach


        </div>
    </div>
    <!-- single wizered End -->








        @foreach($masters->moduller->data as $k => $modul)
            @if($modul->dynamic->tipi == 'Right')
                <div class="rts-single-wized  service">
                    <x-modules position="Right" view="{{$modul->dynamic->view}}" uuid="{{$modul->static->uuid}}"/>
                </div>
            @endif
        @endforeach




<!-- rts- blog wizered end area -->








