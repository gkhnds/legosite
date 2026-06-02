<section class="text-center mhide4 products-section sec-pad {{$module->class}}" @if(!empty($module->resim)) style="background-image: url({{Helpers::CacheImageLink($module->resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});" @endif>


{!! $module->aciklama !!}

</section>
