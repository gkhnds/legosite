<?php

namespace App\Http\Middleware;
use App;
use Connections;
use Closure;
use Curl\Curl;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use  Illuminate\Support\Facades\Cache;
use  Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
class Rotation
{

    public function handle(Request $request, Closure $next)
    {

        $Languages = Connections::Languages();

/*
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
*/
        return $next($request);





    }


}
