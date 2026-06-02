
@php

              /* Özel Modül Optimizasyonu Bu Alanda Yapılır Extra Değişkenine Dizi Olarak Atanır! */
               if ($module->baslik == 'Popup'){
                   if ($datas->data->dynamic->durum == 'Aktif') {
                       if ($datas->data->dynamic->calisma == 'Sürekli') {
                           Session::forget('Popup');
                           $extra = array('Popup' => 1);
                       }else{
                           $ses = (int)Session::get('Popup');
                           Session::put('Popup', $ses + 1);
                           $extra = array('Popup' => Session::get('Popup'));
                       }
                   }
               }
               /* Özel Modül Optimizasyonu Bu Alanda Yapılır Extra Değişkenine Dizi Olarak Atanır! */
@endphp


@if($datas->data->dynamic->durum == 'Aktif' and $extra['Popup'] == 1)
    <!-- Modal -->

    /*
    <style>
        .modal-dialog {
            min-height: {{$datas->data->dynamic->uzunluk}};
            min-width: {{$datas->data->dynamic->genislik}};
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: auto;
        }
        @media(max-width: 768px) {
            .modal-dialog {
                min-height: calc(100vh - 20px);
                width: 100%;
                padding:0.5em;
                margin: 0;

            }
        }
    </style>

<div class="modal fade" id="popup" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border:0; @if(empty($datas->data->dynamic->bg_color)) background-color: transparent;  @else background-color: {{$datas->data->dynamic->bg_color}}; @endif" @if(!empty($datas->data->dynamic->resim)) style="background: url({{Helpers::CacheImageLink($datas->data->dynamic->resim,array('ThumbsMode' => false,'Mime' => 'webp'))}});height: 400px" @endif>
            <div class="modal-body">
                    @if(!empty($datas->data->dynamic->metin))
                        {!! $datas->data->dynamic->metin !!}
                    @endif

                    @if(!empty($datas->data->dynamic->resim))
                           <img src="{{Helpers::CacheImageLink($datas->data->dynamic->resim,array('ThumbsMode' => false,'Mime' => 'webp'))}}">
                    @endif


            </div>
        </div>
    </div>
</div>

@endif
<script type="text/javascript">
    $(document).ready(function() {
        var brow = navigator.userAgent;
        if (/mobi/i.test(brow)) {
            @if($datas->data->dynamic->mobil_gorunum == 'Pasif')
            $('#popup').modal('hide');
            @else
            $('#popup').modal('show');
            @endif
        } else {
            $('#popup').modal('show');
        }
    });
</script>
