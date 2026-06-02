@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif
@section('meta')
    <title>{{$multiple->component->seo->title}} | Box Producer®</title>

    <meta name="description" content="{{$multiple->component->seo->desc}}">
    @include('theme.partials.multiple.schema-and-meta', ['lang'=>$lang, 'multiple'=>$multiple, 'masters'=>$masters])

@endsection
@section('content')


    @include('theme.partials.multiple.breadcrumb', ['masters'=>$masters, 'multiple'=>$multiple])





    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <div class="row g-5">

                <div class="col-xl-9 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <!-- Arama Kutusu Ekleme -->
                        <div class="rts-single-wized search">
                            <div class="wized-body">
                                <div class="rts-search-wrapper">
                                    <input id="searchInput" class="Search" type="text" placeholder="{{$translate->filter_words}}">
                                     
                                </div>
                            </div>
                        </div>
                    <div class="row g-5">


                        @foreach ($multiple->data as $key => $data)
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <!-- start blog grid inner -->
                                <div class="blog-grid-inner">
                                    
                                    <div class="blog-body">
                                        <a href="/{{$lang}}/{{$multiple->component->slug}}/{{$data->static->slug}}">
                                            <h6 class="title">
                                                {{$data->dynamic->baslik}}
                                            </h6>
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

                @if (count($ladders->knowledge_base_categories) >= 1 )
                    <div class="col-xl-3 col-md-12 col-sm-12 col-12 mt_lg--60   pl_md--0 pl-lg-controler pl_sm--0">



                        

                        <!-- single wizered start -->
                        <div class="rts-single-wized Categories service">
                            <div class="wized-header">
                                <h6 class="title">
                                    {{$translate->kategoriler}}
                                </h6>
                            </div>
                            <div class="wized-body">

                                @foreach($ladders->knowledge_base_categories as $key => $kategori)
                                    <ul class="single-categories">
                                        <li><a href="/{{$lang}}/{{$multiple->component->slug}}/{{$kategori->slug}}">{{$kategori->name}} <i class="far fa-long-arrow-right"></i></a></li>
                                    </ul>

                                    @if(isset($kategori->children))
                                        @foreach($kategori->children as $key => $subdata)
                                            <ul style="margin-left: 20px;" class="single-categories">
                                                <li style="margin-top: -9px;"><a style="line-height: 9px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata->slug}}"> {{$subdata->name}} </a></li>
                                            </ul>
                                             @if(isset($subdata->children))
                                                @foreach($subdata->children as $key => $subdata_child)
                                                    <ul style="margin-left: 37px;" class="single-categories">
                                                        <li style="margin-top: -9px;">
                                                        <a style="line-height: 2px;" href="/{{$lang}}/{{$multiple->component->slug}}/{{$subdata_child->slug}}"> {{$subdata_child->name}}  </a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <!-- single wizered End -->
                        
                        
                        <!-- SAATLER -->
                       <div class="rts-single-wized Recent-post">
                            <div class="wized-header">
                                <h5 class="title">Local Times</h5>
                            </div>
                            <div class="wized-body" id="timeContainer">
                                <!-- JavaScript will dynamically populate times here -->
                            </div>
                        </div>

                        <!-- SAATLER  -->


                    </div>
                    <!-- rts- blog wizered end area -->

                @endif


                


            </div>
        
        
        
       <script>
    // Filtreleme Fonksiyonu
    document.getElementById('searchInput').addEventListener('keyup', function() {
    var filter = this.value.toLowerCase();
    var items = document.querySelectorAll('.col-lg-6.col-md-6.col-sm-12.col-12');
    var breadcrumbArea = document.querySelector('.rts-breadcrumb-area.bg_image');

    var hasVisibleItems = false;

    items.forEach(function(item) {
        // Eğer öğe .breadcrumb-1 sınıfını içeriyorsa veya header kısmında ise filtreleme yapma
        if (item.classList.contains('breadcrumb-1') || item.querySelector('.bread-tag')) {
            item.style.display = ''; // Her durumda göster
            return;
        }

        var title = item.querySelector('h6.title');
        if (title && title.textContent.toLowerCase().includes(filter)) {
            item.style.display = ''; // Göster
            hasVisibleItems = true;
        } else {
            item.style.display = 'none'; // Gizle
        }
    });

    // Eğer hiçbir öğe görünür değilse veya hepsi gizlenirse, sabit yükseklik korunsun
    if (hasVisibleItems) {
        breadcrumbArea.classList.remove('fixed-height');
    } else {
        breadcrumbArea.classList.add('fixed-height');
    }
});

</script>


        </div>
    </div>
    <!-- rts blog grid area end -->



<!-- Global saatler creaati -->
<!-- wized-body container with ID for dynamic content -->
<div class="wized-body" id="timeContainer">
    <!-- JavaScript will dynamically populate times and flags here -->
</div>

<script>
    // Define countries with time zones and flag codes (ISO Alpha-2 country code)
    const countries = [
        { name: "turkey", capital: "ankara", timezone: "Europe/Istanbul", flagCode: "tr" },
        { name: "united kingdom", capital: "london", timezone: "Europe/London", flagCode: "gb" },
        { name: "usa", capital: "washington dc", timezone: "America/New_York", flagCode: "us" },
        { name: "iraq", capital: "baghdad", timezone: "Asia/Baghdad", flagCode: "iq" },
        { name: "france", capital: "paris", timezone: "Europe/Paris", flagCode: "fr" },
        { name: "germany", capital: "berlin", timezone: "Europe/Berlin", flagCode: "de" },
        { name: "belgium", capital: "brussels", timezone: "Europe/Brussels", flagCode: "be" },
        { name: "azerbaijan", capital: "baku", timezone: "Asia/Baku", flagCode: "az" },
        { name: "netherlands", capital: "amsterdam", timezone: "Europe/Amsterdam", flagCode: "nl" },
        { name: "uae", capital: "abu dhabi", timezone: "Asia/Dubai", flagCode: "ae" },
        { name: "russia", capital: "moscow", timezone: "Europe/Moscow", flagCode: "ru" },
        { name: "saudi arabia", capital: "riyadh", timezone: "Asia/Riyadh", flagCode: "sa" }
    ];

    // Function to capitalize only the first letter of each word
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function updateTimes() {
        const container = document.getElementById("timeContainer");
        container.innerHTML = ""; // Clear previous times

        countries.forEach(country => {
            const now = new Date().toLocaleTimeString("en-GB", { timeZone: country.timezone, hour12: false });
            const countryName = capitalizeFirstLetter(country.name);

            const countryElement = document.createElement("div");
            countryElement.className = "recent-post-single";
            countryElement.innerHTML = `
                <div class="content-area">
                    <div class="user" style="font-size: 14px;">
                        <img src="https://flagcdn.com/16x12/${country.flagCode}.png" alt="${countryName} flag" 
                             style="width: 20px; height: 15px; margin-right: 5px;">
                        <span>${countryName.toUpperCase()}</span>
                    </div>
                    <a class="post-title">
                        <h6 class="title"><i class="fal fa-clock"></i> ${now}</h6>
                    </a>
                </div>
            `;
            container.appendChild(countryElement);
        });
    }

    // Update times every second
    setInterval(updateTimes, 1000);
</script>



<!-- Global saatler creaati -->



@endsection

