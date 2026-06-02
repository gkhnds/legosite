
@if($module->mobile_status == 'Pasif')
    <style>
        @media only screen and (max-width: 768px) {
            .news-style-four{
                display: none;
            }
        }
    </style>
@endif

<section class="google-map-section {{$module->class}} index">
    <div class="map-inner">

          {!! $masters->iletisim->data->dynamic->harita!!}

    </div>
</section>

