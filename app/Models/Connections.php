<?php

namespace App\Models;
use App;
use Helpers;
use Curl\Curl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
class Connections {

    protected $token;
     public  function  __construct()
    {
        $this->token = Cache::get(Config::get('settings.APP_UUID').'-Token');
    }

     public static function  token(){
        return Cache::get(Config::get('settings.APP_UUID').'-Token');
    }

     public static function  CustomsSettingsParam(){
        /* Uygulama özel parametrelerini çağırır */
        $curl = new Curl;
        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/customSettings/tr/?token='.self::token();
        $curl->get($url);
        $curl->close();
        if ($curl->error) {
            return 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            return json_decode($curl->response->Parameters,false);
        }
    }

     public static function  TranslateDataAllList($masters,$CustomParameters){
        $hash = Config::get('settings.APP_UUID').'-Translate-'.App::currentLocale();
        if (Config::get('settings.DEVELOPER_MODE') == false)
        {
            if (Cache::has($hash)){
                $translate = Cache::get($hash);
            }else{

                $translate = Cache::rememberForever($hash , function () use ($masters,$CustomParameters) {
                    foreach ($masters as $master){
                        // Translate Components Operation
                        if ($master->component->uuid == $CustomParameters->TranslateComponent){
                            foreach ($master->data as $translate) {
                                $translations[$translate->dynamic->tag] = $translate->dynamic->yazi;
                            }
                            $translate = (object) $translations;
                        }
                    }
                    return $translate;
                });

                return $translate;

            }

        }else{

            foreach ($masters as $master){
                // Translate Components Operation
                if ($master->component->uuid == $CustomParameters->TranslateComponent){
                    foreach ($master->data as $translate) {
                        $translations[$translate->dynamic->tag] = $translate->dynamic->yazi;
                    }
                    $translate = (object) $translations;
                }
            }
        }


        return (object) $translate;
    }


     public static function  DataUpdate($recordId,$lang,$request){
        /* Veri Güncelleme
        recordId => (Veri benzersiz kimlik numarası)
        lang => (Ver Dili)
        request => (Form verilerinin dizi hali)
        */
        $curl = new Curl;
        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/update/'.$recordId.'/'.$lang.'/?token='.self::token();
        $curl->post($url,$request);
        $curl->close();
        if ($curl->error) {
            return 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            return $curl->response;
        }
    }

     public static function  DataGetAll($componentId,$lang,$dynamicWhere = null,$staticWhere = null,$filterOrder = null,$filterLimit = null,$paginate = null,$pageNumber = null)
    {
        /* Veri Listeleme
        componentId => (Bileşen benzersiz kimlik numarası)
        lang => (Ver Dili)
        dynamicWhere => (Bileşenin lego paneli üzerinden özel açılan sutunlarında işlem yapar)
        staticWhere => (Veritabanındaki sabit sutunlarda işlem yapar)
        filterOrder => (Order ,Asc,Desc)
        filterLimit => (Limit)
        paginate => (Sayfalama yapılacaksa sayfalanacak veri adeti)
        pagenumber => (Kaçıncı sayfa çekilecek)
        */

        $url  = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/list/'.$componentId.'/'.$lang.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-ALL-'.$componentId.'-'.$lang;

        if ($filterOrder != null) {
            $url .= "&filterOrder=".$filterOrder;
            $hash.= '-'.$filterOrder;
        }

        if ($filterLimit != null) {
            $url .= "&filterLimit=".$filterLimit;
            $hash.= '-'.$filterLimit;
        }

        if ($paginate != null) {
            $url .= "&paginate=".$paginate;
            $hash.= '-'.$paginate;
        }

        if ($dynamicWhere != null) {
            foreach ($dynamicWhere as $xwe){
                $url .= "&dynamicWhere[]=".$xwe;
                $hash.= '-'.$xwe;
            }
        }

        if ($staticWhere != null) {
            foreach ($staticWhere as $xwe){
                $url .= "&staticWhere[]=".$xwe;
                $hash.= '-'.$xwe;
            }
        }

        if ($pageNumber != null) {
            $url .= "&page=".$pageNumber;
            $hash.= '-'.$pageNumber;
        }

        return self::QueryRepository($url,$hash);

    }

