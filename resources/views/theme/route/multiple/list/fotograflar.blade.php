@extends('theme.master')
@section('meta')
    <title>{{$multiple->component->seo->title}} - {{$masters->seo->data->dynamic->keyword1}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection
@section('content')


    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">


                @if (count($ladders->resim_kategorileri) > 1 )
                    <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">




                        <!-- single wizered start -->
                        <div class="rts-single-wized Categories service">
                            <div class="wized-header">
                                <h5 class="title">
                                    {{$translate->kategoriler}}
                                </h5>
                            </div>
                            <div class="wized-body">

                                @foreach($ladders->resim_kategorileri as $key => $kategori)
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

                <div class="@if (count($ladders->resim_kategorileri) > 1 )col-xl-9  @else col-xl-12 @endif col-md-12 col-sm-12 col-12">
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">




                        <div id="gallery" style="display:none;">
                            @foreach ($multiple->data as $key => $data)
                                @php $img = explode(',', $data->dynamic->resim) @endphp
                                @foreach($img as $k => $i)
                                    <a href="">
                                        <img alt="{{$data->dynamic->baslik}}"
                                             src="{{Helpers::CacheImageLink($i,array('ThumbsMode'=>false,'Mime'=>'webp','Resize'=>array('Width'=>250,'Height'=>350)))}}"
                                             data-image="{{Helpers::CacheImageLink($i,array('ThumbsMode' => false, 'Mime' => 'webp'))}}"
                                             data-description="{{$data->dynamic->baslik}}"
                                             data-title="{{$data->dynamic->baslik}}"
                                             style="display:none">
                                    </a>
                                @endforeach
                            @endforeach
                        </div>






                    </div>
                    <!-- service details left area end -->

                </div>


            </div>
        </div>
    </div>
    <!-- End service details area -->



@endsection

@section('customModuleContent')
    <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />
    <script type='text/javascript' src='/assets/unitegallery/themes/tiles/ug-theme-tiles.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery").unitegallery({
                tiles_type:"justified",
                @if($masters->anasayfa_duzenle->data->dynamic->galeri_resim_baslik == 'Aktif')
                tile_enable_textpanel:true,
                tile_textpanel_title_text_align: "center",
                tile_textpanel_always_on:true,
                @endif
            });


        });



    </script>
@endsection
