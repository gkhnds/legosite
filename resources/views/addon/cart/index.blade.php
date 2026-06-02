@extends('theme.master')

@section('title', __('payment.Cart'))

@section('meta')
    <title>{{__('payment.Cart')}}</title>

    <link rel="stylesheet" href="/lego/main/css/lego.css">
@endsection
@section('content')

    <style>

        .payment-main{
            max-width: 1170px;
            padding: 0px 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .payment-row{
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .payment-col-md-12{
            flex: 0 0 100%;
            max-width: 100%;
        }
        .payment-card{
            border: 0px !important;
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border-radius: 0.25rem;
        }
        .payment-header{
            border: 0 !important;
            background-color: transparent;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
        }
        .payment-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }
        .payment-nav{
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .payment-card-header-tabs{
            margin-right: -0.625rem;
            margin-bottom: -0.75rem;
            margin-left: -0.625rem;
            border-bottom: 0;
        }
        payment-text-center{
            text-align: center !important;
        }

        .payment-nav-tabs .nav-item {
            margin-bottom: -1px;
        }

        .payment-cartTabsli {
            width: 33%;
        }

        .payment-nav-tabs .payment-nav-link.active, .payment-nav-tabs .payment-nav-item.show .payment-nav-link {
            border: 0 !important;
            border-bottom: 1px solid #dee2e6 !important;
        }

        .payment-nav-tabs .payment-nav-link.active, .payment-nav-tabs .payment-nav-item.show .payment-nav-link {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        .payment-nav-tabs .payment-nav-link {
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        .payment-cartTabsli a {
            padding: 15px;

        }
        .payment-nav-link i {
            font-size: 27px;
        }

        .form-control {
            display: block !important;
            width: 100% !important;

            font-size: 1rem !important;
            line-height: 1.5 !important;
            background-clip: padding-box !important;
            border: 1px solid #ced4da !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            border-radius: 0.25rem !important;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out !important;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out !important;
            -o-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
            font-weight: unset !important;
            height: unset !important;
            margin-bottom: 10px !important;
            padding: 10px !important;
            outline: unset !important;
            background-color: #fff !important;
            box-shadow: unset !important;

        }

        .ps-form__submit > .rts-btn{
            line-height: 0 !important;
        }
        .tab-content>.active{
            display: block !important;
        }

    </style>



    <div class="container mt-30" style="padding: 80px 15px 0px 15px;"> <!-- container -->

        <div class="row"> <!-- row -->

            <div class="col-md-12 pad-null">
                <div class="card text-center cart-main">
                    @if($masters->e_ticaret->data->dynamic->catalog_mode->value == "True")

                        <div style="padding: 10px;" class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="post" style="display:block;">
                                    <div class="alert alert-success text-center" role="alert">  </div>

                                    <div class="row">
                                        <div class="col-md-7 cart-table-content auto-hidden">
                                            <div class="table-content table-responsive cartb">
                                                <table class="sepet">
                                                    <thead>
                                                    <tr> <th class="width-thumbnail"></th>
                                                        <th class="width-name">{{__('payment.Product')}}</th>
                                                        <th class="width-quantity">{{__('payment.Piece')}}</th>
                                                        <th class="width-remove"></th>
                                                    </tr> </thead>
                                                    <tbody>
                                                    @php  $kdvTutari = 0; $sepetToplam = 0; $sepetToplamKdv = 0; $genelToplam = 0; @endphp
                                                    @foreach($datas as $key => $product)

                                                        @php $fiyat = $product->dynamic->fiyat;  @endphp

                                                        <tr>
                                                            <td class="product-thumbnail"> <a href=""><img src="{{Helpers::CacheImageLink($product->dynamic->resim,array('ThumbsMode' => true,'Mime' => 'webp'))}}"></a> </td>
                                                            <td class="product-name"> <a href="">
                                                                    {{Illuminate\Support\Str::limit($product->dynamic->baslik, 23, '..')}}
                                                                </a></td>

                                                            <td class="product-cart-price">

                                                                <div class="piece-box">
                                                                    <div   data-scope="piece{{$key}}" data-min="1" data-key="{{$product->cart->key}}" data-uuid="{{$product->cart->uuid}}" data-url="/{{$lang}}/cart/cart-piece-update" class="btn pieceMinus"><img src="/lego/cart/img/negative.png" alt=""></div>
                                                                    <input type="number" id="piece{{$key}}" name="piece" step="1" min="1" max="100" class="piece" value="{{$product->cart->piece}}" readonly>
                                                                    <input type="hidden" id="hpiece{{$key}}" name="piece" step="1" min="1" max="100" class="piece" value="{{$product->cart->piece}}">
                                                                    <div  data-scope="piece{{$key}}" data-max="100" data-key="{{$product->cart->key}}" data-uuid="{{$product->cart->uuid}}" data-url="/{{$lang}}/cart/cart-piece-update" class="btn piecePlus"><img src="/lego/cart/img/plus.png" alt=""></div>
                                                                </div>

                                                            </td>



                                                            <td class="product-remove cartDelete" style="cursor:pointer;" data-action="/{{$lang}}/cart/cartDelete"  data-key="{{$key}}" ><img style="width: 25px;" src="/lego/cart/img/delete.svg" alt=""></td>
                                                        </tr>



                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="cartb">
                                                <form method="POST" action="/{{$lang}}/FormPush" class="recaptcha-form-2 default-form SubmitForm2">
                                                    <div class="ps-form--contact">
                                                        <h2 class="ps-form__title">{{__('payment.ProposalForm')}}</h2>
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="ps-form__group">
                                                                    <input class="form-control " name="isim" type="text" placeholder="{{$translate->ad_soyad}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="ps-form__group">
                                                                    <input class="form-control " type="email" name="email" placeholder="{{$translate->email}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <div class="ps-form__group">
                                                                    <input class="form-control " name="telefon" type="number" placeholder="{{$translate->telefon}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ps-form__submit">

                                                            <button class="g-recaptcha rts-btn btn-primary-2"  type="button" data-sitekey="{{$masters->site_ayarlari->data->dynamic->recaptcha_sitekey}}"  data-badge="inline" data-callback='onSubmitMain2' id="sbtn" name="submit-form">{{$translate->gonder}}</button>

                                                            <style>
                                                                .grecaptcha-badge{
                                                                    display: none;
                                                                }
                                                            </style>


                                                        </div>
                                                    </div>

                                                    @foreach($datas as $key => $product)
                                                        <input type="hidden" name="product[{{$key}}]" value="{{$product->dynamic->baslik}} | {{$translate->piece}}: {{$product->cart->piece}}">
                                                    @endforeach
                                                    <input type="hidden" name="componentId" value="475f9997-c1bf-43ca-a1c9-cb3de7e103b5">
                                                    <input type="hidden" name="accept_message"  value="{{$translate->form_gonderildi}}">
                                                    <input type="hidden" name="close_button_text" value="{{$translate->kapat}}">
                                                    <input type="hidden" name="subject" value="Talep Formu">
                                                    <input type="hidden" name="custom_form" value="0">
                                                    <input type="hidden" name="mail_backup" value="1">
                                                    <input type="hidden" name="mail_view" value="addon/mail/ProposalMail">
                                                    <input type="hidden" name="link"  value="https://{{$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}">
                                                    <input type="hidden" name="process" value="InsertToMail">

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                    @else
                        <div class="card-header" >
                            <ul class="nav nav-tabs card-header-tabs" id="tabs">
                                <li class="nav-item cartTabsli">
                                    <a class="active nav-link active" href="#post" data-toggle="tab"><img style="width: 40px;" src="/lego/cart/img/cart3.svg" alt=""> <br>{{__('payment.Cart')}}</a>
                                </li>
                                <li class="payment-nav-item cartTabsli">
                                    <a class="nav-link fatura" href="#fatura" data-toggle="tab"><img style="width: 40px;" src="/lego/cart/img/ship3.svg" alt="">  <br>{{__('payment.InvoiceAndShipping')}}</a>
                                </li>
                                <li class="nav-item cartTabsli">
                                    <a class="nav-link" ><img style="width: 40px;" src="/lego/cart/img/payment2.svg" alt="">  <br>{{__('payment.Payment')}}</a>
                                    <a style="display: none;" class="nav-link odeme" href="#odeme" data-toggle="tab"> <br>{{__('payment.Payment')}}</a>
                                </li>
                            </ul>
                        </div>

                        <div style="padding: 10px;" class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="post">
                                    <div class="alert alert-success text-center" role="alert">  </div>

                                    <div class="row">
                                        <div class="col-md-9 cart-table-content auto-hidden">
                                            <div class="table-content table-responsive">
                                                <table class="sepet">
                                                    <thead>
                                                    <tr> <th class="width-thumbnail"></th>
                                                        <th class="width-name">{{__('payment.Product')}}</th>
                                                        <th class="width-price"> {{__('payment.Price')}}</th>
                                                        <th class="width-quantity">{{__('payment.Piece')}}</th>
                                                        @if($masters->e_ticaret->data->dynamic->kdv_status == "Aktif")
                                                            <th class="width-quantity">{{__('payment.Tax')}}</th>
                                                        @endif
                                                        <th class="width-subtotal">{{__('payment.Total')}}</th>
                                                        <th class="width-remove"></th>
                                                    </tr> </thead>
                                                    <tbody>
                                                    @php  $kdvTutari = 0; $sepetToplam = 0; $sepetToplamKdv = 0; $genelToplam = 0; @endphp
                                                    @foreach($datas as $key => $product)

                                                        @php $fiyat = $product->dynamic->fiyat;  @endphp

                                                        <tr>
                                                            <td class="product-thumbnail"> <a href=""><img src="{{Helpers::CacheImageLink($product->dynamic->resim,array('ThumbsMode' => true,'Mime' => 'webp'))}}"></a> </td>
                                                            <td class="product-name"> <a href="">
                                                                    {{Illuminate\Support\Str::limit($product->dynamic->baslik, 23, '..')}}
                                                                </a></td>

                                                            <td class="product-cart-price">
                                                                <span class="amount">{{$fiyat}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                            </td>

                                                            <td class="product-cart-price">

                                                                <div class="piece-box">
                                                                    <div   data-scope="piece{{$key}}" data-min="1" data-key="{{$product->cart->key}}" data-uuid="{{$product->cart->uuid}}" data-url="/{{$lang}}/cart/cart-piece-update" class="btn pieceMinus"><img src="/lego/cart/img/negative.png" alt=""></div>
                                                                    <input type="number" id="piece{{$key}}" name="piece" step="1" min="1" max="100" class="piece" value="{{$product->cart->piece}}" readonly>
                                                                    <input type="hidden" id="hpiece{{$key}}" name="piece" step="1" min="1" max="100" class="piece" value="{{$product->cart->piece}}">
                                                                    <div  data-scope="piece{{$key}}" data-max="100" data-key="{{$product->cart->key}}" data-uuid="{{$product->cart->uuid}}" data-url="/{{$lang}}/cart/cart-piece-update" class="btn piecePlus"><img src="/lego/cart/img/plus.png" alt=""></div>
                                                                </div>

                                                            </td>

                                                            @if($masters->e_ticaret->data->dynamic->kdv_status == "Aktif")
                                                                @if($product->dynamic->kdv != 0)
                                                                    @php $kdvTutari = Helpers::KdvTutar($fiyat,$product->dynamic->kdv,$product->cart->piece); @endphp
                                                                    <td class="product-total"><span>{{number_format($kdvTutari,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}} </span></td>
                                                                @else
                                                                    @php $kdvTutari = 0; @endphp
                                                                    <td class="product-total"><span>{{number_format($kdvTutari,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}} </span></td>
                                                                @endif
                                                            @else
                                                                @php $product->dynamic->kdv = 0; @endphp
                                                            @endif


                                                            @php $kdvDahil= Helpers::KdvDahil($fiyat,$product->dynamic->kdv,$product->cart->piece); @endphp
                                                            <td class="product-total"><span>{{number_format($kdvDahil,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}} </span></td>

                                                            <td class="product-remove cartDelete" style="cursor:pointer;" data-action="/{{$lang}}/cart/cartDelete"  data-key="{{$key}}" ><img style="width: 25px;" src="/lego/cart/img/delete.svg" alt=""></td>
                                                        </tr>

                                                        @php
                                                            $sepetToplam = ($sepetToplam + Helpers::KdvHaric($fiyat,$product->cart->piece));

                                                            $genelToplam = $genelToplam + $kdvDahil;
                                                            $sepetToplamKdv = $sepetToplamKdv + $kdvTutari; @endphp

                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-9 cart-table-content d-md-block d-lg-none mobile-cart-view" style="text-align: left">

                                            <h3>Sepetim</h3>
                                            @php  $kdvTutari = 0; $sepetToplam = 0;  $genelToplam = 0; @endphp
                                            @foreach($datas as $key => $product)
                                                <div class="mcartlist">
                                                    <div class="tcol-image"><img style="width: 100%;" src="{{Helpers::CacheImageLink($product->dynamic->resim,array('ThumbsMode' => true,'Mime' => 'webp'))}}" alt=""></div>
                                                    <div class="tcol-detail">
                                                        <div class="prname">  {{Illuminate\Support\Str::limit($product->dynamic->baslik, 20, '..')}}</div>
                                                        @php $kdvDahil= Helpers::KdvDahil($fiyat,$product->dynamic->kdv,$product->cart->piece); @endphp
                                                        <div class="prprice">{{number_format($kdvDahil,2)}}<span>{{$masters->e_ticaret->data->dynamic->para_birimi}}</span> </div>

                                                    </div>
                                                    <div class="tcol-action">
                                                        <div class="prdelete cartDelete" style="cursor:pointer;" data-action="/{{$lang}}/cart/cartDelete" data-key="{{$key}}"><img style="width: 23px;" src="/lego/cart/img/delete.svg" alt=""></div>
                                                        <div class="prpiece">{{$product->cart->piece}} {{__('payment.Piece')}}</div>
                                                    </div>
                                                </div>

                                                @php
                                                    $sepetToplam = ($sepetToplam + Helpers::KdvHaric($fiyat,$product->cart->piece));
                                                        $genelToplam = $genelToplam + $kdvDahil;
                                                        $sepetToplamKdv = $sepetToplamKdv + $kdvTutari; @endphp
                                            @endforeach


                                        </div>



                                        <div class="col-md-3">
                                            <div class="cartb">
                                                {{__('payment.CartTotal')}} <br> <span class="price">{{number_format($sepetToplam,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                            </div>
                                            @if($masters->e_ticaret->data->dynamic->kdv_status == "Aktif")
                                                <div class="cartb">
                                                    {{__('payment.TaxTotal')}}<br> <span class="price">{{number_format($sepetToplamKdv,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                </div>
                                            @endif
                                            @if($masters->e_ticaret->data->dynamic->kargo_bedava_limit <= $sepetToplam)
                                                @php $kargo = 0; @endphp
                                                <div class="cartb" style="background-color: #ffc800;color: white; font-weight: 500;">
                                                    <span class="price"  style="font-weight: 500;"><img style="width: 30px; margin-top: 5px;position: absolute;left: 30px;" src="/lego/cart/img/shipfree2.svg" alt=""> {{__('payment.FreeShipping')}}</span>
                                                </div>
                                            @else
                                                @php $kargo = $masters->e_ticaret->data->dynamic->kargo_ucret; @endphp
                                                <div class="cartb">
                                                    {{__('payment.Cargo')}} <span class="price">{{number_format($kargo,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                </div>

                                            @endif
                                            <div class="cartb carttotalbtn">
                                                <img style="width: 70px;margin-top: -10px;position: absolute;left: 170px;/* height: 60px; */" src="/lego/cart/img/wallet-transparent.svg" alt=""> {{__('payment.GeneralTotal')}} <br> <span class="price ">{{number_format($genelToplam + $kargo,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                            </div>
                                            <button onclick="$('.fatura').tab('show');" class="cartb resumebtn">
                                                {{__('payment.BuyButton')}}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="fatura">
                                    <div class="alert alert-success text-center" role="alert"> {{__('payment.CartStep2Balloon')}} </div>
                                    <form class="shippingPaymentForm" autocomplete="off" method="post" action="/{{$lang}}/cart/cartPayment" >

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">


                                                    <div class="col-lg-6 col-md-12"> <h4 class="tbaslik">{{__('payment.DeliveryInformation')}}</h4>
                                                        <div class="calculate-discount-content">
                                                            <div class="input-style"> <input type="text" name="shipping_name_surname" autocomplete="off" placeholder="{{__('payment.NameSurname')}}" class="form-control refresh" data-scope="FnameSurname" value="{{ app('request')->input('TnameSurname')}}" required=""> </div>
                                                            <div class="input-style"> <input type="number" name="shipping_phone"  placeholder="{{__('payment.Phone')}}" class="form-control refresh" data-scope="Fphone"  required=""> </div>
                                                            <div class="input-style"> <input type="text" name="shipping_email" placeholder="{{__('payment.Email')}}" class="form-control refresh"  data-scope="Femail"> </div>
                                                            <div class="input-style"> <textarea name="shipping_address" cols="30" rows="2" class="form-control" placeholder="{{__('payment.ShippingAddress')}}" required=""></textarea> </div>
                                                            <div class="input-style">
                                                                <textarea name="note" cols="30" rows="2" class="form-control" style="height: 100px;" placeholder="{{__('payment.Note')}}"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12"> <h4 class="tbaslik">{{__('payment.BillingInformation')}}</h4>
                                                        <div class="calculate-discount-content">
                                                            <div class="input-style"> <input type="text" name="invoice_name_surname" placeholder="{{__('payment.CompanyTitleorNameSurname')}}" class="form-control FnameSurname" required=""> </div>
                                                            <div class="input-style kurumsalInput" style="display: none;"> <input type="text" name="invoice_tax_administ" class="form-control Fvd" placeholder="{{__('payment.TaxAdminist')}}"> </div>
                                                            <div class="input-style kurumsalInput" style="display: none;"> <input type="text" type="number"   max="999999999" name="invoice_tax_number" class="form-control Fvno" placeholder="{{__('payment.TaxNumber')}}"> </div>
                                                            <div class="input-style"> <input type="text" name="invoice_phone" placeholder="{{__('payment.Phone')}}" class="form-control Fphone" required=""> </div>
                                                            <div class="input-style"> <input type="text" name="invoice_email" placeholder="{{__('payment.Email')}}" class="form-control Femail" > </div>
                                                            <div class="input-style">
                                                                <textarea name="invoice_address" cols="30" rows="2" class="form-control invoice_address" placeholder="{{__('payment.InvoiceAddress')}}" required=""></textarea>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div style="margin-bottom: 15px; height: 50px">
                                                    <div style="width: 50%;float: left;">
                                                        <div class="elementHide cartLog elementToggleClass cartLogActive " data-sclass="cartLogActive" data-scope="kurumsalInput">  {{__('payment.Individual')}}</div>
                                                    </div>

                                                    <div style="width: 50%; float: left;">
                                                        <div class="elementShow cartLog elementToggleClass" data-sclass="cartLogActive"  data-scope="kurumsalInput">  {{__('payment.Corporate')}}</div>
                                                    </div>

                                                </div>

                                                <div class="cartb">
                                                    {{__('payment.CartTotal')}} <br> <span class="price">{{number_format($sepetToplam,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                </div>
                                                @if($masters->e_ticaret->data->dynamic->kdv_status == "Aktif")
                                                    <div class="cartb">
                                                        {{__('payment.TaxTotal')}}<br> <span class="price">{{number_format($sepetToplamKdv,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                    </div>
                                                @endif
                                                @if($masters->e_ticaret->data->dynamic->kargo_bedava_limit > $sepetToplam)
                                                    @php $kargo = $masters->e_ticaret->data->dynamic->kargo_ucret; @endphp
                                                    <div class="cartb">
                                                        {{__('payment.Cargo')}} <span class="price">{{number_format($kargo,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                    </div>
                                                @else
                                                    @php $kargo = 0; @endphp
                                                    <div class="cartb" style="background-color: #ffc800;color: white; font-weight: 500;">
                                                        <span class="price"  style="font-weight: 500;"><img style="width: 30px; margin-top: 5px;position: absolute;left: 30px;" src="/lego/cart/img/shipfree2.svg" alt=""> {{__('payment.FreeShipping')}}</span>
                                                    </div>
                                                @endif
                                                <div class="cartb carttotalbtn">
                                                    <img style="width: 70px;margin-top: -10px;position: absolute;left: 170px;/* height: 60px; */" src="/lego/cart/img/wallet-transparent.svg" alt=""> {{__('payment.GeneralTotal')}} <br> <span class="price ">{{number_format($genelToplam + $kargo,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                </div>

                                                <div class="cartb" >
                                                    <input type="checkbox" name="agreement" required> <a href="#" data-toggle="modal" data-target="#aggrement">{{__('payment.SalesContract')}} </a> {{__('payment.IhavereadandIaccept')}}
                                                </div>


                                                <div class="modal fade" id="aggrement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!!$masters->e_ticaret->data->dynamic->sozlesme!!}
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="shippingPaymentForm resumebtn" type="submit"> {{__('payment.BuyButton')}}</button>


                                            </div>
                                        </div>
                                        <input type="hidden" name="close_button_text"  value="{{__('payment.Close')}}">
                                        <input type="hidden" name="accept_message"  value="{{__('payment.PaymentSuccessMessage')}}">
                                        <input type="hidden" name="accept_message"  value="Siparişiniz Alındı">
                                        <input type="hidden" name="link" value="Sipariş Detayı">
                                        <input type="hidden" name="component" value="dad887c4-4cb5-4c32-9ccb-415fcaa3c2fe">
                                        <input type="hidden" name="child_component" value="cab4dd3e-cbbe-4f6b-a906-5b3f859c81f2">
                                        <input type="hidden" name="mail_status" value="false"> <!-- 1 = true , 0 = false -->
                                        <input type="hidden" name="mail_view" value="extra/mail/FormMail">
                                    </form>

                                </div>

                                <div class="tab-pane" id="odeme">

                                    <div class="alert alert-warning text-center" role="alert"> {{__('payment.CartStep3Balloon')}} </div>
                                    <div class="row">

                                        <div class="col-md-9">

                                            <div class="row">
                                                @if($masters->e_ticaret->data->dynamic->havale->value == "True" or $masters->e_ticaret->data->dynamic->iyzico->value == "True" or $masters->e_ticaret->data->dynamic->kapida->value == "True")

                                                    @if($masters->e_ticaret->data->dynamic->iyzico->value == "True")
                                                        @php $paymentButtonStatus = 0; @endphp
                                                    @else
                                                        @php $paymentButtonStatus = 1; @endphp

                                                    @endif

                                                    <div class="accordion" id="accordionExample" style="width: 100%;">

                                                        @if($masters->e_ticaret->data->dynamic->iyzico->value == "True")
                                                            <div class="card">
                                                                <div class="card-header" id="headingOne">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-block text-left" style="box-shadow: 0;" onclick="$('#resumebtnLast').hide();" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                            {{__('payment.PaymentByCreditCard')}}
                                                                        </button>
                                                                    </h2>
                                                                </div>

                                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"  data-parent="#accordionExample">
                                                                    <div style="padding: 10px;" class="card-body">

                                                                        <div class="iyzicoPaymentDiv">

                                                                        </div>
                                                                        <div id="iyzipay-checkout-form" class="responsive"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif


                                                        <form autocomplete="off" method="post" action="/{{$lang}}/cart/cartUpdate">

                                                            @if($masters->e_ticaret->data->dynamic->havale->value == "True")
                                                                <div class="card">
                                                                    <div class="card-header" id="headingThree">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-block text-left collapsed" onclick="$('#resumebtnLast').show();$('#otherPayment1').prop( 'disabled', false );$('#otherPayment2').prop( 'disabled', true );" style="box-shadow: 0;" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                {{__('payment.PaymentByWireTransfer')}}
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                                        <div style="padding: 10px;" class="card-body">
                                                                            <input type="hidden" name="otherPayment" id="otherPayment1" value="havale" disabled>
                                                                            {!!$masters->e_ticaret->data->dynamic->havale_detay!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($masters->e_ticaret->data->dynamic->kapida->value == "True")
                                                                <div class="card">
                                                                    <div class="card-header" id="headingTwo">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-block text-left collapsed" style="box-shadow: 0;" onclick="$('#resumebtnLast').show();$('#otherPayment1').prop( 'disabled', true );$('#otherPayment2').prop( 'disabled', false );" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                                {{__('payment.PayAtTheDoor')}}
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                                        <div style="padding: 10px;" class="card-body">
                                                                            <input type="hidden" name="otherPayment" id="otherPayment2" value="kapida" disabled>
                                                                            {!!$masters->e_ticaret->data->dynamic->kapida_detay!!}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        @endif

                                                    </div>

                                                @else
                                                    @php $paymentButtonStatus = 0; @endphp
                                                    <div class="paymentProblem"> {{__('payment.NoPaymentMethodFound')}}</div>

                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="cartb">
                                                {{__('payment.CartTotal')}} <br> <span class="price">{{number_format($sepetToplam,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                            </div>
                                            @if($masters->e_ticaret->data->dynamic->kdv_status == "Aktif")
                                                <div class="cartb">
                                                    {{__('payment.TaxTotal')}} <br><span class="price">{{number_format($sepetToplamKdv,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                </div>
                                            @endif
                                            @if($masters->e_ticaret->data->dynamic->kargo_bedava_limit > $sepetToplam)
                                                @php $kargo = $masters->e_ticaret->data->dynamic->kargo_ucret; @endphp
                                                <div class="cartb">
                                                    {{__('payment.Cargo')}} <span class="price">{{number_format($kargo,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                                </div>
                                            @else
                                                @php $kargo = 0; @endphp
                                                <div class="cartb" style="background-color: #ffc800;color: white;">
                                                    <span class="price" style="font-weight: 500;"><img style="width: 30px; margin-top: 5px;position: absolute;left: 30px;" src="/lego/cart/img/shipfree2.svg" alt=""> {{__('payment.FreeShipping')}}</span>
                                                </div>
                                            @endif
                                            <div class="cartb carttotalbtn">
                                                {{__('payment.GeneralTotal')}} <br> <span class="price ">{{number_format($genelToplam + $kargo,2)}}{{$masters->e_ticaret->data->dynamic->para_birimi}}</span>
                                            </div>

                                            <button class=" resumebtn"  @if($paymentButtonStatus == 0) style="display: none" @endif id="resumebtnLast" type="submit" >
                                                {{__('payment.BuyButton')}}
                                            </button>
                                            <input type="hidden" name="link" value="Sipariş Detayı">
                                            <input type="hidden" name="close_button_text"  value="{{__('payment.Close')}}">
                                            <input type="hidden" name="accept_message"  value="{{__('payment.PaymentSuccessMessage')}}">
                                            <input type="hidden" name="component" value="dad887c4-4cb5-4c32-9ccb-415fcaa3c2fe">
                                            <input type="hidden" name="child_component" value="cab4dd3e-cbbe-4f6b-a906-5b3f859c81f2">
                                            <input type="hidden" name="mail_status" value="false"> <!-- 1 = true , 0 = false -->
                                            <input type="hidden" name="mail_view" value="extra/mail/FormMail">

                                            </form>
                                        </div>


                                    </div>

                                </div>


                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
    <br><br><br>


    <!-- service-details end -->

@endsection

@section('customModuleContent')
    <script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
@endsection