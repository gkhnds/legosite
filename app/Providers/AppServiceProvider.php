<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Curl\Curl;
use Illuminate\Support\Facades\Cache;
use App;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       // redirect('/connection');
        config([
            'config/settings.php',
        ]);
        /*
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
        */


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::component('Modules', Modules::class);

    }






}
