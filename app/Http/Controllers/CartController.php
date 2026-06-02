<?php
namespace App\Http\Controllers;

use Helpers;
use Connections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    public function __construct()
    {



    }
    public function CartPush(Request $request)
    {
        $lang = $request->get('lang');
        Session::push('Cart.'.$lang, $request->all());
        return response()->json(['status'=>true,'message' => __('messages.ProductAddedToCart'), 'extra' => __('messages.Close')]);
    }
    public function CartPieceUpdate(Request $request)
    {
        $lang = $request->get('lang');
        if (Session::has('Cart.'.$lang)){

            $items = Session::pull('Cart.'.$lang);
            if (empty($request['piece'])){
                $request['piece'] = 1;
            }

            foreach ($items as $key => $item) {
                if ($request->key == $key) {
                    Session::push('Cart.'.$lang, $request->all());
                }else{
                    Session::push('Cart.'.$lang, $item);
                }
            }



            return response()->json(['status' => true]);
        }else{
            return redirect('/');
        }


    }
    public function CartDelete(Request $request)
    {
        $lang = $request->get('lang');
        if (Session::has('Cart.'.$lang)){
            $Cart = Session::get('Cart.'.$lang);
            Session::put('Cart.'.$lang, []);
            foreach ($Cart as $key => $cr){
                if ($key != $request->key){
                    if (count($Cart) == 1){
                        Session::forget('Cart.'.$lang);
                    }else{
                        Session::push('Cart.'.$lang, $cr);
                    }

                }
            }
        }else{
            return redirect('/');
        }


    }
    public function CartPayment(Request $request)
    {
        $lang = $request->get('lang');
        $masters = $request->get('masters');
        Session::forget('Order');
        $attr  = array(
            'shipping_name_surname' => 'Teslimat Ad Soyad',
            'shipping_phone' => 'Teslimat Numarası',
            'shipping_email' => 'Teslimat Email',
            'shipping_address' => 'Teslimat Adresi',
            'invoice_name_surname' => 'Firma Ünvanı veya Ad Soyad',
            'invoice_tax_administ' => 'Vergi Dairesi',
            'invoice_tax_number' => 'Vergi Numarası',
            'invoice_phone' => 'Fatura Telefon',
            'invoice_email' => 'Fatura Email',
            'invoice_address' => 'Fatura Adresi',
            'note' => 'Sipariş Notu'
        );
        $rules = array(
            'shipping_name_surname' => 'required|max:250',
            'shipping_phone' => 'required|numeric|digits:11',
            'shipping_email' => 'required|email:rfc,dns',
            'shipping_address' => 'required|max:250',
            'invoice_name_surname' => 'required|max:250',
            'invoice_tax_administ' => 'nullable|max:250',
            'invoice_tax_number' => 'nullable|max:250',
            'invoice_phone' => 'required|numeric|digits:11',
            'invoice_email' => 'required|email:rfc,dns',
            'invoice_address' => 'required|max:250',
            'note' => 'nullable|max:450'
        );
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attr);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->all()], 401);
        }

        $toplamfiyat = 0;  $toplamkdvtutar = 0;
        $randId = date("dmy").rand(1,9999);
        $basketItems = array();


        if (Session::has('Cart.'.$lang)){
            foreach (Session::get('Cart.'.$lang) as $key => $Cart){
                $data  =  Connections::DataGetSingle('uuid',$Cart['uuid'],$lang);
                $firstBasketItem = new \Iyzipay\Model\BasketItem();
                $firstBasketItem->setId($data->data->static->uuid);
                $firstBasketItem->setName($data->data->dynamic->baslik);
                $ladders = [];
                foreach ($data->ladders as $ladder){
                    $ladders[] = $ladder->name;
                }
                $firstBasketItem->setCategory1(implode("-",$ladders));
                $firstBasketItem->setCategory2($Cart['piece']);
                $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
                $kdvTutar = Helpers::KdvTutar($data->data->dynamic->fiyat,$data->data->dynamic->kdv,$Cart['piece']);
                $toplamkdvtutar = $toplamkdvtutar + $kdvTutar;

                if($masters->e_ticaret->data->dynamic->kdv_status == "Aktif"){

                    $kdvDahil = Helpers::KdvDahil($data->data->dynamic->fiyat,$data->data->dynamic->kdv,$Cart['piece']);

                    $firstBasketItem->setPrice($kdvDahil);

                    $toplamfiyat = $toplamfiyat + $kdvDahil;

                }else{
                    $firstBasketItem->setPrice($data->data->dynamic->fiyat);
                    $toplamfiyat = $toplamfiyat + Helpers::PriceNormalized($data->data->dynamic->fiyat);
                }


                $basketItems[$key] = $firstBasketItem;

            }


        }else{

            return redirect('/');
        }


        if($masters->e_ticaret->data->dynamic->kargo_bedava_limit <= $toplamfiyat){
            $genel_toplamfiyat = $toplamfiyat;
        }else{
            $genel_toplamfiyat = $toplamfiyat + $masters->e_ticaret->data->dynamic->kargo_ucret;
        }

        $options = new \Iyzipay\Options();
        $options->setApiKey($masters->e_ticaret->data->dynamic->iyzico_apikey);
        $options->setSecretKey($masters->e_ticaret->data->dynamic->iyzico_secretkey);
        $options->setBaseUrl($masters->e_ticaret->data->dynamic->iyzico_url);


        $requestIyzico = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $requestIyzico->setLocale(\Iyzipay\Model\Locale::TR);
        $requestIyzico->setConversationId($randId);
        $requestIyzico->setPrice($toplamfiyat);
        $requestIyzico->setPaidPrice($genel_toplamfiyat);
        $requestIyzico->setCurrency(\Iyzipay\Model\Currency::TL);
        $requestIyzico->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $requestIyzico->setCallbackUrl(env('APP_URL')."/".$lang."/Cart/CartUpdate");
        $requestIyzico->setEnabledInstallments(array(2, 3, 6,9));

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($request->shipping_name_surname.rand(1,9999));
        $buyer->setName($request->shipping_name_surname);
        $buyer->setSurname('null');
        $buyer->setGsmNumber($request->shipping_phone);
        $buyer->setEmail($request->shipping_email);

        if ($request->has('Ftc')) {
            $buyer->setIdentityNumber($request->Ftc); //tc
        }else{
            $buyer->setIdentityNumber("00000000000"); //tc
        }


        $buyer->setRegistrationAddress($request->shipping_address);
        $buyer->setIp($request->ip());
        $buyer->setCity("null");
        $buyer->setCountry("null");
        $buyer->setZipCode("00000");
        $requestIyzico->setBuyer($buyer);

        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($request->shipping_name_surname);
        $shippingAddress->setCity("null");
        $shippingAddress->setCountry("null");
        $shippingAddress->setAddress($request->shipping_address);
        $shippingAddress->setZipCode("00000");
        $requestIyzico->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($request->invoice_name_surname);
        $billingAddress->setCity("null");
        $billingAddress->setCountry("null");
        $billingAddress->setAddress($request->invoice_address);
        $billingAddress->setZipCode("00000");
        $requestIyzico->setBillingAddress($billingAddress);


        $requestIyzico->setBasketItems($basketItems);


        $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($requestIyzico, $options)->getCheckoutFormContent();

        $form = $request->all();

        if(empty($request->invoice_tax_number) and empty($request->invoice_tax_administ)){
            $customer_type = "Bireysel";
        }else{
            $customer_type = "Kurumsal";
        }

        $order = array(
            "total_price" => number_format($genel_toplamfiyat,2),
            "tax" => number_format($toplamkdvtutar,2),
            "money_type" => $masters->e_ticaret->data->dynamic->para_birimi,
            "customer_type" => $customer_type
        );

        $order = array_merge($order,$form);

        Session::put('Order', $order);

        return $checkoutFormInitialize;
    }
    public function CartDetail(Request $request)
    {
        $lang = $request->get('lang');
        $datas = null;
        if (Session::has('Cart.'.$lang)){

            foreach (Session::get('Cart.'.$lang) as $key => $Cart){

                $data  =  Connections::DataGetSingle('uuid',$Cart['uuid'],$lang);
                if (!isset($data->status)) {
                    $Cart['key']= $key;
                    $data->data->cart = (object) $Cart;
                    $datas[] = $data->data;
                }else{
                    Session::flush();
                }

            }
            if (empty($datas)){
                return redirect('/');
            }
            $datas = array_values($datas);
            $datas = (object) $datas;

        }else{
            return redirect('/');
        }

        if (view()->exists('addon/cart/index')) {
            return view('addon/cart/index',compact('datas'));
        }else{
            return Helpers::SystemMessageRobots(1);
        }

    }
    public function CartOrder($Order,$Products,Request $request){

        $lang = $request->get('lang');
        $connections = new Connections();
        $mailStatus = (boolean) $Order['mail_status'];
        $mailView = $Order['mail_view'];
        $component = $Order['component'];
        $child_component = $Order['child_component'];
        $close_button_text= $Order['close_button_text'];
        $accept_message = $Order['accept_message'];
        $link = $Order['link'];
        unset($Order['mail_status']);
        unset($Order['mail_view']);
        unset($Order['component']);
        unset($Order['child_component']);
        unset($Order['close_button_text']);
        unset($Order['accept_message']);
        unset($Order['link']);
        $insert     = $connections->DataInsert($component,$lang,$Order);
        if ($insert->status == true){
            /*  Product Settings  */

            foreach ($Products as $Cart){
                $data  =  Connections::DataGetSingle('uuid',$Cart['uuid'],$lang);
                $data->data->cart = (object) $Cart;
                $datas[] = $data->data;
            }
            $Pdatas = array_values($datas);
            $Pdatas = (object) $Pdatas;

            $totalPrice=0;
            $totalPriceGl = 0;
            foreach ($Pdatas as $product){

                $totalPrice=Helpers::PriceNormalized($product->dynamic->fiyat) * $product->cart->piece;
                $totalPriceGl = $totalPriceGl + $totalPrice;
                $newProduct = array(
                    "order_number" => $Order['order_number'],
                    "product_name" => $product->dynamic->baslik,
                    "piece" => $product->cart->piece,
                    "price" => $product->dynamic->fiyat,
                    "total_price" => number_format($totalPrice,2),
                );
                $productList['products'][] = $newProduct;
                $ProductInsert     = $connections->DataInsert($child_component,$lang,$newProduct);


            }

            $subject    = 'Sipariş';
            $Order['email'] = $Order['shipping_email'];
            unset($Order['total_price']);
            $Order['cart_total'] = number_format($totalPriceGl,2);

            if (Helpers::PriceNormalized($this->masters->e_ticaret->data->dynamic->kargo_bedava_limit) <= Helpers::PriceNormalized($totalPriceGl)){
                $Order['ship'] = 0;
            }else{
                $Order['ship'] = $this->masters->e_ticaret->data->dynamic->kargo_ucret;
            }
            $general_total_price=0;
            if($Order['invoice_tax_administ']==null){
                $general_total_price=$totalPriceGl+Helpers::PriceNormalized($Order['ship']);
            }else{
                $general_total_price=  $totalPriceGl+Helpers::PriceNormalized($Order['ship'])+Helpers::PriceNormalized($Order['tax']);
            }
            $setting['settings']=array(
                'total_price'=>number_format($general_total_price,2),
            );
            $datas = array_merge($Order,$productList,$setting);
            dump($datas);
            $connections = new Connections();
            $connections->SendMail($subject,$datas,'theme/extra/mail/PaymentMail',$this->masters->mail_yonetimi->data->dynamic);


            /*  Product Settings  */
            Session::flush();
            return (object)['status'=> true,'message' => $accept_message, 'extra' => $close_button_text,'order_number' => $Order['order_number']];
        }
        return $insert;
    }
    public function CartUpdate(Request $request)
    {
        $lang = $request->get('lang');
        if ($request->has('token') and Session::has('Order') and Session::has('Cart.'.$lang)){

            $options = new \Iyzipay\Options();
            $options->setApiKey($this->masters->e_ticaret->data->dynamic->iyzico_apikey);
            $options->setSecretKey($this->masters->e_ticaret->data->dynamic->iyzico_secretkey);
            $options->setBaseUrl($this->masters->e_ticaret->data->dynamic->iyzico_url);
            $request2 = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
            $request2->setLocale(\Iyzipay\Model\Locale::TR);
            //$request2->setConversationId('123456789');
            $request2->setToken($request->token); //RetrieveCheckoutFormRequest
            $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request2, $options);
            if(strtolower($checkoutForm->getPaymentStatus()) == \Iyzipay\Model\Status::SUCCESS){

                $Order = Session::get('Order');
                if($checkoutForm->getFraudStatus() == 1){
                    $odemeDurum = "Ödendi";
                }else{
                    $odemeDurum = "Beklemede";
                }
                $packet = array(
                    "order_number" => $checkoutForm->getPaymentId(),
                    "payment_status" => $odemeDurum,
                    "payment_type" => "Sanal Pos",
                    "commission" => number_format($checkoutForm->getiyziCommissionRateAmount(),2),
                    "money_type" => $checkoutForm->getCurrency(),
                    "payment_date" => date('d-m-Y H:i:s')
                );
                $Order = array_merge($Order,$packet);
                $Products = Session::get('Cart.'.$lang);

                $response = $this->CartOrder($Order,$Products);

            }else{
                return response()->json(['status'=> false,'message' => 'hata']);
            }

            return view('addon/cart/CartUpdate',compact('response'));
        }


        if($request->has('otherPayment')){
            $Order = Session::get('Order');
            $Products = Session::get('Cart.'.$lang);
            $packet = array(
                "order_number" => date('dmyhis').rand(1,999),
                "payment_status" => "Beklemede",
                "commission" => 0.00,
                "money_type" => 'TRY',
                "payment_date" => date('d-m-Y H:i:s')
            );
            if ($request->otherPayment == 'havale'){
                $packet2 = array("payment_type" => "Havale");
                $Order = array_merge($Order,$packet);
                $Order = array_merge($Order,$packet2);
                $response = $this->CartOrder($Order,$Products);


            }
            if ($request->otherPayment == 'kapida'){
                $packet2 = array("payment_type" => "Kapıda Ödeme");
                $Order = array_merge($Order,$packet);
                $Order = array_merge($Order,$packet2);
                $response = $this->CartOrder($Order,$Products);
            }

            return view('addon/cart/CartUpdate',compact('response'));
        }



        return redirect('/');

    }
}
