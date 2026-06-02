<?php

namespace App\Helpers;

use Connections;
use Spatie\Menu\Menu;
use Spatie\Menu\Link;

// use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
class SystemHelper
{

    public static function CategoriesConvertUuidtoArrayData($Categories,$lang)
    {
        $Connections = new Connections();
        foreach ($Categories as $category){
            $data[] = $Connections->LaddersUuidSingle($category,$lang);
        }
        return $data;
    }

    public static function ImageList($Images)
    {
        if (empty($Images)){
            return array('/public/assets/images/ImageNotFound.jpg');
        }else{
            $datas = explode(',',$Images);
            foreach ($datas as $key => $image){
                $datas[$key] = config('settings.SERVER_ADDRESS').$image;
            }
            // Response Data Key Forach[url]
            return $datas;
        }

    }

    public static function FileList($Files)
    {
        if (empty($Files)){
            return '';
        }else{
            $datas = explode(',',$Files);

            foreach ($datas as $key => $File){
                $xmw = explode('.',$File);
                $xma = explode('/',$xmw[0]);
                $count = count($xma);
                $datas[$key] = array('url' => config('settings.SERVER_ADDRESS').$File,'type' =>  $xmw[1],'name' =>  $xma[$count - 1]);

            }
            // Response Data Key [url,type,name]
            return json_decode(json_encode($datas));
        }

    }




    public static function NavigationMenuCreator($datas,$options,$restart = 0){

        if ($restart == 0){
            $menu = Menu::new()->addItemParentClass($options['addItemParentClass'])
                ->addItemClass($options['addItemClass'])->addParentClass($options['addParentClass'])->addClass($options['addClass']);
            $restart++;
        }else{

            $menu = Menu::new()->addItemParentClass($options['addItemParentClass'])
                ->addItemClass($options['addItemClass'])->addParentClass($options['addParentClass']);
        }

        foreach ($datas as $Index => $data){
            $icon = null;
            if (!empty($data->icon)){
                $icon = $data->icon;
            }else{
                $icon = null;
            }

            if (isset($data->children)) {
                $url = '#';
                if (!empty($data->slug)){
                    $url = '/'.$options['lang'].'/'.$data->slug;
                }

                $menu->submenu(Link::to($url, '<i class="'.$icon.'"></i> '.$data->name),self::NavigationMenuCreator($data->children,$options,$restart));
            }else{

                if ($data->type == 'component') {

                    $url = '/'.$options['lang'].'/'.$data->component_slug.'/'.$data->slug;
                    $menu->add(Link::to($url, '<i class="'.$icon.'"></i> '.$data->name));
                }else{
                    if(!empty($data->link)){
                        $url = $data->link;
                    }else{
                        if(empty($data->slug)){
                            $url = '/' . $options['lang'];
                        }else {
                            $url = '/'.$options['lang'].'/'.$data->slug;
                        }

                    }

                    $menu->add(Link::to($url, '<i class="'.$icon.'"></i> '.$data->name));
                }
            }


        }
        return $menu;
    }

    public static function ProductKeywords($keywords)
    {

        $datas = explode(',',$keywords);
        foreach ($datas as $key => $keyword){
            $datas[$key] = $keyword;
        }
        return $datas;
    }
    public static function NavigationCategoriesCreator($datas,$component_slug,$options,$restart = 0,$active){

        if ($restart == 0){

            $menu = Menu::new()->addItemParentClass($options['addItemParentClass'])
                ->addItemClass($options['addItemClass'])->addParentClass($options['addParentClass'])->addClass($options['addClass']);
            $restart++;
        }else{
            $menu = Menu::new()->addItemParentClass($options['addItemParentClass'])
                ->addItemClass($options['addItemClass'])->addParentClass($options['addParentClass']);
        }

        foreach ($datas as $Index => $data){
            $icon = null;

            if (isset($data->children)) {
                if (isset($data->slug)){
                    $url = '/'.$options['lang'].'/'.$component_slug.'/'.$data->slug;
                }else{
                    $url = $data->url;
                }
                $menu->submenu(Link::to($url, '<i class="'.$icon.'"></i> '.$data->name),self::NavigationCategoriesCreator($data->children,$component_slug,$options,$restart,$active));
            }else{
                if (isset($data->slug)){
                    $url = '/'.$options['lang'].'/'.$component_slug.'/'.$data->slug;
                }else{
                    $url = $data->url;
                }
                if ($active == $data->name){
                    $menu->add(Link::to($url, '<i class="'.$icon.'"></i> '.$data->name)->addClass('current'));
                }else{
                    $menu->add(Link::to($url, '<i class="'.$icon.'"></i> '.$data->name));
                }
            }
        }
        return $menu;
    }


