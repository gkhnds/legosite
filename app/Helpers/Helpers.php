<?php

namespace App\Helpers;
use App;
use Spatie\Menu\Menu;
use Spatie\Menu\Link;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
class Helpers
{

    public static function  CategoriesConvertUuidtoArrayData($Categories,$lang)
    {

        foreach ($Categories as $category){
            $data[] = App\Models\Connections::LaddersUuidSingle($category,$lang);
        }
        return $data;
    }



    public static function  FileList($Files)
    {
        if (empty($Files)){
            return '';
        }else{
            $datas = explode(',',$Files);

            foreach ($datas as $key => $File){
                $xmw = explode('.',$File);
                $xma = explode('/',$xmw[0]);
                $count = count($xma);
                $datas[$key] = array('url' => Config::get('settings.SERVER_ADDRESS').$File,'type' =>  $xmw[1],'name' =>  $xma[$count - 1]);

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
            $options['addItemParentClass'] = 'sub-droupdown';
            $menu = Menu::new()->addItemParentClass($options['addItemParentClass'])->addParentClass($options['addParentClass']);
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

    public static function  ProductKeywords($keywords)
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


    public static function  SystemMessageRobots($key)
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


    public static function  ArraySearch($array, $search_list) {

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

    public static function  NavigationSelectActiveMenuCreator($datas,$options,$menuSlug,$headUuid = null){


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

    public static function  FooterNavigationSelectActiveMenuCreator($datas,$options,$menuSlug,$headUuid = null){


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

                    $menu->add(Link::to('/'.$options['lang'].$component.$url, '<i class="'.$icon.'"></i> ')->addClass('active'));
                }else{

                    $menu->add(Link::to('/'.$options['lang'].$component.$url, '<i class="'.$icon.'"></i> '));
                }





            }else{
                if (!empty($data->component_slug))
                {
                    $component  = '/'.$data->component_slug. '/';
                }else{
                    $component =  "";
                }
                $menu->add(Link::to('/'.$options['lang'].$component.$url, '<i class="'.$icon.'"></i> '));
            }
            if (isset($data->children)) {
                $menu->submenu(null,self::NavigationSelectActiveMenuCreator($data->children,$options,$menuSlug));
            }

        }


        return $menu;
    }

    public static function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    public static function setImageOrginal($prp,$options) {

        $mime = $prp['Mime'];
        $nameparam = null;
        if (isset($options['Mime'])){
            if (!empty($options['Mime'])){
                $mime = $options['Mime'];
            }
        }

        if (!empty($options['Resize'])) {
            $nameparam .= $options['Resize']['Width'] . 'x' . $options['Resize']['Height'];
        }
        if (!empty($options['Watermark'])) {
            $nameparam .= $options['Watermark']['Position']['X'] . '-' . $options['Watermark']['Position']['Y'];
        }
        if (Storage::disk('originalImages')->missing($prp['ImageName'].$nameparam.'.'.$mime)) {
            $img = Image::make($prp['RemoteImageUrl']);
            if (!empty($options['Resize'])){
                $img->fit($options['Resize']['Width'], $options['Resize']['Height'], function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if (!empty($options['Watermark'])){
                $img->insert($options['Watermark']['Image'],$options['Watermark']['Position']['Status'],$options['Watermark']['Position']['X'],$options['Watermark']['Position']['Y']);
            }
            $img->save('cache/original/'.$prp['ImageName'].$nameparam.'.'.$mime);
            return '/cache/original/'.$prp['ImageName'].$nameparam.'.'.$mime;
        }else{
            return '/cache/original/'.$prp['ImageName'].$nameparam.'.'.$mime;
        }
    }
    public static function setImageThumbnail($prp,$options) {

        $mime = $prp['Mime'];
        $nameparam = null;
        if (isset($options['Mime'])){

            if (!empty($options['Mime'])){
                $mime = $options['Mime'];
            }
        }
        if (!empty($options['Resize'])) {
            $nameparam .= $options['Resize']['Width'] . 'x' . $options['Resize']['Height'];
        }else{
            $nameparam .= Config::get('settings.FILE_CACHE_IMAGE_WIDTH') . 'x' . Config::get('settings.FILE_CACHE_IMAGE_HEIGHT');
        }

        if (!empty($options['Watermark'])) {
            $nameparam .= $options['Watermark']['Position']['X'] . '-' . $options['Watermark']['Position']['Y'];
        }

        if (Storage::disk('thumbsImages')->missing($prp['ImageName'].$nameparam.'.'.$mime)) {
            $img = Image::make($prp['RemoteImageUrl']);
            if (!empty($options['Resize'])){
                $img->fit($options['Resize']['Width'], $options['Resize']['Height'], function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{

                $img->fit(Config::get('settings.FILE_CACHE_IMAGE_WIDTH'), Config::get('settings.FILE_CACHE_IMAGE_HEIGHT'), function ($constraint) {
                    $constraint->upsize();
                });
            }
            if (!empty($options['Watermark'])){
                $img->insert($options['Watermark']['Image'],$options['Watermark']['Position']['Status'],$options['Watermark']['Position']['X'],$options['Watermark']['Position']['Y']);
            }
            $img->save('cache/thumbs/'.$prp['ImageName'].$nameparam.'.'.$mime);

            return '/cache/thumbs/'.$prp['ImageName'].$nameparam.'.'.$mime;
        }else{
            return '/cache/thumbs/'.$prp['ImageName'].$nameparam.'.'.$mime;
        }
    }



    public static function NoCacheImageTag($Images,$options,$tagOptions)
    {
        $Alt = null;
        $LazyMode = null;
        $Attributes = [];
        $Class= null;
        $Id= null;
        $prp = self::ImageFragmentation($Images);
        if ($options['ThumbsMode'] == false)
        {
            $Image = $prp['RemoteImageUrl'];
        }
        if($options['ThumbsMode'] == true)
        {
            $prp = self::ImageFragmentation(self::ThumbsImage($Images));
            $Image = $prp['RemoteImageUrl'];
        }
        if (isset($tagOptions['Alt'])){
            $Alt = $tagOptions['Alt'];
        }
        if (isset($tagOptions['LazyMode'])){
            $LazyMode = $tagOptions['LazyMode'];
        }
        if (isset($tagOptions['Attributes'])){
            $Attributes= $tagOptions['Attributes'];
        }
        if (isset($tagOptions['Class'])){
            $Class = $tagOptions['Class'];
        }
        if (isset($tagOptions['Id'])){
            $Class = $tagOptions['Id'];
        }
        return view('system/tools/helpers/img',compact('LazyMode','Image','Alt','Attributes','Class','Id'))->render();

    }

    public static function NoCacheImageLink($Images,$options = null)
    {
        if (empty($Images)){
            return '/lego/main/img/ImageNull.png';
        }
        if (empty($options)){
            $options['ThumbsMode'] = false;
        }else{
            if (!isset($options['ThumbsMode'])){
                if (empty($options['ThumbsMode'])){
                    return;
                }
                return;
            }
        }
        if ($options['ThumbsMode'] == true){
            $Image = explode(',',$Images)[0];
            $Image = self::ThumbsImage($Image);
        }else{
            $Image = explode(',',$Images)[0];
        }
        return Config::get('settings.SERVER_ADDRESS').$Image;
    }

    public static function CacheImageTag($Images,$options,$tagOptions)
    {

        if (Config::get('settings.FILE_CACHE') == false){
            return self::NoCacheImageTag($Images,$options,$tagOptions);
        }
        if (empty($Images)){
            return '/lego/main/img/ImageNull.png';
        }
        $Alt = null;
        $LazyMode = null;
        $Attributes = [];
        $Class= null;
        $Id= null;
        $prp = self::ImageFragmentation($Images);
        if ($options['ThumbsMode'] == true){
            $mode = "tumbs";
        }else{
            $mode = "original";
        }
        $hash = Config::get('settings.APP_UUID').'-Image-'.$mode;
        if (isset($options['Resize'])){
            $hash .= '-'.$options['Resize']['Width'].'-'.$options['Resize']['Height'];
        }else{
            $hash .= '-'.Config::get('settings.FILE_CACHE_IMAGE_WIDTH').'-'.Config::get('settings.FILE_CACHE_IMAGE_HEIGHT');

        }
        if (isset($options['Watermark'])){
            $hash .= '-'.$options['Watermark']['Position']['X'].'-'.$options['Watermark']['Position']['Y'];
        }
        $hash .= '-'.$prp['ImageName'].'-'.App::currentLocale();
        $Image =  Cache::tags('file')->rememberForever(Str::slug($hash) , function () use ($options,$prp,$Images) {
            if ($options['ThumbsMode'] == false)
            {
                $Image =  self::setImageOrginal($prp,$options);

            }
            if($options['ThumbsMode'] == true)
            {
                $prp = self::ImageFragmentation(self::ThumbsImage($Images));
                if(self::get_http_response_code(Config::get('settings.SERVER_ADDRESS').self::ThumbsImage($Images)) != "200"){
                    return '/lego/main/img/ImageNull.png';
                }
                $Image = self::setImageThumbnail($prp,$options);
            }
            return $Image;
        });



        if (isset($tagOptions['Alt'])){
            $Alt = $tagOptions['Alt'];
        }
        if (isset($tagOptions['LazyMode'])){
            $LazyMode = $tagOptions['LazyMode'];
        }
        if (isset($tagOptions['Attributes'])){
            $Attributes= $tagOptions['Attributes'];
        }
        if (isset($tagOptions['Class'])){
            $Class = $tagOptions['Class'];
        }
        if (isset($tagOptions['Id'])){
            $Class = $tagOptions['Id'];
        }
        return view('system/tools/helpers/img',compact('LazyMode','Image','Alt','Attributes','Class','Id'))->render();

    }

    public static function CacheImageLink($Images,$options = null)
    {

        if (Config::get('settings.FILE_CACHE') == false){
            return self::NoCacheImageLink($Images,$options = null);
        }
        if (empty($Images)){
            return '/lego/main/img/ImageNull.png';
        }
        if (empty($options)){
            $options['ThumbsMode'] = false;
        }else{
            if (!isset($options['ThumbsMode'])){
                if (empty($options['ThumbsMode'])){
                    return;
                }
                return;
            }
        }



        if ($options['ThumbsMode'] == true){
            $mode = "thumbs";
        }else{
            $mode = "original";
        }


        if ($options['ThumbsMode'] == false)
        {
            $prp = self::ImageFragmentation($Images);
            if(self::get_http_response_code($prp['RemoteImageUrl']) != "200"){
                return '/lego/main/img/ImageNull.png';
            }



            $hash = Config::get('settings.APP_UUID').'-Image-'.$mode;
            if (isset($options['Resize'])){
                $hash .= '-'.$options['Resize']['Width'].'-'.$options['Resize']['Height'];
            }else{
                $hash .= '-'.Config::get('settings.FILE_CACHE_IMAGE_WIDTH').'-'.Config::get('settings.FILE_CACHE_IMAGE_HEIGHT');

            }
            if (isset($options['Watermark'])){
                //  gokhan  $hash .= '-'.$options['Watermark']['X'].'-'.$options['Watermark']['Y'];
                $hash.= '-'.$options['Watermark']['Position']['X'] . '-' . $options['Watermark']['Position']['Y'];
            }
            $hash .= '-'.$prp['ImageName'].'-'.App::currentLocale();
            $Image =  Cache::tags('file')->rememberForever(Str::slug($hash), function () use ($options,$prp,$Images) {
                return  self::setImageOrginal($prp,$options);
            });
        }
        if($options['ThumbsMode'] == true)
        {

            $prp = self::ImageFragmentation(self::ThumbsImage($Images));
            if(self::get_http_response_code($prp['RemoteImageUrl']) != "200"){
                return '/lego/main/img/ImageNull.png';
            }

            $hash = Config::get('settings.APP_UUID').'-Image-'.$mode;
            if (isset($options['Resize'])){
                $hash .= '-'.$options['Resize']['Width'].'-'.$options['Resize']['Height'];
            }
            if (isset($options['Watermark'])){
                // gokhan 2  $hash .= '-'.$options['Watermark']['X'].'-'.$options['Watermark']['Y'];
                $hash.= '-'.$options['Watermark']['Position']['X'] . '-' . $options['Watermark']['Position']['Y'];
            }
            $hash .= '-'.$prp['ImageName'].'-'.App::currentLocale();
//enes
            $Image =  Cache::tags('file')->rememberForever(Str::slug($hash) , function () use ($options,$prp,$Images) {

                return self::setImageThumbnail($prp,$options);
            });

        }
        return $Image;
    }


    public static function NoCacheImageList($Images,$Options)
    {
        if (empty($Images)){
            return array('/lego/main/img/ImageNull.png');
        }else{
            $datas = explode(',',$Images);
            foreach ($datas as $key => $image){
                $datas[$key] = self::NoCacheImageLink($image,$Options);
            }
            return $datas;
        }

    }

    public static function CacheImageList($Images,$Options)
    {
        if (empty($Images)){
            return array('/lego/main/img/ImageNull.png');
        }else{
            $datas = explode(',',$Images);
            foreach ($datas as $key => $image){
                $datas[$key] = self::CacheImageLink($image,$Options);
            }
            return $datas;
        }

    }


    public static function ImageFragmentation($Images){
        $Image = explode(',',$Images)[0];
        $RemoteImage= explode('/',$Image);

        $Prck = explode('.',$RemoteImage[count($RemoteImage)-1]);
        return array(
            "RemoteImageUrl"=> Config::get('settings.SERVER_ADDRESS').$Image,
            "ImageName" => $Prck[0],
            "Mime" => $Prck[1],
        );
    }



    public static function ThumbsImage($image)
    {

        $arraySmash  = explode('/',$image);

        $arraySmash2 = explode(end($arraySmash),$image);

        return $arraySmash2[0].'thumbs/'.end($arraySmash);
    }


    public static function  GetVideoId($src,$secure="https")
    {
        if (!empty($src)){
            //https://vimeo.com/747792237   gökhan
            $urlPieces = explode('/', $src);

            if ( $urlPieces[2] == 'vimeo.com' )
            {

                $url = $urlPieces[3];
            }else{
                //https://www.youtube.com/watch?v=q19UZSj28fU
                $youtubePieces = explode('=', $src);
                $url = $youtubePieces[1];
            }

            return $url;
        }else{
            return $src;
        }

    }


    public static function  GetVideoThumbnail($src)
    {
        //hata

        $urlPieces = explode('/', $src);
        //enes
        if ( $urlPieces[2] == 'vimeo.com' )
        {
            $id        = $urlPieces[3];
            if(self::get_http_response_code('https://vimeo.com/api/v2/video/' . $id . '.php') != "200"){
                return '/lego/main/img/ImageNull.png';
            }
            $cachehash = Config::get('settings.APP_UUID').$id."-Vimeo";
            $thumbnail =  Cache::tags('file')->rememberForever(Str::slug($cachehash), function () use ($id) {
                $hash      = unserialize(file_get_contents('https://vimeo.com/api/v2/video/' . $id . '.php'));
                $thumbnail = $hash[0]['thumbnail_large'];
                return $thumbnail;
            });

            $thumbnail = str_replace('http:','https:',$thumbnail);
            return $thumbnail;

        }
        elseif ( $urlPieces[2] == 'www.youtube.com' )
        { // If Youtube
            $extractId  = explode('v=', $urlPieces[3]);
            $id         = $extractId[1];
            $cachehash = Config::get('settings.APP_UUID').$id."Youtube";
            $thumbnail =  Cache::tags('file')->rememberForever(Str::slug($cachehash), function () use ($id) {
                $thumbnail  = 'https://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
                return $thumbnail;
            });
            return $thumbnail;
        }
    }

    public static function  GetVideoPlayerLinkChange($src)
    {
        if (!empty($src)){

            $urlPieces = explode('/', $src);

            if ( $urlPieces[2] == 'vimeo.com' )
            {

                $url = "https://player.".$urlPieces[2]."/video/".$urlPieces[3];
            }else{

                $youtube = explode('=', $src);
                $url = "https://youtube.com/embed/".$youtube[1];
            }

            return $url;
        }else{
            return $src;
        }

    }

    public static function  GetApiUpdatePageUrl($ApiUrl,$ComponentSlug,$pageSlugDynamic = null)
    {
        if (empty($ApiUrl))
        {
            return '#';
        }

        $lang         = config('app.locale');
        $ApiUrl       = explode('page=',$ApiUrl);
        return '/'.$lang.'/'.$ComponentSlug.'/'.$pageSlugDynamic.'/'.$ApiUrl[1];


    }

    public static function  PriceNormalized($price)
    {
        $vowels = array(",");
        $price = str_replace($vowels,"",$price);
        return $price;
    }
    public  static function MoneyNormalized($price){
        return number_format((float)$price, 2, ',', '.');
    }

    public static function  KdvDahil($fiyat,$kdv,$adet)
    {

       
        $vowels = array(",");
        $fiyat = str_replace($vowels,"",$fiyat);
        $kdvTutar = (float)((($fiyat * $adet) * $kdv) / 100);
        $kdvdahil =  (float)(($fiyat * $adet) + $kdvTutar);
        return $kdvdahil;
    }


    public static function  KdvHaric($fiyat,$adet)
    {
        $vowels = array(",");
        $fiyat = str_replace($vowels,"",$fiyat);
        $kdvHaric =  (float)($fiyat * $adet);
        return $kdvHaric;
    }


    public static function  XssClean($data)
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


    public static function  CleanString($string,$type){

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

    public static function  KdvTutar($fiyat,$kdv,$adet)
    {
        $vowels = array(",");
        $fiyat = str_replace($vowels,"",$fiyat);

        $kdvTutar = (float)((($fiyat * $adet) * $kdv) / 100);
        return $kdvTutar;
    }

    public static function  CompressImage($source_path, $quality)
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
    public static function  StoragePutTmpFile2($image)
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

    public static function  StoragePutTmpFile($storageDirName, $tmp_file)
    {
        $file_path = Storage::disk('local')->putFile($storageDirName, new File($tmp_file));

        return $file_path;
    }

    public static function  DeleteStorageFile($file_path)
    {
        return Storage::delete($file_path);
    }


    public static function  LanguageSlugDatas($slug)
    {
        $singleDataSlug = App\Models\Connections::GetLangsSingleDatas($slug);
        return $singleDataSlug;

    }

    public static function  ComponentSlugDatas($uuid)
    {
        $componentSlug = App\Models\Connections::ComponentsSingleUuid($uuid);
        if(!empty($componentSlug->slug))
        {
            $result = json_decode($componentSlug->slug,true);
            return $result;
        }
        else{
            return '';
        }


    }

}

