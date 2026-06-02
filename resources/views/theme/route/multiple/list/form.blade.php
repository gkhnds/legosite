@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">
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

 
                        @foreach ($ladders->form_kategorileri as $key => $data)
                        
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <!-- start blog grid inner -->
                                <div class="blog-grid-inner">
                                    
                                    <div class="blog-body">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->slug}}">
                                            <h5 class="title">
                                                {{$data->name}}
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                                <!-- end blog grid inner -->
                            </div>
                        @endforeach



                    </div>
                    <!-- pagination area -->

                    <!-- pagination area End -->
                </div>


            </div>
        </div>
    </div>
    <!-- rts blog grid area end -->





@endsection

