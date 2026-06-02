@extends('theme.master')

@if(isset($PageNumber))
    @section('title', $multiple->component->seo->title.' - '.\Illuminate\Support\Str::title($translate->sayfa).' '.$PageNumber)
@else
    @section('title', $multiple->component->seo->title)
@endif

@section('meta')
    <title>{{$multiple->ladder->name}} {{$multiple->component->seo->title}}</title>
    <link rel="canonical" href="https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}"/>
    <meta name="description" content="{{$multiple->ladder->name}} {{$multiple->component->seo->desc}}">

@endsection


@section('content')

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area bg_image " style="background-image:url({{Helpers::CacheImageLink($masters->tasarim_ayarlari->data->dynamic->header_resim,array('ThumbsMode' => false, 'Mime' => 'webp'))}});">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-12 breadcrumb-1">
                    <h1 class="title">{{$multiple->ladder->name}}</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->


    <div class="rts-contact-form-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rts-contact-fluid rts-section-gap">

                        <div class="form-wrapper">

                            @php $widthClass=''; @endphp
                            @if(!empty($multiple->data))

                                <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form default-form  CustomFormSubmit SubmitForm" enctype="multipart/form-data">
                                    <div class="row">



                                        @foreach ($multiple->data as $key => $data) @if($data->dynamic->input_type != 'Uzun Metin' && $data->dynamic->input_type != 'Dosya' && $data->dynamic->input_type != 'Bölüm' && $data->dynamic->input_type != 'E-Posta' && $data->dynamic->input_type != 'Seçim Listesi' && $data->dynamic->input_type != 'Onay Kutusu')
                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">
                                                <input    @if(!empty($data->dynamic->input_min)) min="{{$data->dynamic->input_min}}" @endif @if(!empty($data->dynamic->input_max)) max="{{$data->dynamic->input_max}}" @endif name="{{$data->dynamic->input_dataname}}" @if($data->dynamic->input_type == 'Kısa Metin') type="text" @elseif($data->dynamic->input_type == 'Telefon') type="phone" @elseif($data->dynamic->input_type == 'Tarih') type="date" @elseif($data->dynamic->input_type == 'Rakam') type="number" @elseif($data->dynamic->input_type == 'URL') type="url" @elseif($data->dynamic->input_type == 'Şifre') type="password" @endif placeholder="{{$data->dynamic->input_title}}" @if($data->dynamic->input_required == 'Zorunlu') required="required" @endif>

                                            </div>
                                        @elseif($data->dynamic->input_type == 'E-Posta' && $data->dynamic->input_email_type == 'Gönderici E-Postası')
                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">
                                                <input   @if(!empty($data->dynamic->input_min)) min="{{$data->dynamic->input_min}}" @endif @if(!empty($data->dynamic->input_max)) max="{{$data->dynamic->input_max}}" @endif name="email" type="email" placeholder="{{$data->dynamic->input_title}}" @if($data->dynamic->input_required == 'Zorunlu') required="required" @endif>

                                            </div>
                                        @elseif($data->dynamic->input_type == 'E-Posta' && $data->dynamic->input_email_type == 'Diğer E-Posta Verisi')
                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">
                                                <input   @if(!empty($data->dynamic->input_min)) min="{{$data->dynamic->input_min}}" @endif @if(!empty($data->dynamic->input_max)) max="{{$data->dynamic->input_max}}" @endif name="{{$data->dynamic->input_dataname}}" type="email" placeholder="{{$data->dynamic->input_title}}" @if($data->dynamic->input_required == 'Zorunlu') required="required" @endif>

                                            </div>
                                        @elseif($data->dynamic->input_type == 'Uzun Metin')
                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">
                                                <textarea @if(!empty($data->dynamic->input_min)) min="{{$data->dynamic->input_min}}" @endif @if(!empty($data->dynamic->input_max)) max="{{$data->dynamic->input_max}}" @endif name="{{$data->dynamic->input_dataname}}" rows="4" placeholder="{{$data->dynamic->input_title}}" @if($data->dynamic->input_required == 'Zorunlu') required="required" @endif></textarea>

                                            </div>

                                        @elseif($data->dynamic->input_type == 'Dosya')

                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">
                                                {{$data->dynamic->input_title}} <br>
                                                <input name="file[{{$key}}]" type="file" placeholder="{{$data->dynamic->input_title}}" @if($data->dynamic->input_required == 'Zorunlu') required="required" @endif accept=".jpg,.jpeg,.png,.pdf,.docx">

                                            </div>

                                        @elseif($data->dynamic->input_type == 'Bölüm')
                                            <div class="{{$data->dynamic->class}} col-md-12 ">
                                                <h6 class="mb--5 mt--25"> {{$data->dynamic->input_name}} </h6><hr>
                                            </div>




                                        @elseif($data->dynamic->input_type == 'Seçim Listesi')
                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">
                                                @php $selectData = explode(',', $data->dynamic->input_name) @endphp

                                                <select   name="{{$data->dynamic->input_dataname}}" class="form-select"   @if($data->dynamic->input_required == 'Zorunlu') required="required" @endif>
                                                    <option>{{$data->dynamic->input_title}}</option>
                                                    @foreach($selectData as $ky => $value)
                                                        <option value="{{$value}}">{{$value}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        @elseif($data->dynamic->input_type == 'Onay Kutusu')
                                            <div class="{{$data->dynamic->class}} @if($data->dynamic->input_col == 'Kolon 4 (Col-4)')  col-md-4   @elseif($data->dynamic->input_col == 'Kolon 6 (Col-6)')   col-md-6   @elseif($data->dynamic->input_col == 'Kolon 12 (Col-12)')   col-md-12 @endif">

                                                @php $selectData = explode(',', $data->dynamic->input_name) @endphp
                                                {{$data->dynamic->input_title}} <br>
                                                @foreach($selectData as $key => $value)

                                                    <input id="{{$data->dynamic->input_dataname}}-{{$key}}"
                                                           class="checkbox" type="checkbox"
                                                           name="{{$data->dynamic->input_dataname}}-{{$key}}"
                                                           value="{{$value}}">
                                                    <label class=" ml--10"
                                                           for="{{$data->dynamic->input_dataname}}-{{$key}}">
                                                        {{$value}}</label>



                                                @endforeach

                                            </div>





                                        @endif @endforeach

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn centred">

                                            <button class="g-recaptcha rts-btn btn-primary"  type="button" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain'  id="sbtn" name="submit-form">{{$translate->gonder}}</button>
                                        </div>

                                        <style>
                                            .grecaptcha-badge{
                                                display: none;
                                            }
                                        </style>

                                        <input type="hidden" name="validate_message" value="{{$translate->form_uyari_mesaji}}">
                                        <input type="hidden" name="accept_message" value="{{$translate->form_gonderildi}}">
                                        <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                                        <input type="hidden" name="mail_backup" value="1">
                                        <input type="hidden" name="custom_form" value="1">
                                        <input type="hidden" name="mail_view" value="addon/mail/CustomFormMail">
                                        <input type="hidden" name="link" value="Özel Form - {{$multiple->ladder->name}}">
                                        <input type="hidden" name="subject" value="Özel Form - {{$multiple->ladder->name}}">
                                        <input type="hidden" name="process" value="SendOnlyMail">






                                    </div>
                                </form>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection


@section('customModuleContent')
    <script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
@endsection