    public static function SystemMessageRobots($key)
    {
        if (config('settings.DEVELOPER_MODE') == true){

            $message = __('system.'.$key);
            $html = view('system/debug/error',compact("message"))->render();
            return $html;
        }else{
            $lang = config('app.locale');
            return redirect($lang.'/404');
        }
    }


    public static function ArraySearch($array, $search_list) {

        // Create the result array
        $result = [];

        // Iterate over each array element
        foreach ($array as $key => $value) {

            // Iterate over each search condition
            foreach ($search_list as $k => $v) {

                // If the array element does not meet
                // the search condition then continue
                // to the next element
                if (!isset($value[$k]) || $value[$k] != $v)
                {

                    // Skip two loops
                    continue 2;
                }
            }

            // Append array element's key to the
            //result array
            $result[] = $value;
        }

        // Return result
        return $result;
    }

    public static function NavigationSelectActiveMenuCreator($datas,$options,$menuSlug,$headUuid = null){


        $menu = Menu::new()->addItemParentClass($options['addItemParentClass'])
            ->addItemClass($options['addItemClass'])->addParentClass($options['addParentClass'])->addClass($options['addClass']);

        //$menu->add(Link::to('asd', '<i class="'.$icon.'"></i> '.$data->name)->addClass('current'));
        foreach ($datas as $Index => $data){
            $icon = null;
            if (!empty($data->icon)){
                $icon = $data->icon;
            }else{
                $icon = null;
            }

            $res = self::ArraySearch(json_decode(json_encode($datas),true),array('slug'=> $menuSlug));

            $url = null;
            if (!empty($data->link)){
                $url = '/'.$data->link;
            }else{
                if (!empty($data->slug))
                    $url = '/'.$data->slug;
            }
            if (!empty($res)){
                if (!empty($data->component_slug))
                {
                    $component  = '/'.$data->component_slug. '/';
                }else{
                    $component =  "";
                }

                if ($menuSlug == $data->slug){

                    $menu->add(Link::to('/'.$options['lang'].$component.$url, '<i class="'.$icon.'"></i> '.$data->name)->addClass('active'));
                }else{

                    $menu->add(Link::to('/'.$options['lang'].$component.$url, '<i class="'.$icon.'"></i> '.$data->name));
                }




            }else{
                if (!empty($data->component_slug))
                {
                    $component  = '/'.$data->component_slug. '/';
                }else{
                    $component =  "";
                }
                $menu->add(Link::to('/'.$options['lang'].$component.$url, '<i class="'.$icon.'"></i> '.$data->name));

            }
            if (isset($data->children)) {
                $menu->submenu(null,self::NavigationSelectActiveMenuCreator($data->children,$options,$menuSlug));
            }

        }

        return $menu;
    }




    public static function ThumbsImage($image)
    {
        $arraySmash  = explode('/',$image);
        $arraySmash2 = explode(end($arraySmash),$image);

        return $arraySmash2[0].'thumbs/'.end($arraySmash);
    }

