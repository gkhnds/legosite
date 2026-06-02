@extends('theme.master')


@section('meta')
    <title>{{$multiple->component->seo->title}}</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])
@endsection
@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])

    <div class="rts-service-area  rts-section-gapBottom ">

        <div class="container-fluid service-main plr--120-service  plr_md--0 pl_sm--0 pr_sm--0 ">
            <div class="background-service row">

                @foreach ($multiple->data as $key => $data)
                    @foreach(Helpers::FileList($data->dynamic->dosya) as $file)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="service-one-inner one">
                                <div class="thumbnail">
                                    <img src="/assets/images/fileicon.png" alt="{{$data->dynamic->baslik}}">
                                </div>
                                <div class="service-details">
                                    <a target="new" href="{{$file->url}}">
                                        <h5 class="title">{{$data->dynamic->baslik}}</h5>
                                    </a>
                                    <p class="disc">
                                        {{$file->type}}
                                    </p>
                                    <a arget="new" class="rts-read-more btn-primary" href="{{$file->url}}"><i
                                            class="far fa-arrow-right"></i>{{$translate->dosyayi_indir}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

        </div>
    </div>
    <!-- ServicesClean -->

@endsection
