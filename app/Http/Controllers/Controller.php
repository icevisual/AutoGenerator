<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    public function __construct(){
        
        $SidebarMenu = $this->getSidebarMenu(\Request::getPathInfo());
        
        \View::share('SidebarMenu',$SidebarMenu);
        
    }
    
    public function invokeRoute($routeName){
        $routeAll = \Route::getRoutes();
        $route = $routeAll->getByName($routeName);
        if(!$route){
            return false;
        }
        $action = $route->getAction();
        $uses = explode('@', $action['uses']);
        $response = (new $uses[0])->$uses[1]();
        if($response instanceof  \Illuminate\Http\JsonResponse ){
            return $data = $response->getData(true);
        }
        return false;
    }
    
    public function renderTemplate($data){
        return view('backend.templates.Common', $data);
    }
    
    
    
    public function getSidebarMenu($pathname){
        // DB staticize
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
                                'href' => route('table_create'),
                                'icon' => 'fa-circle-o',
                                'title' => 'TABLE CREATE'
                            ],
                            [
                                'href' => route('web_page_design'),
                                'icon' => 'fa-circle-o',
                                'title' => 'Page Design'
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
        return $data;
    }
    
    
    
    public static function setHeaders()
    {
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Methods'] = 'GET, PUT, POST, DELETE, HEAD, OPTIONS';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With, Origin, X-Csrftoken, Content-Type, Accept';
    
        if ($header) {
            foreach ($header as $head => $value) {
                header("{$head}: {$value}");
            }
        }
    }
    
    public static function setHeader()
    {
        static $_setted = false;
        if (! $_setted) {
            if (! \App::environment('testing')) {
                self::setHeaders();
                $_setted = true;
            }
            $_setted = true;
        }
    }
    
    /**
     *
     * @param number $code
     * @param string $msg
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function __json()
    {
        return call_user_func_array([
            \JsonReturn::class,
            'json'
        ], func_get_args());
    }
    
    /**
     *
     * @param number $code
     * @param string $msg
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function __jsonp()
    {
        return call_user_func_array([
            \JsonReturn::class,
            'jsonp'
        ], func_get_args());
    }
    
    protected $_customValidateConfig = [];
    
    public function getValidateCondition($type, $params = [])
    {
        $config = $this->_customValidateConfig;
        // create 去掉 ID
        // update 加上 ID exists，unique 加上 ID 排除，需传入 ID
        switch ($type) {
            case 'create':
                unset($config['rules']['id']);
                break;
            case 'update':
                foreach ($config['rules'] as $k => $v) {
                    if (strpos($v, 'unique:') !== false) {
                        foreach (explode('|', $v) as $v1) {
                            if (strpos($v1, 'unique:') === 0) {
                                $config['rules'][$k] = str_replace($v1, $v1 . ',' . $params['id'] . ',id', $config['rules'][$k]);
                                break 2;
                            }
                        }
                    }
                }
                break;
            default:
                ;
        }
        return $config;
    }
    
    
    
    
}
