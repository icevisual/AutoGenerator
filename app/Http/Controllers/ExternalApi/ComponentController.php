<?php
namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;
use App\Models\Form\Component;
use App\Models\Form\ComponentAttrs;
use App\Models\Form\Form;

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
    public function components_list(){
//         $page = \In put::get('p', 1); // 页数
//         $pageSize = \In put::get('n', 10); // 每页条数
        $data = Component::queryComponentsWithDetail([],1,10000);
        return $this->__json($data['list']);
    }
    
    /*
     * 表单列表
     */
    public function query_forms(){
        $data = Form::queryForms([],1,10000);
        return $this->__json($data['list']);
    }
    
    /*
     * 表单详情
     */
    public function forms_detail(){
        
        $id = \Input::get('id'); // id
        
        $ret = Form::formDetail($id);
        
        return $this->__json($ret);
    }
    
    
    /**
     * 保存表单控件
     */
    public function save_form(){
        $data = [
            'name' => \Input::get('name'),
            'components' => \Input::get('components') //{"components":[{"id":"12","attrs":[{"attrId":"132","defaultValue":"ad"},{"attrId":"123","defaultValue":""}]}]}
        ];
        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'name' => 'required|unique:form',
                'components' => 'required|array',
                'components.*.id' => 'required|numeric',
                'components.*.attrs' => 'required|array',
                'components.*.attrs.*.attrId' => 'required|numeric',
//                 'compoents.*.attrs.*.defaultValue' => 'required',
            ], // 条件
            'attributes' => [
                'name' => '表单名字',
                'components' => '组件',
                'components.*.id' => '组件ID',
                'components.*.attrs' => '组件属性',
                'components.*.attrs.*.attrId' => '组件属性ID',
                'components.*.attrs.*.defaultValue' => '组件属性值',
            ]
        ]); // 属性名映射
        $form = Form::createForm($data['name'],$data['components']);
        return $this->__json();
        return $this->__json($form->toArray());
    }
    
}


