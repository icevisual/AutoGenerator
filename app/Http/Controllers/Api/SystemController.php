<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;

class SystemController extends Controller
{

    public function formConfig()
    {
        $pathname = \Input::get('pathname');
        $file = 'jsonf/' . str_replace('/', '-', trim($pathname, '/')) . '.js';
        if (file_exists(public_path($file))) {
            $json = file_get_contents($file);
            $json = json_decode($json,1);
            // 
            foreach ($json as $k => $v){
                if (isset($v['type'])) {
                    if($v['type'] == 'table'){
                        $queryUri = array_get($v, 'attrs.uris.query.url');
                        $ret = curl_get( 'http://'.\Request::getHost().'/'.$queryUri);
                        array_set($json[$k], 'data', $ret['data']);
                    }
                }
            }
            
            return $this->__json($json);
        }
        return $this->__json(\ErrorCode::SYSTEM_ERROR);
    }

    /**
     *
     * 获取左侧菜单
     */
    public function sidebarMenu()
    {
        $data = [
            [
                'group' => 'MAIN NAVIGATION',
                'menus' => [
                    [
                        'icon' => 'fa-dashboard',
                        'title' => 'System',
                        'submenus' => [
                            [
                                'href' => route('query_tables'),
                                'icon' => 'fa-circle-o',
                                'title' => 'QUERY TABLES'
                            ],
                            [
                                'href' => route('table_deploy'),
                                'icon' => 'fa-circle-o',
                                'title' => 'TABLE DEPLOY'
                            ]
                        ]
                    ],
                    [
                        'icon' => 'fa-files-o',
                        'title' => 'Layout Options',
                        'submenus' => [
                            [
                                'href' => route('attrs_list'),
                                'icon' => 'fa-circle-o',
                                'title' => 'ATTRS LIST'
                            ],
                            [
                                'href' => route('attrs_create'),
                                'icon' => 'fa-circle-o',
                                'title' => 'ATTRS CREATE'
                            ],
                            [
                                'href' => route('components_query'),
                                'icon' => 'fa-circle-o',
                                'title' => 'COMPONENTS LIST'
                            ],
                            [
                                'href' => route('component_create'),
                                'icon' => 'fa-circle-o',
                                'title' => 'COMPONENTS CREATE'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        $pathname = \Input::get('pathname');
        
        $pathname = preg_replace('/\/\d+/', '', $pathname);
        
        foreach ($data as $k => $v) {
            // Group
            foreach ($v['menus'] as $k1 => $v1) {
                // menu
                foreach ($v1['submenus'] as $k2 => $v2) {
                    // submenus
                    $parse_url = parse_url($v2['href']);
                    if ($parse_url['path'] == $pathname) {
                        $data[$k]['menus'][$k1]['submenus'][$k2]['active'] = true;
                        $data[$k]['menus'][$k1]['active'] = true;
                        break 3;
                    }
                }
            }
        }
        
        return $this->__json($data);
    }

    
}


