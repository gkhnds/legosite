@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    
 <title>{{$multiple->component->seo->title}} - Box Producer®</title>
    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection
@section('content')


    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])





    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <div class="row g-5">



                @if (count($ladders->sektor_kategorileri) >= 1 )
                    <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">




                        <!-- single wizered start -->
                        <div class="rts-single-wized Categories service">
                            <div class="wized-header">
                                <h5 class="title">
                                    {{$translate->kategoriler}}
                                </h5>
                            </div>
                            <div class="wized-body">

                                @foreach($ladders->urun_ozellik_gruplari as $key => $kategori)
                                    <ul class="single-categories">
                                        <li><a href="/{{$lang}}/{{$multiple->component->slug}}/{{$kategori->slug}}">{{$kategori->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                    </ul>

                                    @if(isset($kategori->children))
                                        @foreach($kategori->children as $key => $subdata)
                                            <ul style="margin-left: 20px;" class="single-categories">
                                                <li style="margin-top: -9px;"><a style="line-height: 9px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} </a></li>
                                            </ul>
                                        @endforeach
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <!-- single wizered End -->


                    </div>
                    <!-- rts- blog wizered end area -->

                @endif


                <div class="col-xl-9 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">


                        @foreach ($multiple->data as $key => $data)
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <!-- start blog grid inner -->
                                <div class="blog-grid-inner">
                                    <div class="blog-header">
                                        <a class="thumbnail" href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                            <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" alt="{{$data->dynamic->baslik}} {{$masters->seo->data->dynamic->keyword1}}">
                                        </a>

                                    </div>
                                    <div class="blog-body">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                            <h5 class="title">
                                                {{$data->dynamic->baslik}}
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                                <!-- end blog grid inner -->
                            </div>
                        @endforeach



                    </div>
                    <!-- pagination area -->

                    <!-- pagination area End -->
                </div>


            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->





@endsection

