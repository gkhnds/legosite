

<!-- Creaati Theme Contents -->
<!-- Creaati Theme Contents -->
<!-- scripts start form hear -->

<!-- Temel vendorlar (jQuery eski projelerde genelde bloklayıcıdır) -->
<script src="/assets/js/vendor/jquery.min.js" defer></script>
<script src="/assets/js/vendor/jqueryui.js" defer></script>
<script src="/assets/js/vendor/waypoint.js" defer></script>

<!-- Slider eklentisi -->
<script src="/assets/js/plugins/swiper.js" defer></script>

<!-- Diğer eklentiler -->
<script src="/assets/js/plugins/counterup.js" defer></script>
<script src="/assets/js/plugins/sal.min.js" defer></script>
<script src="/assets/js/vendor/bootstrap.min.js" defer></script>

<script src="/assets/js/main.js" defer></script>
<!-- scripts end form hear -->
<!-- Creaati Theme Contents -->
<!-- Creaati Theme Contents -->



<!-- Creaati Master Extensions SCRIPTS.BL -->
<!-- Creaati Master Extensions SCRIPTS.BL -->

<!-- -->

<div class="Loading"></div>
<input type="hidden" value="{{$lang}}" class="lang">
<input type="hidden" value="{{($translate->kapat)}}" class="kapat">

<script>
    var lang = "{{$lang}}"
</script>

<!-- Özel JS -->
<script src='/lego/main/js/lego-nonminify.js' defer></script>
<script src="/lego/main/js/sweetalert2.js" defer></script>

<!-- 3 Katmanlı Menü için düzenleme js'i -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var targetLinks = document.querySelectorAll(".sub-droupdown a");

        targetLinks.forEach(function(targetLink) {
            targetLink.classList.add("sub-menu-link");
        });

        var targetUls = document.querySelectorAll(".sub-droupdown > ul");

        targetUls.forEach(function(targetUl) {
            if (targetUl) {
                targetUl.classList.add("submenu", "third-lvl");
            }
        });

        // Sayfa yüklendiğinde çalışacak kod
        var submenuItems = document.querySelectorAll(".submenu.menu-link3 li.has-droupdown");

        submenuItems.forEach(function(submenuItem) {
            submenuItem.classList.remove("has-droupdown");
        });


        var targetLinks2 = document.querySelectorAll(".submenu.third-lvl .sub-droupdown a");

        targetLinks2.forEach(function(targetLinks2) {
            if (targetLinks2.classList.contains("sub-menu-link")) {
                targetLinks2.classList.remove("sub-menu-link");
            }
        });


        // Tüm sayfa üzerindeki a etiketlerini seçin
        var allLinks = document.querySelectorAll("a.sub-menu-link");

// Her a etiketi için kontrol yapın
        allLinks.forEach(function(link) {
            // A etiketinin altındaki ul elementini seçin
            var ulElement = link.nextElementSibling;

            // Eğer ul elementi yoksa ve a etiketinin class'ı "sub-menu-link" ise
            if (!ulElement && link.classList.contains("sub-menu-link")) {
                // "sub-menu-link" class'ını silin
                link.classList.remove("sub-menu-link");
            }
        });
    });




    var submenuItems = document.querySelectorAll(".sub-droupdown");

    // Her menü öğesi için bir olay dinleyici ekleyin
    submenuItems.forEach(function(submenuItem) {
        submenuItem.addEventListener("mouseover", function() {
            // Tüm menü öğelerinin z-index değerini varsayılan değere (örneğin 1) ayarlayın
            submenuItems.forEach(function(item) {
                item.style.zIndex = "1";
            });

            // Üzerine gelinen menü öğesinin z-index değerini artırın (örneğin 2)
            this.style.zIndex = "22222";
        });
    });

</script>
<!-- 3 Katmanlı Menü için düzenleme js'i -->
<!-- <script src="/js/mobilecta.js"></script> -->
@foreach($masters->moduller->data as $k => $modul)
    @if($modul->dynamic->tipi == 'Fixed')
        <x-modules position="Fixed" view="{{$modul->dynamic->view}}"  uuid="{{$modul->static->uuid}}"/>
    @endif
@endforeach
@extends('system.developermenu')
<!-- Creaati Master Extensions SCRIPTS.BL -->
<!-- Creaati Master Extensions SCRIPTS.BL -->

<!-- header online time -->
<script>
    function updateTurkeyTime() {
        const turkeyTimeElement = document.getElementById("turkeyTime");

        // Get the current time in Turkey's timezone
        const now = new Date().toLocaleTimeString("en-GB", { timeZone: "Europe/Istanbul", hour12: false });

        // Define working hours (09:00 - 18:00)
        const hour = parseInt(now.split(":")[0], 10);
        const isWorkingHours = hour >= 9 && hour < 18;

        // Set the message and color based on working hours
        if (isWorkingHours) {
            turkeyTimeElement.textContent = `Working Hours: ${now}`;
            turkeyTimeElement.style.color = "green"; // Set text color to green
        } else {
            turkeyTimeElement.textContent = `After Hours: ${now}`;
            turkeyTimeElement.style.color = "red"; // Set text color to red
        }
    }

    // Update every second
    setInterval(updateTurkeyTime, 1000);
</script>



<!-- cookie onay  
<style>
        #cookie-notice {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #61a0ff;
            color: #fff;
            padding: 15px;
            text-align: center;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #cookie-notice span {
            margin-bottom: 10px;
            font-size: 16px;
        }

        #cookie-notice a {
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
        }

        #cn-accept-cookie {
            background-color: #00a323;
        }

        #cn-refuse-cookie {
            background-color: #545454;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            #cookie-notice span {
                font-size: 14px;
            }
            #cookie-notice a {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
    <div id="cookie-notice" style="display: none;">
    <span>{{($translate->cookie)}}</span>
    <div>
        <a href="#" id="cn-accept-cookie">{{($translate->accept)}}</a>
        <a href="https://google.com" id="cn-refuse-cookie">{{($translate->deny)}}</a>
    </div>
</div>

<script>
    // Check if the cookie notice has already been accepted
    if (!localStorage.getItem('cookieAccepted')) {
        document.getElementById('cookie-notice').style.display = 'flex';
    }

    // Handle "OK" button click
    document.getElementById('cn-accept-cookie').addEventListener('click', function (e) {
        e.preventDefault();
        localStorage.setItem('cookieAccepted', 'true');
        document.getElementById('cookie-notice').style.display = 'none';
    });
</script>
<!-- cookie onay -->
<!-- header online time -->
