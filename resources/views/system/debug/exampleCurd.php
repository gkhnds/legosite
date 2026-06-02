
<!-- Update Form -->
<form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form SubmitForm">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12 col-sm-12 form-group">
            <input type="text" name="baslik" placeholder="başlık *" >
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 form-group message-btn centred">
            <input type="button"  data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain' value="Update" class="g-recaptcha theme-btn style-one">
            <style>
                .grecaptcha-badge{
                    display: none;
                }
            </style>
        </div>
        <input type="hidden" name="recordId" value="46e96fe8-ed45-4961-8568-40fe24b1cbea">
        <input type="hidden" name="process" value="Update">
        <input type="hidden" name="accept_message"  value="{{$translate->form_gonderildi}}">
        <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
    </div>
</form>



<!-- Insert Form -->
<form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form SubmitForm">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12 col-sm-12 form-group">
            <input type="text" name="baslik" placeholder="baslik *" >
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 form-group message-btn centred">
            <input type="button"  data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain' value="Insert" class="g-recaptcha theme-btn style-one">
            <style>
                .grecaptcha-badge{
                    display: none;
                }
            </style>
        </div>
        <input type="hidden" name="componentId" value="afb45132-668f-4260-8275-e3ba4517ab5d">
        <input type="hidden" name="process" value="Insert">
        <input type="hidden" name="accept_message"  value="Insert Success">
        <input type="hidden" name="close_button_text" value="Close">
    </div>
</form>



<!-- Delete Data Form -->

<form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form SubmitForm">
    <div class="row clearfix">
        <div class="col-lg-6 col-md-12 col-sm-12 form-group message-btn centred">
            <input type="button"  data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain' value="Delete" class="g-recaptcha theme-btn style-one">
            <style>
                .grecaptcha-badge{
                    display: none;
                }
            </style>
        </div>
        <input type="hidden" name="recordId" value="a585f39e-d2e6-440e-9777-025e6fdbd837">
        <input type="hidden" name="process" value="Delete">
        <input type="hidden" name="accept_message"  value="Delete Success">
        <input type="hidden" name="close_button_text" value="Close">
    </div>
</form>


<!-- InsertToMail Form -->
<form method="POST" action="/{{$lang}}/FormPush" class="SubmitForm">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12 col-sm-12 form-group">
            <input type="text" name="isim" placeholder="{{$translate->ad_soyad}} *" >
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 form-group">
            <input type="text" name="telefon"  placeholder="{{$translate->telefon}} *">
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 form-group">
            <input type="email" name="email" placeholder="{{$translate->email}} *" >
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <textarea name="mesaj" placeholder="{{$translate->mesaj}} *" ></textarea>
        </div>

        <div class="form-group">
            <input type="button"  data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain' value="{{$translate->ebultenbtntext}}" class="g-recaptcha theme-btn style-one pull-right" style="font-weight: bold; font-size:18px">
            <style>
                .grecaptcha-badge{
                    display: none;
                }
            </style>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 form-group message-btn centred">
            <button class="theme-btn style-one"  type="submit" id="sbtn" name="submit-form">{{$translate->gonder}}</button>
        </div>
        <input type="hidden" name="mesaj"  value="{{$translate->footer_form_bulten_kayit}}">
        <input type="hidden" name="telefon"  value="{{$translate->footer_form_bulten_kayit}}">
        <input type="hidden" name="componentId" value="475f9997-c1bf-43ca-a1c9-cb3de7e103b5">
        <input type="hidden" name="accept_message"  value="{{$translate->footer_form_bulten_kayit_yapildi}}">
        <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">

        <input type="hidden" name="subject" value="E-Bülten Kaydı">
        <input type="hidden" name="mail_backup" value="1">
        <input type="hidden" name="mail_view" value="addon/mail/FormMail">
        <input type="hidden" name="link"  value="{{$translate->footer_form_bulten_kayit}}">

        <input type="hidden" name="process" value="InsertToMail">
    </div>
</form>
