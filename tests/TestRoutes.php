<?php 

use App\Services\Open\OpenServices;

class TestRoutes extends TestCase
{
        
    /**
     * sidebarMenu
     *
     * 
     */
    public function api_sidebar($params = [])
    {
        $data = [

        ];
        $ret = $this->postRetJson(route('api_sidebar'), $data)->toJson();
        return $ret;
    }
        
    /**
     * formConfig
     *
     * 
     */
    public function api_formConfig($params = [])
    {
        $data = [

        ];
        $ret = $this->postRetJson(route('api_formConfig'), $data)->toJson();
        return $ret;
    }

}
