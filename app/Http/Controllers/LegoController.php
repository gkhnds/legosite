<?php

namespace App\Http\Controllers;
use App;
//use LSCache;
use Helpers;
use Connections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Routing\Redirector;
// use Illuminate\Config\FileLoader;

class LegoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function __construct()
    {

    }


    public function error404(){
        return view('theme/404');
    }
    public function devStatus(){
        if(Config::get('settings.DEVELOPER_MODE') == true)  {
            //LSCache::purgeAll();
            return ' Developer Aktif';
        }else{
            return 'Developer Pasif';
        }
    }
    public function Starting(){

    }

    public function Rotation(Request $request){
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
    }

    public function Index(Request $request)
    {
        return view('theme/index');
    }

    public function Paginate($lang,$component_slug,$slug,$pageNumber)
    {
        $component_info = Connections::ComponentSlugSingle($component_slug,$lang);
        $order =$component_info->order_by;
        if ($component_info->limit == 0){
            $paginate = $component_info->paginate;
            $limit = null;
        }else{
            $paginate = null;
            $limit = $component_info->limit;
        }

        $multiple = Connections::LadderAndDatas($component_slug,$slug,$lang,null,null,$order,$limit,$paginate,$pageNumber);
        if (isset($multiple->status)){
            $multiple = Connections::DataGetAll($component_info->uuid,$lang,null,null,$order,$limit,$paginate,$pageNumber);
            $view     = '/theme/route/'.$component_info->data_type.'/list/'.$component_info->view;
        }else{
            $view = '/theme/ladders/'.$multiple->component->view;
        }
        if (view()->exists($view)) {
            return view($view,compact('multiple','pageNumber','slug','component_slug'));
        }else{
            return Helpers::SystemMessageRobots(5);
        }

    }

    public function Par1($lang,$component_slug)
    {

        $category = null;
        $multiple = null;
        $single = null;
        $slug = null;
        $component_info = Connections::ComponentSlugSingle($component_slug,$lang);
        if (isset($component_info->status)){
            return Helpers::SystemMessageRobots(3);
        }

        if ($component_info->limit == 0){
            $paginate = $component_info->paginate;
            $limit = null;
            $page = 1;
        }else{
            $page = null;
            $paginate = null;
            $limit = $component_info->limit;
        }
        if (isset($component_info->status)){
            return Helpers::SystemMessageRobots(3);
        }else{
            if ($component_info->data_type == 'single'){

                $single = Connections::DataGetSingle('slug',$component_info->slug,$lang);
                $view = '/theme/route/'.$component_info->data_type.'/'.$component_info->view;
            }else{
                $where = [];


                $multiple = Connections::DataGetAll($component_info->uuid,$lang,$where,null,$component_info->order_by,$limit,$paginate,$page);
                $view     = '/theme/route/'.$component_info->data_type.'/list/'.$component_info->view;

            }
        }

        if (view()->exists($view)) {

            return view($view,array('single' => $single,'multiple' => $multiple,'component_info' => $component_info,'component_slug' => $component_slug,'slug'=> $slug));
        }else{
            return Helpers::SystemMessageRobots(1);
        }

    }

    public function Par2($lang,$component_slug,$slug)
    {

        $multiple = null;
        $single = null;
        $otherProduct = null;
        $contactSlug  = null;

        $component_info = Connections::ComponentSlugSingle($component_slug,App::currentLocale());
        if (isset($component_info->status)){
            return Helpers::SystemMessageRobots(3);
        }
        $order =$component_info->order_by;
        if ($component_info->limit == 0){
            $paginate = $component_info->paginate;
            $page = 1;
            $limit = null;
        }else{
            $paginate = null;
            $page = null;
            $limit = $component_info->limit;
        }
        if (isset($component_info->status))
        {
            return Helpers::SystemMessageRobots(3);
        }
        if ($slug == 'all'){
            $multiple = Connections::DataGetAll($component_info->uuid,$lang,null,null,$order,$limit,$paginate,$page);
            $view     = 'theme/route/multiple/list/'.$multiple->component->view;
        }else{


            $single       = Connections::DataGetSingle("slug",$slug,$lang);
            if (isset($single->status)){
                $multiple = Connections::LadderAndDatas($component_slug,$slug,$lang,null,null,$order,$limit,$paginate,$page);

                if (isset($multiple->status)){
                    return Helpers::SystemMessageRobots(7);
                }else{
                    $view     = 'theme/ladders/'.$multiple->component->view;
                }
            }else{
                $view     = 'theme/route/multiple/detail/'.$single->component->view;
                if ($single->component->uuid != $component_info->uuid)
                {
                    return Helpers::SystemMessageRobots(4);
                }
            }
        }

        if (view()->exists($view))
        {
            return view($view,compact('single','multiple','component_info','component_slug','slug'));
        }
        else{
            return Helpers::SystemMessageRobots(5);
        }
    }


    public function Search($lang,$tag,$page,Request $request)
    {

        $lang = $request->get('lang');
        $GeneralSettings = $request->get('CustomParameters');
        $tagNew = Helpers::CleanString($tag, 'tag');


        $tags [] = $tagNew;

        $colums  = $GeneralSettings->SearchColumns;


        foreach ($GeneralSettings->SearchComponents as $SearchComponent){
            foreach ($colums as $colum){
                $multiple[] = Connections::Search($SearchComponent, $tags, $colum, $lang, 'ASC', 999);
            }
        }



        $tag = urldecode($tag);
        if (isset($multiple->status)){
            return Helpers::SystemMessageRobots(2);
        }else{
            return view($GeneralSettings->SearchView,compact('multiple','page','tag'));
        }
    }


}
