@extends('theme.master')


@section('meta')
    <title>@if (empty($single->data->dynamic->meta_title)) {{$single->data->dynamic->baslik}} - {{$single->component->seo->title}} @else {{$single->data->dynamic->meta_title}} - {{$single->component->seo->title}} @endif</title>

    <meta name="description" content="{{$single->data->dynamic->meta_description}}">

@endsection

@section('social')

    @include('theme.partials.single.schema-and-meta', ['lang'=>$lang, 'single'=>$single, 'masters'=>$masters])

@endsection

@section('content')



    @include('theme.partials.single.breadcrumb', ['masters'=>$masters, 'single'=>$single])

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">
                @if($single->data->dynamic->sidebar == "Aktif") <div class="col-xl-8 col-md-12 col-sm-12 col-12"> @else <div class="col-xl-12 col-md-12 col-sm-12 col-12"> @endif
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">


                     



                        <p class="disc">
                            {!! $single->data->dynamic->detay !!}

                        </p>

                        @if(!empty($single->data->dynamic->video))
                            <hr>
                            <iframe id="player" type="text/html" width="640" height="390"
                                    src="{{Helpers::GetVideoPlayerLinkChange($single->data->dynamic->video)}}"
                                    frameborder="0"></iframe>

                        @endif




                    </div>
                    <!-- service details left area end -->

                </div>
                @if($single->data->dynamic->sidebar == "Aktif") 
                <!--rts blog wizered area -->
                <div class="col-xl-4 col-md-12 col-sm-12 col-12 mt_lg--60 pl--50 pl_md--0 pl-lg-controler pl_sm--0">

                    @include('theme.partials.single.sidebar', ['single'=>$single, 'lang'=>$lang])

                </div>
                <!-- rts- blog wizered end area -->
               @endif
            </div>
        </div>
    </div>
    <!-- End service details area -->




@endsection
@section('customModuleContent')

    <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />

    <script type='text/javascript' src='/assets/unitegallery/themes/slider/ug-theme-slider.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery").unitegallery({
                gallery_theme: "slider",
                slider_scale_mode: "fit"
            });
        });



    </script>
@endsection
