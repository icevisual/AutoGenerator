<?php
namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;
use App\Models\Form\Component;
use App\Models\Form\ComponentAttrs;

class ComponentController extends Controller
{


    /**
     * 获取控件列表以及控件属性
     * 
     * @apiSuccess {String} component_name 控件名称
     * @apiSuccess {String} component_desc 控件描述
     * @apiSuccess {Integer} attr_id 属性ID
     * @apiSuccess {String} attr_name_cn 属性中文名称
     * @apiSuccess {String} attr_name_en 属性英文名称
     * @apiSuccess {String} attr_type 属性数据类型
     * @apiSuccess {String} default_value 属性默认值
     */
    public function outer_api_components_list(){
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10); // 每页条数
        
        $data = Component::queryComponentsWithDetail([],$page,$pageSize);
        
        return $this->__json($data);
        
    }
    
}


