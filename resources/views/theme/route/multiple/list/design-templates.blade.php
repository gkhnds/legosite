@extends('theme.master')



@section('meta')

    <title>{{$multiple->component->seo->title}} | Box Producer</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}  ">

   @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection


@section('content')

    
@include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])
    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">

            
            <div class="row g-5">

                
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">


                         @foreach ($ladders->urun_kategorileri as $key => $value)
                            <div class="col-xl-6 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                                            <h4 class="border-bottom py-4 mb-4">{{$value->name}}</h4>
                                            @foreach ($multiple->data as $key => $data)
                                                @foreach(Helpers::FileList($data->dynamic->dosya) as $file)
                                                    @if ($value->uuid == $data->dynamic->kategori[0])
                                                    

                                                        <div class="g-5 mb--30 mt--30">
                                                            <a href="{{$file->url}}" target="_blank" class="rts-btn btn-primary-2" title="{{$data->dynamic->baslik}}">
                                                            
                                                                <span class="text-truncate">{{$data->dynamic->baslik}}</span>
                                                                @if(!empty($data->dynamic->resim))
                                                                    <img src="{{Helpers::CacheImageLink($data->dynamic->resim,array('ThumbsMode' => true, 'Mime' => 'webp'))}}" class="mr-2" style="max-height: 50px;">
                                                                @endif
                                                            </a>
                                                        </div>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>     
                                        @endforeach

                    </div>
                    <!-- pagination area -->
                    
                    <!-- pagination area End -->
                </div>
                <!--rts blog wized area -->

            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->

<!-- design_templates_text -->
<div class="rts-blog-list-area ">
        <div class="container">
            <div class="row g-5">
                <!-- rts blo post area -->
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <!-- single post -->
                    <div class="blog-single-post-listing details mb--0">
                        <hr>
                        <div class="">
                            
                                                         <p class="disc mt--30">
                               
                                                        {!! $masters->anasayfa_duzenle->data->dynamic->design_templates_text !!}
                                                        </p>
                                                        <div class="row  align-items-center">
                                <div class="col-lg-12 col-md-12">
                                    <!-- tags details -->
                                    <div class="details-tag">
                                        
                                        
                                    </div>
                                    <!-- tags details End -->
                                </div>
                                
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <!-- single post End-->
                </div>
                <!-- rts-blog post end area -->
                <!--rts blog wizered area -->
                
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>
<!-- design_templates_text -->


@endsection

