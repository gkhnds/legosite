@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}} | Box Producer</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">

    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])



    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        @foreach ($multiple->data as $key => $data)
            @php $cevap= strip_tags($data->dynamic->detay); @endphp
            @if ($key > 0), @endif {
            "@type": "Question",
            "name": "{{$data->dynamic->baslik}}",
            "acceptedAnswer": {
              "@type": "Answer",
             "text": "{{$cevap}}"
            }
          }
        @endforeach
        ]
      }
    </script>


@endsection
@section('content')

    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])



    <section class="case-study-area case-bg2 nav-style-1 pt--70 pt_md--60 pt_xs--60 pb--115 pb_md--60 pb_xs--60">
        <div class="container">
            <div class="row">
                
                
                <div class="accordion-one-inner">
                            <div class="accordion" id="accordionExample2">
                                
                                    
                                    @foreach($multiple->data as $key => $data)
                
                                <div class="accordion-item">
                
                                    <h2 class="accordion-header" id="heading{{$key}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                            {{$data->dynamic->baslik}}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample2" style="">
                                        <div class="accordion-body">
                                            {!! $data->dynamic->detay !!}
                                            
                                        </div>
                                    </div>
                                </div>
                                 
                            @endforeach
                                 
                            </div>
                        </div>
                        
                        

               




            </div>
        </div>
    </section>





@stop