    public static function GetVideoThumbnail($src)
    {
        $urlPieces = explode('/', $src);

        if ( $urlPieces[2] == 'vimeo.com' )
        {
            $id        = $urlPieces[3];
            $hash      = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $id . '.php'));
            $thumbnail = $hash[0]['thumbnail_large'];
        }
        elseif ( $urlPieces[2] == 'www.youtube.com' )
        { // If Youtube
            $extractId  = explode('v=', $urlPieces[3]);
            $id         = $extractId[1];
            $thumbnail  = 'http://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
        }
        return $thumbnail;
    }

    public static function GetVideoPlayerLinkChange($src,$secure="https")
    {
        if (!empty($src)){

            $urlPieces = explode('/', $src);

            if ( $urlPieces[2] == 'vimeo.com' )
            {

                $url = $secure."://player.".$urlPieces[2]."/video/".$urlPieces[3];
            }else{
                $url = $src;
            }

            return $url;
        }else{
            return $src;
        }

    }

    public static function GetApiUpdatePageUrl($ApiUrl,$ComponentSlug,$pageSlugDynamic = null)
    {
        if (empty($ApiUrl))
        {
            return '#';
        }

        $lang         = config('app.locale');
        $ApiUrl       = explode('page=',$ApiUrl);
        return '/'.$lang.'/'.$ComponentSlug.'/'.$pageSlugDynamic.'/'.$ApiUrl[1];

    }

    public static function PriceNormalized($price)
    {
        $vowels = array(",");
        $price = str_replace($vowels,"",$price);
        return $price;
    }
    public  static function MoneyNormalized($price){
        return number_format((float)$price, 2, ',', '.');
    }

    public static function KdvDahil($fiyat,$kdv,$adet)
    {
        $vowels = array(",");
        $fiyat = str_replace($vowels,"",$fiyat);
        $kdvTutar = (float)((($fiyat * $adet) * $kdv) / 100);
        $kdvdahil =  (float)(($fiyat * $adet) + $kdvTutar);
        return $kdvdahil;
    }


    public static function KdvHaric($fiyat,$adet)
    {
        $vowels = array(",");
        $fiyat = str_replace($vowels,"",$fiyat);
        $kdvHaric =  (float)($fiyat * $adet);
        return $kdvHaric;
    }


    public static function XssClean($data)
    {
// Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

// we are done...
        return $data;
    }


    public static function CleanString($string,$type){

        // Strip HTML Tags
        $clear =  self::XssClean($string);
        // Clean up things like &amp;
        $clear = html_entity_decode($clear);
        // Strip out any url-encoded stuff
        $clear = urldecode($clear);
        // Replace non-AlNum characters with space
        //$clear = preg_replace('/[^A-Za-z0-9]/', ' ', $clear);
        // Replace non-AlNum characters with space
        if ($type == 'tag'){
            $clear = str_replace(' ', '', $clear);
        }
        // Trim the string of leading/trailing space
        $clear = trim($clear);

        return $clear;
    }
    public static function KdvTutar($fiyat,$kdv,$adet)
    {
        $vowels = array(",");
        $fiyat = str_replace($vowels,"",$fiyat);

        $kdvTutar = (float)((($fiyat * $adet) * $kdv) / 100);
        return $kdvTutar;
    }

    public static function CompressImage($source_path, $quality)
    {
        $info = getimagesize($source_path);
        $destination_path = 'tmp/tmp.jpg';

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_path);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_path);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_path);

        imagejpeg($image, $destination_path, $quality);

        return $destination_path;
    }
    public static function StoragePutTmpFile2($image)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $url = $image;
        $contents = file_get_contents($url,false, stream_context_create($arrContextOptions));
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::put($name, $contents);
        return 1;
    }

    public static function StoragePutTmpFile($storageDirName, $tmp_file)
    {
        $file_path = Storage::disk('local')->putFile($storageDirName, new File($tmp_file));

        return $file_path;
    }

    public static function DeleteStorageFile($file_path)
    {
        return Storage::delete($file_path);
    }




}

