@extends('theme.master')

@section('meta')

@php
    if (isset($tag) && preg_match('/porno|film|movie|porn|sex|seks|hardcore|nude|nudity|erotic|xxx|18\+|18\s*yas|18\s*yaş|anal|oral|fetish|fetiş|vajina|penis|sikiş|sikis|s3ks|s\.e\.x|bdsm|blowjob|gay|lesbian|lezbiyen|trans|femdom|cum|milf|teen|fuck|suck|masturbation|mastürbasyon|boşalma|orgazm/i', $tag)) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
@endphp






@if(empty($tag)) 
    <?php $tag = 'kutu'; ?> 
@endif
    <title>{{$tag}} {{$translate->seach_results}}</title>

                         <meta name="description" content="{{$tag}} {{$translate->search_page_desc}}">
@endsection

@section('content')
    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area bg_image" style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">{{$tag}}</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <div class="row g-5">



                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">


                        @php $datais = 0; @endphp
                        @foreach($multiple as $data)

                            @if(isset($data->data))
                                @if(!empty($data->data))
                                    @php $datais = 1; @endphp
                                @endif
                                @foreach ($data->data as $key => $value)

                                    
                                    
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <!-- single service start -->
                                        <div class="rts-single-service-h2">
                                            <a href="/{{$lang}}/{{$data->component->slug}}/{{$value->static->slug}}" class="thumbnail">
                                                @if(isset($value->dynamic) && isset($value->dynamic->liste_resmi))
                                                    <img src="{{ Helpers::CacheImageLink($value->dynamic->liste_resmi, ['ThumbsMode' => true, 'Mime' => 'webp']) }}" alt="{{ $value->dynamic->baslik }}">
                                                @elseif(isset($value->dynamic) && isset($value->dynamic->resim) && !empty($value->dynamic->resim))
                                                    <img src="{{ Helpers::CacheImageLink($value->dynamic->resim, ['ThumbsMode' => true, 'Mime' => 'webp']) }}" alt="{{ $value->dynamic->baslik }}">
                                                @endif
                                            </a>
                                            <div class="body">
                                                <a href="/{{$lang}}/{{$data->component->slug}}/{{$value->static->slug}}">
                                                    <h5 class="title">{{$value->dynamic->baslik}}</h5>
                                                </a>
                                                @if(!empty($value->dynamic->spot_baslik))
                                                <span>{{$value->dynamic->spot_baslik}}</span>
                                                @endif
                                                @if(!empty($value->dynamic->spot))
                                                <span>{{$value->dynamic->spot}}</span>
                                                @endif
                                                                            
                                            </div>
                                        </div>
                                        <!-- single service End -->
                                    </div>

                                @endforeach


                            @endif



                        @endforeach
                      
 



                        
                        


                    </div>

                </div>
                <!--rts blog wized area -->

            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->



@endsection

