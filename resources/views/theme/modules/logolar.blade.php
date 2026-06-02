@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .logogallery{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- marka logolar -->
    <div class="rts-client-area {{$module->class}} logogallery{{$datas->component->uuid}}">
        <div class="container">
            <div class="row">
                <div class="col-12">


                        <div id="logogallery" style="display:none;">


                        @foreach($datas->data as $key => $data)



                                <a href="">
                                    <img alt="{{$masters->seo->data->dynamic->keyword1}} {{$masters->seo->data->dynamic->keyword2}}"
                                         src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}"
                                         data-image="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}}"
                                         data-description=""
                                         style="display:none">
                                </a>

                        @endforeach

                        </div>

                </div>
            </div>
        </div>
    </div>
    <!-- marka logolar -->
@endif

@section('customModuleContent')


    <script type='text/javascript' src='/assets/unitegallery/themes/carousel/ug-theme-carousel.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#logogallery").unitegallery();


        });
    </script>
@endsection