     public static function  MastersRepository($url,$hash,$CustomParameters){
        $curl = new Curl;
        $extra = [];
        if (Config::get('settings.DEVELOPER_MODE') == false)
        {
            if (Cache::has($hash)){
                $response      = Cache::get($hash);
                $curl->close();
                return $response;
            }else{
                $curl->get($url);
                $curl->close();

                if (!$curl->error) {
                    $response = $curl->response;

                    $response =  Cache::rememberForever($hash , function () use ($response,$CustomParameters) {
                        if (isset($CustomParameters->ManuelMasterComponents)){

                            if (count($CustomParameters->ManuelMasterComponents) > 0){
                                foreach ($CustomParameters->ManuelMasterComponents as $ManuelComponentId){
                                    $extraMasterComponent = Connections::ComponentSingleData($ManuelComponentId,App::currentLocale());
                                    unset($extraMasterComponent->ladders);
                                    $extra[Str::slug($extraMasterComponent->component->name,'_')] = $extraMasterComponent;
                                }
                            }
                        }
                        $response = (object) array_merge((array) $response, (array) $extra);
                        return $response;
                    });
                    return $response;
                }
            }
        }else{
            if (Cache::has($hash)){
                Cache::forget($hash);
            }
            $curl->get($url);
            $curl->close();
            if ($curl->error) {
                return  ['message' => $curl->errorMessage,'status' => false,'code'=>$curl->errorCode];
            } else {
                $response = $curl->response;

                if (isset($CustomParameters->ManuelMasterComponents)){

                    if (count($CustomParameters->ManuelMasterComponents) > 0){
                        foreach ($CustomParameters->ManuelMasterComponents as $ManuelComponentId){
                            $extraMasterComponent = Connections::ComponentSingleData($ManuelComponentId,App::currentLocale());
                            unset($extraMasterComponent->ladders);
                            $extra[Str::slug($extraMasterComponent->component->name,'_')] = $extraMasterComponent;
                        }
                    }
                }


                $response = (object) array_merge((array) $response, (array) $extra);
                return $response;
            }
        }
    }

     public static function  QueryRepository($url,$hash){
        $hash = Str::slug($hash);
        $curl = new Curl;

        if (Config::get('settings.QUERY_CACHE') == true)
        {
            if (Cache::tags('query')->has($hash)){

                $response      = Cache::tags('query')->get($hash);
                $curl->close();
                return $response;
            }else{
                $curl->get($url);
                $curl->close();
                if (!$curl->error) {
                    $response = $curl->response;
                    Cache::tags('query')->remember($hash ,Config::get('settings.QUERY_CACHE_DURATION') * 1440, function () use ($response) {
                        return $response;
                    });
                    return $response;
                }
            }
        }else{
            if (Cache::tags('query')->has($hash)){
                Cache::tags('query')->forget($hash);
            }
            $curl->get($url);
            $curl->close();
            if ($curl->error) {
                return  ['message' => $curl->errorMessage,'status' => false,'code'=>$curl->errorCode];
            } else {
                $response = $curl->response;
                return $response;
            }
        }

    }




     public static function  DataGetSingle($selectorType,$recordSelectorValue,$lang){
        if ($selectorType == 'slug'){
            $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/slug/'.$recordSelectorValue.'/'.$lang.'/?token='.self::token();
            $hash = Config::get('settings.APP_UUID').'-Slug-'.$recordSelectorValue.'-'.$lang;
        }else if($selectorType == 'uuid'){
            $hash = Config::get('settings.APP_UUID').'-Id-'.$recordSelectorValue.'-'.$lang;
            $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/single/'.$recordSelectorValue.'/'.$lang.'/?token='.self::token();
        }else{
            return 'Error: Seçim türünü doğru belirtin!';
        }

        return self::QueryRepository($url,$hash);


    }

