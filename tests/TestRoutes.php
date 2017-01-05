<?php 

use App\Services\Open\OpenServices;

class TestRoutes extends TestCase
{
        
    /**
     * 获取左侧菜单
     *
     * @param array $params
     *            <pre>
     *            'pathname' => '', //String unknown
     *            </pre>
     */
    public function api_sidebar($params = [])
    {
        $data = [
            'pathname' => array_get($params,'pathname',''),// unknown String
        ];
        $ret = $this->getJson(route('api_sidebar'), $data)->toJson();
        return $ret;
    }
        
    /**
     * formConfig
     *
     * @param array $params
     *            <pre>
     *            'pathname' => '', //String unknown
     *            </pre>
     */
    public function api_formConfig($params = [])
    {
        $data = [
            'pathname' => array_get($params,'pathname',''),// unknown String
        ];
        $ret = $this->getJson(route('api_formConfig'), $data)->toJson();
        return $ret;
    }
        
    /**
     * create
     *
     * @param array $params
     *            <pre>
     *            'attr_name' => '', //String 属性名称
     *            'attr_name_cn' => '', //String 显示中文名
     *            'attr_type' => '', //String 属性数据类型
     *            'form_type' => '', //String unknown
     *            </pre>
     */
    public function api_attrs_create($params = [])
    {
        $data = [
            'attr_name' => array_get($params,'attr_name',''),// 属性名称 String
            'attr_name_cn' => array_get($params,'attr_name_cn',''),// 显示中文名 String
            'attr_type' => array_get($params,'attr_type',''),// 属性数据类型 String
            'form_type' => array_get($params,'form_type',''),// unknown String
        ];
        $ret = $this->postJson(route('api_attrs_create'), $data)->toJson();
        return $ret;
    }
        
    /**
     * query
     *
     * @param array $params
     *            <pre>
     *            'p' => '', //String 页数
     *            'n' => '', //String 每页条数
     *            </pre>
     */
    public function api_attrs_list($params = [])
    {
        $data = [
            'p' => array_get($params,'p',''),// 页数 String
            'n' => array_get($params,'n',''),// 每页条数 String
        ];
        $ret = $this->getJson(route('api_attrs_list'), $data)->toJson();
        return $ret;
    }
        
    /**
     * detail
     *
     * 
     */
    public function api_attrs_detail($params = [])
    {
        $data = [

        ];
        $ret = $this->getJson(route('api_attrs_detail'), $data)->toJson();
        return $ret;
    }
        
    /**
     * update
     *
     * @param array $params
     *            <pre>
     *            'attr_name' => '', //String 属性名称
     *            'attr_name_cn' => '', //String 显示中文名
     *            'attr_type' => '', //String 属性数据类型
     *            'form_type' => '', //String unknown
     *            </pre>
     */
    public function api_attrs_update($params = [])
    {
        $data = [
            'attr_name' => array_get($params,'attr_name',''),// 属性名称 String
            'attr_name_cn' => array_get($params,'attr_name_cn',''),// 显示中文名 String
            'attr_type' => array_get($params,'attr_type',''),// 属性数据类型 String
            'form_type' => array_get($params,'form_type',''),// unknown String
        ];
        $ret = $this->putJson(route('api_attrs_update'), $data)->toJson();
        return $ret;
    }
        
    /**
     * delete
     *
     * 
     */
    public function api_attrs_delete($params = [])
    {
        $data = [

        ];
        $ret = $this->deleteJson(route('api_attrs_delete'), $data)->toJson();
        return $ret;
    }
        
    /**
     * create
     *
     * @param array $params
     *            <pre>
     *            'component_name' => '', //String 控件名称
     *            'component_desc' => '', //String 控件描述
     *            'attrs' => '', //String 属性数据类型
     *            </pre>
     */
    public function api_component_create($params = [])
    {
        $data = [
            'component_name' => array_get($params,'component_name',''),// 控件名称 String
            'component_desc' => array_get($params,'component_desc',''),// 控件描述 String
            'attrs' => array_get($params,'attrs',''),// 属性数据类型 String
        ];
        $ret = $this->postJson(route('api_component_create'), $data)->toJson();
        return $ret;
    }
        
    /**
     * query
     *
     * @param array $params
     *            <pre>
     *            'p' => '', //String 页数
     *            'n' => '', //String 每页条数
     *            </pre>
     */
    public function api_components_query($params = [])
    {
        $data = [
            'p' => array_get($params,'p',''),// 页数 String
            'n' => array_get($params,'n',''),// 每页条数 String
        ];
        $ret = $this->getJson(route('api_components_query'), $data)->toJson();
        return $ret;
    }
        
    /**
     * detail
     *
     * 
     */
    public function api_component_detail($params = [])
    {
        $data = [

        ];
        $ret = $this->getJson(route('api_component_detail'), $data)->toJson();
        return $ret;
    }
        
    /**
     * update
     *
     * @param array $params
     *            <pre>
     *            'component_name' => '', //String 组件名称
     *            'component_desc' => '', //String 组件描述
     *            'attrs' => '', //String 属性数据类型
     *            </pre>
     */
    public function api_component_update($params = [])
    {
        $data = [
            'component_name' => array_get($params,'component_name',''),// 组件名称 String
            'component_desc' => array_get($params,'component_desc',''),// 组件描述 String
            'attrs' => array_get($params,'attrs',''),// 属性数据类型 String
        ];
        $ret = $this->putJson(route('api_component_update'), $data)->toJson();
        return $ret;
    }
        
    /**
     * delete
     *
     * 
     */
    public function api_component_delete($params = [])
    {
        $data = [

        ];
        $ret = $this->deleteJson(route('api_component_delete'), $data)->toJson();
        return $ret;
    }
        
    /**
     * 获取控件列表以及控件属性
     *
     * 
     */
    public function outer_api_components_list($params = [])
    {
        $data = [

        ];
        $ret = $this->getJson(route('outer_api_components_list'), $data)->toJson();
        return $ret;
    }
        
    /**
     * 保存表单控件
     *
     * @param array $params
     *            <pre>
     *            'name' => '', //String unknown
     *            'components' => '', //String {"components":[{"id":"12","attrs":[{"attrId":"132","defaultValue":"ad"},{"attrId":"123","defaultValue":""}]}]}
     *            </pre>
     */
    public function outer_api_save_form_component($params = [])
    {
        $data = [
            'name' => array_get($params,'name',''),// unknown String
            'components' => array_get($params,'components',''),// {"components":[{"id":"12","attrs":[{"attrId":"132","defaultValue":"ad"},{"attrId":"123","defaultValue":""}]}]} String
        ];
        $ret = $this->postJson(route('outer_api_save_form_component'), $data)->toJson();
        return $ret;
    }
        
    /**
     * query_forms
     *
     * 
     */
    public function outer_api_query_forms($params = [])
    {
        $data = [

        ];
        $ret = $this->postJson(route('outer_api_query_forms'), $data)->toJson();
        return $ret;
    }
        
    /**
     * forms_detail
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String 属性名称-中文
     *            </pre>
     */
    public function outer_api_forms_detail($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// 属性名称-中文 String
        ];
        $ret = $this->postJson(route('outer_api_forms_detail'), $data)->toJson();
        return $ret;
    }

}
