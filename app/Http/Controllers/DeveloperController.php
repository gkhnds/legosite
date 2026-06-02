<?php

namespace App\Http\Controllers;
use LSCache;
use Connections;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
class DeveloperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {

    }
    public function Index(){

        return (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  view('system/debug/index');
    }
    public function CustomParameter(){
        return (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  view('system/debug/customparameter');
    }
    public function Masters(){
        return (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  view('system/debug/masters');
    }
    public function Translate(){
        return (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  view('system/debug/translations');
    }
    public function Ladders(){
        return (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  view('system/debug/ladders');

    }
    public function developerBar(){
        if (Session::get('dev_mode') == true){
            LSCache::purgeAll();
        }
        return view('system/developermenu');
    }
    public function LangChange($lang){

        (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  Session::put('developer.lang', $lang);
    }
    public function ErrorLog(){
        return (Config::get('settings.DEVELOPER_MODE') == false) ? redirect('/')->send() :  view('system/debug/errorlog');
    }

}
