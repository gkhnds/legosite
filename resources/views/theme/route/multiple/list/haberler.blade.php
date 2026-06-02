@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection

@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])




    <!-- rts blog list area -->
    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <!-- rts blog post area -->
                <div class="col-xl-8 col-md-12 col-sm-12 col-12">



                    @foreach ($multiple->data as $key => $data)
                        <!-- single post -->
                        <div class="blog-single-post-listing">
                            @if(!empty($data->dynamic->resim))
                                <div class="thumbnail">
                                    <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}} {{$masters->seo->data->dynamic->keyword1}}">
                                </div>
                            @endif
                            <div class="blog-listing-content">


                                @if(!empty($data->dynamic->kaynak))


                                    <div class="user-info">
                                        <!-- single info -->
                                        <div class="single">
                                            <i class="far fa-link"></i>
                                            <span><a target="new" href="{{$data->dynamic->kaynak}}">{{$translate->kaynak_haber}}</a></span>
                                        </div>

                                    </div>
                                @endif

                                <a class="blog-title" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                    <h3 class="title">{{$data->dynamic->baslik}}</h3>
                                </a>
                                <p class="disc">
                                    @php $detay = \Illuminate\Support\Str::words(strip_tags($data->dynamic->detay), 60,'...');  @endphp
                                    {{str_replace('&nbsp;', ' ', $detay)}}

                                </p>
                                <a class="rts-btn btn-primary" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">{{$translate->detay}}</a>



                            </div>
                        </div>
                        <!-- single post End-->

                    @endforeach

                    <!-- single post End-->
                    <!-- pagination area -->
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <div class="pagination">
                                    @foreach($multiple->links as $order => $links)
                                        @if($order == 0)
                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$translate->sayfa) !!}"><i class="fal fa-angle-double-left"></i></a>
                                        @elseif($order == ($multiple->last_page + 1))
                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$translate->sayfa) !!}"><i class="fal fa-angle-double-right"></i></a>
                                        @else

                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$translate->sayfa) !!}" @if($links->active == 1) class="active" @endif>
                                                {{$links->label}}
                                            </a>

                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pagination area End -->
                </div>
                <!-- rts-blog post end area -->
                <!--rts blog wized area -->
                <div class="col-xl-4 col-md-12 col-sm-12 col-12 mt_lg--60">

                    <!-- single wized start -->
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h5 class="title">
                                {{$multiple->component->seo->title}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach ($multiple->data as $key => $data)
                                <ul class="single-categories">
                                    <li><a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">{{$data->dynamic->baslik}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                            @endforeach


                        </div>
                    </div>
                    <!-- single wized End -->

                    @foreach($masters->moduller->data as $k => $modul)
                        @if($modul->dynamic->tipi == 'Right')
                            <x-modules position="Right" view="{{$modul->dynamic->view}}" uuid="{{$modul->static->uuid}}"/>
                        @endif
                    @endforeach

                </div>
                <!-- rts- blog wized end area -->
            </div>
        </div>
    </div>
    <!-- rts blog list area End -->


@stop
