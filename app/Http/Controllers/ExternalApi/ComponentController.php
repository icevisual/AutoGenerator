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
     * @apiSuccess {String} componentName 控件名称
     * @apiSuccess {String} componentDesc 控件描述
     * @apiSuccess {Integer} attrId 属性ID
     * @apiSuccess {String} attrName 属性名称
     * @apiSuccess {String} defaultValue 属性值
     * @apiSuccess {String} attrType 属性数据类型
     * @apiSuccess {String} formType 渲染类型
     */
    public function outer_api_components_list(){
//         $page = \In put::get('p', 1); // 页数
//         $pageSize = \In put::get('n', 10); // 每页条数
        
        $data = Component::queryComponentsWithDetail([],1,10000);
        
        return $this->__json($data['list']);
    }
    
}