     public static function  DataDelete($recordId,$lang){
        $curl = new Curl;
        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/delete/'.$recordId.'/'.$lang.'/?token='.self::token();
        $curl->get($url);
        $curl->close();
        if ($curl->error) {
            return 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            return $curl->response;
        }
    }

     public static function  LadderGetAll($lang){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/ladders/'.Config::get('settings.APP_UUID').'/laddersList/'.$lang.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-LaddersList-'.$lang;
        return self::QueryRepository($url,$hash);

    }

     public static function  LaddersDataList($selectorType,$recordSelectorValue,$lang){
        if ($selectorType == 'slug'){
            $url = Config::get('settings.SERVER_ADDRESS').'/api/ladders/'.Config::get('settings.APP_UUID').'/laddersDataList/slug/'.$recordSelectorValue.'/'.$lang.'/?token='.self::token();
            $hash = Config::get('settings.APP_UUID').'-LaddersDataList-Slug-'.$recordSelectorValue.'-'.$lang;
            return self::QueryRepository($url,$hash);

        }else if($selectorType == 'uuid'){
            $url = Config::get('settings.SERVER_ADDRESS').'/api/ladders/'.Config::get('settings.APP_UUID').'/laddersDataList/uuid/'.$recordSelectorValue.'/'.$lang.'/?token='.self::token();
            $hash = Config::get('settings.APP_UUID').'-LaddersDataList-Id-'.$recordSelectorValue.'-'.$lang;
            return self::QueryRepository($url,$hash);


        }else{
            return 'Error: Seçim türünü doğru belirtin!';
        }

    }

     public static function  LaddersSlugSingle($slug,$lang){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/ladders/'.Config::get('settings.APP_UUID').'/laddersDataSlug/'.$slug.'/'.$lang.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-laddersDataSlug-'.$slug.'-'.$lang;
        return self::QueryRepository($url,$hash);



    }


     public static function  LaddersUuidSingle($uuid,$lang){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/ladders/'.Config::get('settings.APP_UUID').'/laddersDataSingle/'.$uuid.'/'.$lang.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-laddersDataSingle-'.$uuid.'-'.$lang;
        return self::QueryRepository($url,$hash);

    }

     public static function  Languages(){
        $curl = new Curl();
        $url = Config::get('settings.SERVER_ADDRESS') . '/api/application/' . Config::get('settings.APP_UUID') . '/languages/?token=' . self::token();
        $curl->get($url);
        if ($curl->error) {
            return (object)['message' => $curl->errorMessage, 'status' => false, 'code' => $curl->errorCode];
        } else {
            $response = $curl->response;
            $curl->close();
            return $response;
        }

    }

     public static function  LanguagesIssetControl($short_name,$Languages){

        foreach ($Languages as $Language){
            if ($Language->short_name == $short_name){
                return true;
            }
        }

        return false;
    }



     public static function  ComponentSlugSingle($slug,$lang){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/componentSlugSingle/'.$slug.'/'.$lang.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-ComponentSlugSingle-'.$slug.'-'.$lang;
        return self::QueryRepository($url,$hash);

    }
     public static function  ComponentSingleData($uuid,$lang){


        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/componentSingleData/'.$uuid.'/'.$lang.'/?token='.self::token();

        $hash = Config::get('settings.APP_UUID').'-componentSlugSingle-'.$uuid.'-'.$lang;
        return self::QueryRepository($url,$hash);

    }

     public static function  MastersComponentList($lang,$CustomParameters){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/designComponentList/'.$lang.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-Masters-'.$lang;
        return self::MastersRepository($url,$hash,$CustomParameters);


    }

     public static function  LaddersDataAllList($lang){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/ladders/'.Config::get('settings.APP_UUID').'/laddersDataAllList/'.$lang.'/?token='.self::token();

        $hash = Config::get('settings.APP_UUID').'-LaddersDataAllList-'.$lang;
        return self::QueryRepository($url,$hash);


    }

