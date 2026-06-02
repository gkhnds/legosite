<?php

namespace App\Http\Controllers;
use LSCache;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
class SystemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Request $request)
    {

    }

    public function Welcome(){
        if (Config::has('settings')){
            return redirect()->route('Hello');
        }else{
            return view('system/index');
        }
    }






    public function RemoveTemplate($uuid){

        if ($uuid == Config::get('settings.APP_UUID')){
            $folderPath= $_SERVER['DOCUMENT_ROOT'];
            File::deleteDirectory($folderPath);
            File::makeDirectory($folderPath);
            return redirect('/');
        }else{
            return 'Anahtar Gönderin!';
        }

    }


    public function Optimize($uuid){

        if ($uuid == Config::get('settings.APP_UUID')){
            Cache::flush();
            LSCache::purgeAll();
            Session::flush();
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('cache:clear');

           return $this->FileClear();
        }else{
            return 'Anahtar Gönderin!';
        }

    }


    public function Connection(){
        return view('system/connection');
    }
    public function LiteSpeedClear(){

       //LSCache::purgeAll();
        return redirect()->route('Hello');
    }
    public function Error(){
        return view('system/error');
    }
    public function Install(){

        if (Config::has('settings')){
            return redirect()->route('Hello');
        }else{
            return view('system/install');

        }
    }

    public function FileClear(){

        if (Config::get('settings.DEVELOPER_MODE') == true){

            $cachedViews = public_path('/cache/original/');
            $files = glob($cachedViews.'*');
            foreach($files as $file) {
                if(is_file($file)) {
                    @unlink($file);
                }
            }
            $cachedViews = public_path('/cache/thumbs/');
            $files = glob($cachedViews.'*');
            foreach($files as $file) {
                if(is_file($file)) {
                    @unlink($file);
                }
            }
            Cache::tags(['file'])->flush();

        }

        return redirect()->route('Hello');


    }
    public function QueryClear(){
        if (Config::get('settings.DEVELOPER_MODE') == true) {
            Cache::tags(['query'])->flush();
            return redirect()->route('Hello');
        }
    }

    public function MastersClear(){
        if (Config::get('settings.DEVELOPER_MODE') == true) {
            Cache::tags(['query', 'ladders'])->flush();
            return redirect()->route('Hello');
        }
    }


    public function ViewClear(){
        if (Config::get('settings.DEVELOPER_MODE') == true) {
            $cachedViews = storage_path('/framework/views/');
            $files = glob($cachedViews . '*');

            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            return redirect()->route('Hello');
        }
    }
    public function SessionClear(){
        if (Config::get('settings.DEVELOPER_MODE') == true) {
            Session::flush();
            $cachedViews = storage_path('/framework/sessions/');
            $files = glob($cachedViews . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            return redirect()->route('Hello');
        }
    }
    public function CacheClear(){
        if (Config::get('settings.DEVELOPER_MODE') == true) {
            Cache::flush();
            $cachedViews = storage_path('/framework/views/');
            $files = glob($cachedViews . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            return redirect()->route('Hello');
        }
    }

    public function InstallPost (Request $request){

        if (Config::has('settings')){
            return redirect()->route('Hello');
        }else{
            Config::set(['settings' => [
                'SERVER_ADDRESS' => $request->SERVER_ADDRESS,
                'DEVELOPER_USERNAME' => $request->DEVELOPER_USERNAME,
                'DEVELOPER_PASSWORD' => $request->DEVELOPER_PASSWORD,
                'APP_UUID' => $request->APP_UUID,
                'SECURE_STATUS' => $request->SECURE_STATUS,
                'INSTALL_STATUS' => 'Success',
                'SESSION_DOMAIN' => request()->getHost(),
            ]]);

            $fp = fopen(base_path() .'/config/settings.php' , 'w');
            fwrite($fp, '<?php return ' . var_export(Config::get('settings'), true) . ';');
            fclose($fp);
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            return redirect()->route('Hello');
        }

    }
}
