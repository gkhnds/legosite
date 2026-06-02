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

class LegoStart
{

    public function handle(Request $request, Closure $next)
    {

            if (Config::has('settings')) {
                if (Config::get('settings.INSTALL_STATUS') == 'Success'){

                        if (Config::get('ServerStatus.status') == 1) {

                            if (Cache::has(Config::get('settings.APP_UUID').'-Token')){
                                $this->TokenControl(Cache::get(Config::get('settings.APP_UUID').'-Token'));
                            }else{
                                $this->NewToken();
                            }
                            return $next($request);
                        }else{
                            return redirect('connection')->send();
                        }


                }else{
                    return redirect('system/welcome')->send();
                }
            }else{
                return redirect('system/welcome')->send();
            }


    }

}
