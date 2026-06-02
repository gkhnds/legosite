
@if($masters->site_ayarlari->data->dynamic->cerez == "Aktif")
@if($module->mobile_status == 'Pasif')
    <style>
        @media only screen and (max-width: 768px) {
            .mycookie{
                display: none;
            }
        }
    </style>
@endif
<div class="mycookie" style="max-width: 30%;">
    <!-- Cookie Consent by https://www.FreePrivacyPolicy.com -->
    <script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.0.0/cookie-consent.js" charset="UTF-8"></script>
    <script type="text/javascript" charset="UTF-8">
        document.addEventListener('DOMContentLoaded', function () {
            cookieconsent.run({"notice_banner_type":"simple","consent_type":"implied","palette":"light","language":"tr","page_load_consent_levels":["strictly-necessary","functionality","tracking","targeting"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"{{url('/')}}"});
        });
    </script>

    <noscript>Cookie Consent by <a href="https://www.freeprivacypolicy.com/" rel="nofollow noopener">Free Privacy Policy Generator website</a></noscript>
    <!-- End Cookie Consent -->
</div>



@endif
