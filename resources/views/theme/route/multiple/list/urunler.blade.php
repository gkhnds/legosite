@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif

@section('meta')

    <title>{{$multiple->component->seo->title}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}} ">

    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection


@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])

    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">

            <div class="show-only-mobile" style="z-index: 1;">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onchange="window.location.href = window.location.origin+this.value;">
                    <option data-display="{{$translate->kategori_seciniz}}" value=""> {{$translate->kategori_seciniz}}</option>
                    @foreach ($ladders->urun_kategorileri as $key => $value)
                        <option data-display="{{$translate->kategori_seciniz}}" value="/{{$lang}}/{{$component_slug}}/{{$value->slug}}"> {{$value->name}}</option>
                         @if(isset($value->children))
                                    @foreach($value->children as $key => $subdata)
                                    <option data-display="{{$translate->seciniz}}" value="/{{$lang}}/{{$component_slug}}/{{$subdata->slug}}"> - {{$subdata->name}}</option>
                                    @endforeach
                         @endif
                    @endforeach
                </select>
            </div>

            <div class="show-only-mobile" style="z-index: 1;">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onchange="window.location.href = window.location.origin+this.value;">
                    <option data-display="{{$translate->tip_seciniz}}" value=""> {{$translate->tip_seciniz}}</option>
                    @foreach ($ladders->types as $key => $value)
                        <option data-display="{{$translate->tip_seciniz}}" value="/{{$lang}}/{{$component_slug}}/{{$value->slug}}"> {{$value->name}}</option>
                        @if(isset($value->children))
                            @foreach($value->children as $key => $subdata)
                                <option data-display="{{$translate->seciniz}}" value="/{{$lang}}/{{$component_slug}}/{{$subdata->slug}}"> - {{$subdata->name}}</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="row g-5">

                <div class="col-xl-3 col-md-12 col-sm-12 col-12 show-only-desktop">

                    <!-- single wized start -->
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h5 class="title">
                                {{$translate->kategoriler}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach($ladders->urun_kategorileri as $key => $data)
                                <!-- single categoris -->

                                <ul class="single-categories" >
                                    <li><a style="background-color: {{$data->icon}}" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">{{$data->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                                @if(isset($data->children))
                                    @foreach($data->children as $key => $subdata)
                                        <ul style="margin-left: 20px;" class="single-categories">
                                            <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>

                                        @if(isset($subdata->children))
                                            @foreach($subdata->children as $key => $third_level)
                                                <ul style="margin-left: 40px;" class="single-categories">
                                                    <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$third_level->slug}}"> {{$third_level->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                                </ul>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif


                                <!-- single categoris End -->
                            @endforeach
                        </div>

                        <div class="wized-header mt--40">
                            <h5 class="title">
                                {{$translate->types}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach($ladders->types as $key => $data)
                                <!-- single categoris -->

                                <ul class="single-categories" >
                                    <li><a style="background-color: {{$data->icon}}" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">{{$data->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                                @if(isset($data->children))
                                    @foreach($data->children as $key => $subdata)
                                        <ul style="margin-left: 20px;" class="single-categories">
                                            <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>

                                        @if(isset($subdata->children))
                                            @foreach($subdata->children as $key => $third_level)
                                                <ul style="margin-left: 40px;" class="single-categories">
                                                    <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$third_level->slug}}"> {{$third_level->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                                </ul>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif


                                <!-- single categoris End -->
                            @endforeach
                        </div>

                        <div class="wized-header mt--40">
                            <h5 class="title">
                                {{$translate->industries}}
                            </h5>
                        </div>
                        <div class="wized-body">
                            @foreach($ladders->sektor_kategorileri as $key => $data)
                                <!-- single categoris -->

                                <ul class="single-categories" >
                                    <li><a style="background-color: {{$data->icon}}" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">{{$data->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                                @if(isset($data->children))
                                    @foreach($data->children as $key => $subdata)
                                        <ul style="margin-left: 20px;" class="single-categories">
                                            <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                        </ul>

                                        @if(isset($subdata->children))
                                            @foreach($subdata->children as $key => $third_level)
                                                <ul style="margin-left: 40px;" class="single-categories">
                                                    <li style="margin-top: -9px;"><a style="line-height: 20px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$third_level->slug}}"> {{$third_level->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                                </ul>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif


                                <!-- single categoris End -->
                            @endforeach
                        </div>
                    </div>
                    <!-- single wizered End -->
                    <!-- single wizered start -->

                </div>
                <div class="col-xl-9 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">


                        @foreach ($multiple->data as $key => $value)
                        @if($value->dynamic->durum == 'Aktif')
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <!-- start blog grid inner -->
                                <div class="blog-grid-inner">
                                    <div class="blog-header">
                                        <a class="thumbnail" href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}">
                                            <img src="{{Helpers::CacheImageLink($value->dynamic->liste_resmi,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$value->dynamic->baslik}}">
                                        </a>

                                    </div>
                                    <div class="blog-body">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$value->static->slug}}">
                                            <h6 class="title">
                                                {{$value->dynamic->baslik}}
                                            </h6>
                                        </a>
                                        <p class="disc">
                                            {{$value->dynamic->spot_baslik}}
                                        </p>
                                    </div>
                                </div>
                                <!-- end blog grid inner -->
                            </div>
                            @endif
                        @endforeach

                    </div>
                    <!-- pagination area 
                    <div class="row mt--30">
                        <div class="col-12">
                            <div class="text-center">
                                <div class="pagination">
                                    @foreach($multiple->links as $order => $links)
                                        @if($order == 0)
                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$translate->sayfa) !!}"><i class="fal fa-angle-double-left"></i></a>
                                        @elseif($order == ($multiple->last_page + 1))
                                            <a href="{!! Helpers::GetApiUpdatePageUrl($links->url,$multiple->component->slug,$translate->sayfa) !!}"><i class="fal fa-angle-double-right"></i> </a>
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
                <!--rts blog wized area -->

            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->




@endsection

