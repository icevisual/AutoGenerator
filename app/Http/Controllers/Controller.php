<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
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
