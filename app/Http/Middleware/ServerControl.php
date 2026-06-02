<?php

namespace App\Http\Middleware;
use App;
use Closure;
use Curl\Curl;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class ServerControl
{

    public function __construct() {

    }
    public function handle(Request $request, Closure $next)
    {

        if (Config::has('settings')){

            if (Config::get('settings.INSTALL_STATUS') == 'Success'){
                $curl = new Curl();
                $url = Config::get('settings.SERVER_ADDRESS').'/api/ServerConnectionControl';
                $curl->get($url);
                ($curl->error) ?  $ServerStatus = 0 : $ServerStatus = 1;
                $curl->close();
                Config::set(['ServerStatus' => ['status' => $ServerStatus]]);
            }

        }
        return $next($request);
    }


}
