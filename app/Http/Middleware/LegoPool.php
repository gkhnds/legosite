<?php

namespace App\Http\Middleware;

use Helpers;
use Carbon\Carbon;
use Closure;
Use App;
use Curl\Curl;
use Connections;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
//use LSCache;
class LegoPool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //public $attributes;
    // protected $addHttpCookie = false;


    public function NewToken(){

        $curl = new Curl();

        $curl->post(Config::get('settings.SERVER_ADDRESS') . '/api/auth/login', array(
            'email' => Config::get('settings.DEVELOPER_USERNAME'),
            'password' => Config::get('settings.DEVELOPER_PASSWORD'),
        ));
        $curl->close();
        if ($curl->error) {
            $token = Cache::remember(Config::get('settings.APP_UUID').'-Token', 1, function ()  {
                return 'Error';
            });
            return $token;
        } else {
            if (isset($curl->response->access_token)){
                $token = Cache::remember(Config::get('settings.APP_UUID').'-Token', 3500, function () use ($curl) {
                    return $curl->response->access_token;
                });
                return $token;
            }
        }

    }


    public function TokenControl($token){

        $curl = new Curl();
        $url = Config::get('settings.SERVER_ADDRESS').'/api/tokenValidation?token='.$token;
        $curl->get($url);
        $curl->close();
        if (isset($curl->response->message)){
            if ($curl->response->message != true){
                $this->NewToken();
            }
        }
    }


    public function handle(Request $request, Closure $next)
    {

        if (Config::has('settings')) {
            if (Config::get('settings.INSTALL_STATUS') == 'Success'){
                $curl = new Curl();
                $url = Config::get('settings.SERVER_ADDRESS').'/api/ServerConnectionControl';
                $curl->get($url);
                ($curl->error) ?  $ServerStatus = 0 : $ServerStatus = 1;
                $curl->close();
                Config::set(['ServerStatus' => ['status' => $ServerStatus]]);
            }

            if (Config::get('settings.INSTALL_STATUS') == 'Success'){

                if (Config::get('ServerStatus.status') == 1) {

                    if (Cache::has(Config::get('settings.APP_UUID').'-Token')){
                        $this->TokenControl(Cache::get(Config::get('settings.APP_UUID').'-Token'));
                    }else{
                        $this->NewToken();
                    }

                }else{
                    return redirect('connection')->send();
                }


            }else{
                return redirect('system/welcome')->send();
            }
        }else{
            return redirect('system/welcome')->send();
        }

        $Languages = Connections::Languages();


        if ($request->segment(1) == "system"){

            if (Session::has('developer.lang')){

                App::setLocale(Session::get('developer.lang'));
            }else{
                foreach ($Languages as $lang){
                    if ($lang->default_param == 1){
                        Config::set('settings.DEFAULT_LANG',$lang->short_name);
                        Session::put('developer.lang',$lang->short_name);
                        App::setLocale($lang->short_name);
                    }
                }
            }

        }else{

            if (empty($request->segment(1))){

                foreach ($Languages as $lang){
                    if ($lang->default_param == 1){
                        Config::set('settings.DEFAULT_LANG',$lang->short_name);
                        App::setLocale($lang->short_name);
                    }
                }
                return redirect()->route('Index', ['lang' => Config::get('settings.DEFAULT_LANG')]);
            }



        }



        $translate = null;
        $ladders = null;
        $masters = null;
        $homeModule = null;
        $footerModule = null;
        $fixedModule = null;
        $leftModule = null;
        $rightModule = null;
        $extra = null;

        foreach ($Languages as $lang){
            if ($lang->default_param == 1){
                Config::set('settings.DEFAULT_LANG',$lang->short_name);
            }
        }


        $langControl = Connections::LanguagesIssetControl($request->segment(1),$Languages);


        if($langControl == true){
            App::setLocale($request->segment(1));
            //return $next($request);

        }else{

            if (Config::get('settings.DEVELOPER_MODE') == true){


                $message = __('system.0');
                $html = view('system/debug/error',compact("message"))->render();
                return $html;
            }else{

                App::setLocale(Config::get('settings.DEFAULT_LANG'));
                if ($request->segment(1) != "system") {
                    redirect(Config::get('settings.DEFAULT_LANG'))->send();
                }
            }

            // return $langControl->message;
        }


        /*
        foreach ($request->input() as $key => $value) {
            if (empty($value)) {
                $request->request->set($key, null);
            }
        }*/


        $CustomParameters = Connections::CustomsSettingsParam();

        $CustomParameters->DefaultLanguage = Config::get('settings.DEFAULT_LANG');
        Config::set('settings.DEVELOPER_MODE',$CustomParameters->DeveloperMode);
        Config::set('settings.QUERY_CACHE',$CustomParameters->QueryCache);
        Config::set('settings.FILE_CACHE',$CustomParameters->FileCache);
        Config::set('settings.QUERY_CACHE_DURATION',$CustomParameters->QueryCacheDuration);
        Session::put('dev_mode',Config::get('settings.DEVELOPER_MODE'));
        Config::set('settings.FILE_CACHE_IMAGE_WIDTH',$CustomParameters->DataThumbsWidthPx);
        Config::set('settings.FILE_CACHE_IMAGE_HEIGHT',$CustomParameters->DataThumbsHeightPx);
        $devmode = Config::get('settings.DEVELOPER_MODE');
        if ($devmode == true){
            //LSCache::purgeAll();
        }






        $masters          = Connections::MastersComponentList(App::currentLocale(),$CustomParameters);
        $ladders          = Connections::LaddersDataAllList(App::currentLocale());
        $translate        = Connections::TranslateDataAllList($masters,$CustomParameters);

        View::share([
            'languages' => $Languages,
            'CustomParameters' => $CustomParameters,
            'masters'           => $masters,
            'ladders'           => $ladders,
            'lang'              => App::currentLocale(),
            'translate'      => $translate,
            'footerModule' => $footerModule,
            'fixedModule' => $fixedModule,
            'leftModule' => $leftModule,
            'rightModule' => $rightModule,
        ]);


        /*
                if($request->segment(2) == "developer"){
                    (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() : true;
                }
        */
        date_default_timezone_set($CustomParameters->Time);


        $request->attributes->add(['CustomParameters' => $CustomParameters,'languages' => $Languages,'translate' => $translate,'masters' => $masters,'ladders'=>$ladders,'lang' => App::currentLocale()]);

        if ($CustomParameters->SecureStatus == true){
            if (!$request->secure()) {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request);
        }else{


        }





    }
}