     public static function  Search($componentId,$tags,$columns,$lang,$filterOrder = null,$filterLimit = null,$paginate = null,$pageNumber = null)
    {
        $url  = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/search/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-Search';

        if ($filterOrder != null) {
            $url .= "&filterOrder=".$filterOrder;
            $hash.= '-'.$filterOrder;
        }

        if ($filterLimit != null) {
            $url .= "&filterLimit=".$filterLimit;
            $hash.= '-'.$filterLimit;
        }

        if ($componentId != null) {
            $url .= "&components_uuid=".$componentId;
            $hash.= '-'.$componentId;
        }

        if ($paginate != null) {
            $url .= "&paginate=".$paginate;
            $hash.= '-'.$paginate;
        }


        if ($lang != null) {
            $url .= "&lang=".$lang;
            $hash.= '-'.$lang;
        }





        if ($tags != null) {
            foreach ($tags as $xwe){
                $url .= "&tags[]=".$xwe;
                $hash.= '-'.$xwe;
            }
        }
        if ($columns != null) {
            $url .= "&columns[]=".$columns;
            $hash.= '-'.$columns;
        }

        if ($pageNumber != null) {
            $url .= "&page=".$pageNumber;
            $hash.= '-'.$pageNumber;
        }

        return self::QueryRepository($url,$hash);


    }



     public static function  LadderAndDatas($component_slug,$slug,$lang,$dynamicWhere = null,$staticWhere = null,$filterOrder = null,$filterLimit = null,$paginate = null,$pageNumber = null){

        $url  = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/laddersData/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-LaddersData';

        if ($filterOrder != null) {
            $url .= "&filterOrder=".$filterOrder;
            $hash .= '-'.$filterOrder;
        }

        if ($filterLimit != null) {
            $url .= "&filterLimit=".$filterLimit;
            $hash .= '-'.$filterLimit;
        }
        if ($paginate != null) {
            $url .= "&paginate=".$paginate;
            $hash .= '-'.$paginate;
        }

        if ($component_slug != null) {
            $url .= "&component_slug=".$component_slug;
            $hash .= '-'.$component_slug;
        }

        if ($dynamicWhere != null) {
            foreach ($dynamicWhere as $xwe){
                $url .= "&dynamicWhere[]=".$xwe;
                $hash .= '-'.$xwe;
            }
        }

        if ($staticWhere != null) {
            foreach ($staticWhere as $xwe){
                $url .= "&staticWhere[]=".$xwe;
                $hash .= '-'.$xwe;
            }
        }

        if ($pageNumber != null) {
            $url .= "&page=".$pageNumber;
            $hash .= '-'.$pageNumber;
        }

        if ($slug != null) {
            $url .= "&slug=".$slug;
            $hash .= '-'.$slug;
        }
        if ($lang != null) {
            $url .= "&lang=".$lang;
            $hash .= '-'.$lang;
        }
        return self::QueryRepository($url,$hash);

    }

