
@if(!empty($datas->data))
@if($module->mobile_status == 'Pasif')
    <style>
        @media only screen and (max-width: 768px) {
            .whatsapp{
                display: none;
            }
        }
    </style>
@endif
<div class="whatsapp">


    <a target="new" rel="noreferrer" href="https://wa.me/{{ $masters->iletisim->data->dynamic->whatsapp }}?text={{ $masters->iletisim->data->dynamic->whatsapp_mesaj }}">
        <img src="{{Helpers::CacheImageLink($module->resim,array('ThumbsMode' => false,'Mime' => 'webp'))}}" width="50" height="50" alt="whatsapp">
    </a>
</div>
<style>
    .whatsapp
    {
        position: fixed;
        z-index: 999;
        left: 50px;
        cursor: pointer;
        transition: .2s;
        bottom: 53px;
    }
    .whatsapp img {
        height: 50px;
    }
    @media only screen and (max-width: 767px)
    {
        .whatsapp {
            left: 20px;
        }
        .whatsapp img {
            height: 35px;
            width: 35px;
        }
    }
</style>
@endif
