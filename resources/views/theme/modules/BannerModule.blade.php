@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .banner{{$datas->component->uuid}}{
                    display: none;
                }
            }
        </style>
    @endif

    <!-- banner   -->
    <div class="working-process-area rts-section-gap working-process-bg {{$module->class}} banner{{$datas->component->uuid}}">
        <div class="container">

            <div class="row g-5  align-items-center text-center">

                @foreach($datas->data as $key => $data)
                    @if($data->dynamic->view == 'Anasayfa')
                        <div class="{{!empty($module->extra) ? $module->extra : 'col-lg-4 col-md-6 col-sm-12' }} news-block">
                            @if(!empty($data->dynamic->link))<a href="{{$data->dynamic->link}}" target="new">@endif
                                <img style="border-radius: 20px;" src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false,'Mime' => 'webp'))}}" alt="{{$data->dynamic->alt}}">
                                @if(!empty($data->dynamic->link))</a>@endif
                        </div>
                    @endif
                @endforeach



            </div>
        </div>
    </div>
    <!-- banner   -->
@endif