     public static function  SendMail($subject,$variables,$mailView,$host)
    {
        $existing      = Config::get('mail');
        $new = array_merge(
            $existing, [
            'host' => $host->smtp_sunucu,
            'port' => $host->smtp_port,
            'from' => [
                'address' => $host->email,
                'name' => $host->mail_title,
            ],
            'encryption' => $host->smtp_encryption,
            'username' => $host->email,
            'password' => $host->sifre,
        ]);

        Config::set(['mail'=>$new]);

        if ($variables['mail_backup'] == true)  {
            for ($i = 1; $i <= 2; $i++){
                if ($i == 1){
                    $toEmail = $variables['email'];
                }else{
                    $toEmail = $host->alici_mail;
                }
                $variables['sitename'] = $variables['link'];

                if ($variables['custom_form'] == true) {
                    $mailData = $variables;
                    unset($mailData['sitename']);
                    unset($mailData['mail_backup']);
                    unset($mailData['custom_message']);
                    unset($mailData['accept_message']);
                    unset($mailData['link']);
                    unset($mailData['validate_message']);
                    unset($mailData['custom_form']);
                    if(!empty($variables['file']))
                    {
                        $attachFile = $variables['file'];
                        unset($mailData['file']);
                    }
                    else
                    {
                        $attachFile = null;
                    }

                    Mail::send($mailView, ['mailData' => $mailData], function ($message) use ($toEmail, $subject, $mailData, $attachFile) {
                        $message->to($toEmail, $toEmail)->subject($subject);

                        if(!empty($attachFile)) {
                            foreach ($attachFile as $file){
                                $message->attach($file,[
                                    'as' => $file->getClientOriginalName(),
                                    'mime' => $file->getClientOriginalExtension()
                                ]);
                            }
                        }
                    });
                }
                else
                {
                    Mail::send($mailView,  $variables, function($message) use ($toEmail,$subject)
                    {
                        $message->to($toEmail, $toEmail)->subject($subject);
                    });
                }

            }
        }else{
            $toEmail = $variables['email'];
            $variables['sitename'] = $variables['link'];
            if($variables['custom_form'] == true)
            {
                $mailData = $variables;
                unset($mailData['sitename']);
                unset($mailData['mail_backup']);
                unset($mailData['custom_message']);
                unset($mailData['accept_message']);
                unset($mailData['link']);
                unset($mailData['validate_message']);
                unset($mailData['custom_form']);
                if(!empty($variables['file']))
                {
                    $attachFile = $variables['file'];
                    unset($mailData['file']);
                }
                else
                {
                    $attachFile = null;
                }

                Mail::send($mailView, ['mailData'=>$mailData], function($message) use ($toEmail,$subject,$mailData,$attachFile)
                {
                    $message->to($toEmail,$toEmail)->subject($subject);
                    if(!empty($attachFile)) {
                        foreach ($attachFile as $file) {
                            $message->attach($file, [
                                'as' => $file->getClientOriginalName(),
                                'mime' => $file->getClientOriginalExtension()
                            ]);
                        }
                    }
                });
            }
            else
            {
                Mail::send($mailView, $variables, function($message) use ($toEmail,$subject)
                {
                    $message->to($toEmail,$toEmail)->subject($subject);
                });
            }

        }
        return 1;
    }

     public static function  Components(){
        $url = Config::get('settings.SERVER_ADDRESS').'/api/components/'.Config::get('settings.APP_UUID').'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-Components-List';
        return self::QueryRepository($url,$hash);

    }

     public static function  ComponentsSingleUuid($uuid){

        $url = Config::get('settings.SERVER_ADDRESS').'/api/components/'.Config::get('settings.APP_UUID').'/'.$uuid.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-Components-Single-'.$uuid;
        return self::QueryRepository($url,$hash);

    }

     public static function  DataInsert($componentId,$lang,$request){
        $curl = new Curl;
        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/insert/'.$componentId.'/'.$lang.'?token='.self::token();
        $curl->post($url,$request);
        $curl->close();
        if ($curl->error) {
            return 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            return $curl->response;
        }
    }

