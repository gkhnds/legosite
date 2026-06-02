@if(!empty($datas->data))
    @if($module->mobile_status == 'Pasif')
        <style>
            @media only screen and (max-width: 768px) {
                .mhide1{
                    display: none;
                }
            }
        </style>
    @endif
@foreach($datas->data as $key => $data)
@if($data->dynamic->view == 'İç Sayfalar')
    <div class="mhide1 sidebar-widget post-widget" style="padding: 0;">
        <a href="{{$data->dynamic->link}}">
            <div class="post-inner">

                <img style="width: 100%;" src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => false,'Mime' => 'webp'))}}" alt="{{$data->dynamic->alt}}">
            </div>
        </a>
    </div>
    @endif
@endforeach
@endif
