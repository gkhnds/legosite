<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;
use Helpers;
use Connections;
use App;

class Modules extends Component
{
    public $view;
    public $position;
    public $uuid;

    public function __construct($view, $position, $uuid = null, Request $request)
    {

        $this->view = $view;
        $this->uuid = $uuid;
        $this->request = $request;
        $this->position = $position;
    }

    public function render()
    {
        $all = null;
        $extra = null;
        $master = $this->request->get('masters');
        $modules = $master->moduller->data;
        $convertJson = json_encode($modules);
        $arrayModules = json_decode($convertJson, true);
        

        if (count($arrayModules) > 0) {
            foreach ($arrayModules as $key => $moduleData) {
                if ($moduleData['dynamic']['durum'] == 'Aktif') {
                    if ($moduleData['static']['uuid'] == $this->uuid){
                        if ($this->position == $moduleData['dynamic']['tipi']) {
                            if (isset($moduleData['dynamic']['bilesenuuid']['value'])) {
                                if (!empty($moduleData['dynamic']['bilesenuuid']['value'])) {
                                    if (in_array($this->view, $moduleData['dynamic'])) {
                                        $datas = Connections::DataGetAll($moduleData['dynamic']['bilesenuuid']['value'], App::currentLocale(), null, null, 'ASC', $moduleData['dynamic']['limit']);

                                        if (isset($datas->component)) {
                                            if ($datas->component->data_type == 'single') {
                                                $datas->data = $datas->data[0];
                                            }
                                        } else {
                                            if (Config::get('settings.DEVELOPER_MODE') == true) {

                                                return $moduleData['dynamic']['baslik'] . ' ' . Helpers::SystemMessageRobots(10);
                                            }

                                        }
                                        /* send as object to view */
                                        $convertObjectModule = json_decode(json_encode($moduleData), FALSE);
                                        $module = $convertObjectModule->dynamic;
                                        if (view()->exists('theme.modules.' . $this->view)) {
                                            $all .= view('theme.modules.' . $this->view, compact('datas', 'module', 'extra'))->render();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
        return $all;
    }
}