     public static function  WhmcsCacheRepository($url,$pid){

        $response = Cache::remember(Config::get('settings.APP_UUID').'-whmcs_product-'.$pid, 12000, function () use ($pid,$url) {

            $api_identifier = "hvggllyzFkwjkXWbJR8HDDUBNVwC95Vv";
            $api_secret = "DVd2RiNmNnU0tK0awAOm0IcafosurmXa";
            $postfields = array(
                'identifier' => $api_identifier,
                'secret' => $api_secret,
                'pid' => $pid,
                'action' => 'GetProducts',
                'responsetype' => 'json',
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,  $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
            $response = curl_exec($ch);
            if (curl_error($ch)) {
                die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
            }
            curl_close($ch);
            $response = json_decode($response);
            if ($response->result == "success") {
                return $response->products->product[0];
            }

        });
        return $response;
    }

     public static function  ProductData($pid){
        $url = "https://panel.creaati.com/includes/api.php";
        return self::WhmcsCacheRepository($url,$pid);
    }

     public static function  ProductDataPrice($pid,$para_birimi,$taksit_sayisi){
        $alldatas = Connections::ProductData($pid);
        if ($taksit_sayisi > 0){
            if($para_birimi == '₺'){
                $yillik_odeme = $alldatas->pricing->USD->annually;
                $prefix =$alldatas->pricing->TRY->prefix;
                $toplam= $alldatas->pricing->TRY->asetupfee + $alldatas->pricing->TRY->annually;
                $kdvli_toplam= $toplam * 1.18;
                $taksitli_fiyat = floor($kdvli_toplam / $taksit_sayisi);


            }else{

                $prefix =$alldatas->pricing->USD->prefix;
                $toplam= $alldatas->pricing->USD->asetupfee + $alldatas->pricing->USD->annually;
                $kdvli_toplam= $toplam * 1.18;
                $taksitli_fiyat = floor($kdvli_toplam / $taksit_sayisi);
                $yillik_odeme = $alldatas->pricing->USD->annually;
            }
        }else{
            if($para_birimi == '₺'){
                $taksitli_fiyat = false;
                $prefix =$alldatas->pricing->TRY->prefix;
                $toplam =  $alldatas->pricing->TRY->asetupfee + $alldatas->pricing->TRY->annually;
                $yillik_odeme = $alldatas->pricing->USD->annually;
            }else{
                $taksitli_fiyat = false;
                $prefix =$alldatas->pricing->USD->prefix;
                $toplam= floor($alldatas->pricing->USD->asetupfee + $alldatas->pricing->USD->annually);
                $yillik_odeme = $alldatas->pricing->USD->annually;
            }
        }
        $data = ['fiyat' => $toplam ,'prefix' => $prefix,'taksit' => $taksit_sayisi,'taksitli_fiyat' => $taksitli_fiyat];
        return (object) $data;
    }


    public static function  SocialDataPrice($pid,$para_birimi,$taksit_sayisi){
        $alldatas = Connections::ProductData($pid);
        if ($taksit_sayisi > 0){
            if($para_birimi == '₺'){
                $prefix =$alldatas->pricing->TRY->prefix;
                $toplam= $alldatas->pricing->TRY->asetupfee + $alldatas->pricing->TRY->monthly;
                $kdvli_toplam= $toplam * 1.18;
                $taksitli_fiyat = floor($kdvli_toplam / $taksit_sayisi);

            }else{

                $prefix =$alldatas->pricing->USD->prefix;
                $toplam= $alldatas->pricing->USD->asetupfee + $alldatas->pricing->USD->monthly;
                $kdvli_toplam= $toplam * 1.18;
                $taksitli_fiyat = floor($kdvli_toplam / $taksit_sayisi);
            }
        }else{
            if($para_birimi == '₺'){
                $taksitli_fiyat = false;
                $prefix =$alldatas->pricing->TRY->prefix;
                $toplam =  $alldatas->pricing->TRY->asetupfee + $alldatas->pricing->TRY->monthly;
            }else{
                $taksitli_fiyat = false;
                $prefix =$alldatas->pricing->USD->prefix;
                $toplam= floor($alldatas->pricing->USD->asetupfee + $alldatas->pricing->USD->monthly);
            }
        }
        $data = ['fiyat' => $toplam ,'prefix' => $prefix,'taksit' => $taksit_sayisi,'taksitli_fiyat' => $taksitli_fiyat];
        return (object) $data;
    }

     public static function  GetLangsSingleDatas($slug)
    {

        $url = Config::get('settings.SERVER_ADDRESS').'/api/application/'.Config::get('settings.APP_UUID').'/slugAllLang/'.$slug.'/?token='.self::token();
        $hash = Config::get('settings.APP_UUID').'-GetLangsSingleDatas-'.$slug;
        return self::QueryRepository($url,$hash);

    }

}








