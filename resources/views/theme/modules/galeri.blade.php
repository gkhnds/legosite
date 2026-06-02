@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .gallery{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif


    <!-- gallery -->
    <div class="rts-client-area {{$module->class}} gallery{{$datas->component->uuid}}">
        @if($module->title_status == 'Aktif')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title-area-business-case-3">
                        <div class="title-area">
                            <span class="sub">{{$module->baslik}}</span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-12">


                        <div id="gallery-home" style="display:none;">


                            @foreach($datas->data as $data)
                                @foreach($data->dynamic->kategori as $kategoriTek)
                                    @if($kategoriTek == $module->extra)
                                    
                                        @foreach(Helpers::CacheImageList($data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp')) as $key => $image)


 

                                        <a href="">
                                    <img alt="{{$masters->seo->data->dynamic->keyword1}}"
                                         src="{{$image}}"
                                         data-image="{{$image}}"
                                         data-description=""
                                         style="display:none">

                                            <amp-img alt="{{$masters->seo->data->dynamic->keyword1}}" src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode'=>false,'Mime'=>'webp','Resize'=>array('Width'=>250,'Height'=>350)))}}" width="250" height="350" layout="responsive" > </amp-img>
                                </a>

                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach

                        </div>

                </div>
            </div>
        </div>
    </div>
    <!-- gallery-->
@endif

@section('customModuleContent')
    <script type='text/javascript' src='/assets/unitegallery/js/jquery-11.0.min.js'></script>
    <script type='text/javascript' src='/assets/unitegallery/js/unitegallery.min.js'></script>
    <link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />

    <script type='text/javascript' src='/assets/unitegallery/themes/tiles/ug-theme-tiles.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery-home").unitegallery({
                tiles_justified_space_between:10,
                tiles_type: "justified",
            });


        });
    </script>
@endsection
