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
        $ret = $this->getJson(route('api_sidebar').'?'.http_build_query($data))->toJson();
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
        $ret = $this->getJson(route('api_formConfig').'?'.http_build_query($data))->toJson();
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
        $ret = $this->postJson(route('api_attrs_create'),$data)->toJson();
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
        $ret = $this->getJson(route('api_attrs_list').'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * detail
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_attrs_detail($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->getJson(route('api_attrs_detail',array_only($data,['id'])).'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * update
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            'attr_name' => '', //String 属性名称
     *            'attr_name_cn' => '', //String 显示中文名
     *            'attr_type' => '', //String 属性数据类型
     *            'form_type' => '', //String unknown
     *            </pre>
     */
    public function api_attrs_update($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
            'attr_name' => array_get($params,'attr_name',''),// 属性名称 String
            'attr_name_cn' => array_get($params,'attr_name_cn',''),// 显示中文名 String
            'attr_type' => array_get($params,'attr_type',''),// 属性数据类型 String
            'form_type' => array_get($params,'form_type',''),// unknown String
        ];
        $ret = $this->putJson(route('api_attrs_update',array_only($data,['id'])),$data)->toJson();
        return $ret;
    }
        
    /**
     * delete
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_attrs_delete($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->deleteJson(route('api_attrs_delete',array_only($data,['id'])),$data)->toJson();
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
        $ret = $this->postJson(route('api_component_create'),$data)->toJson();
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
        $ret = $this->getJson(route('api_components_query').'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * detail
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_component_detail($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->getJson(route('api_component_detail',array_only($data,['id'])).'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * update
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            'component_name' => '', //String 组件名称
     *            'component_desc' => '', //String 组件描述
     *            'attrs' => '', //String 属性数据类型
     *            </pre>
     */
    public function api_component_update($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
            'component_name' => array_get($params,'component_name',''),// 组件名称 String
            'component_desc' => array_get($params,'component_desc',''),// 组件描述 String
            'attrs' => array_get($params,'attrs',''),// 属性数据类型 String
        ];
        $ret = $this->putJson(route('api_component_update',array_only($data,['id'])),$data)->toJson();
        return $ret;
    }
        
    /**
     * delete
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_component_delete($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->deleteJson(route('api_component_delete',array_only($data,['id'])),$data)->toJson();
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
    public function api_tables_query($params = [])
    {
        $data = [
            'p' => array_get($params,'p',''),// 页数 String
            'n' => array_get($params,'n',''),// 每页条数 String
        ];
        $ret = $this->getJson(route('api_tables_query').'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * create
     *
     * @param array $params
     *            <pre>
     *            'TABLE_NAME' => '', //String 控件名称
     *            'TABLE_COMMENT' => '', //String 控件描述
     *            'CONNECTION' => '', //String 控件描述
     *            'columns' => '', //String unknown
     *            </pre>
     */
    public function api_create_table($params = [])
    {
        $data = [
            'TABLE_NAME' => array_get($params,'TABLE_NAME',''),// 控件名称 String
            'TABLE_COMMENT' => array_get($params,'TABLE_COMMENT',''),// 控件描述 String
            'CONNECTION' => array_get($params,'CONNECTION',''),// 控件描述 String
            'columns' => array_get($params,'columns',''),// unknown String
        ];
        $ret = $this->postJson(route('api_create_table'),$data)->toJson();
        return $ret;
    }
        
    /**
     * detail
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_table_detail($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->getJson(route('api_table_detail',array_only($data,['id'])).'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * update
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            'TABLE_NAME' => '', //String 控件名称
     *            'TABLE_COMMENT' => '', //String 控件描述
     *            'CONNECTION' => '', //String 控件描述
     *            'columns' => '', //String unknown
     *            </pre>
     */
    public function api_update_tables($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
            'TABLE_NAME' => array_get($params,'TABLE_NAME',''),// 控件名称 String
            'TABLE_COMMENT' => array_get($params,'TABLE_COMMENT',''),// 控件描述 String
            'CONNECTION' => array_get($params,'CONNECTION',''),// 控件描述 String
            'columns' => array_get($params,'columns',''),// unknown String
        ];
        $ret = $this->putJson(route('api_update_tables',array_only($data,['id'])),$data)->toJson();
        return $ret;
    }
        
    /**
     * delete
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_delete_query($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->deleteJson(route('api_delete_query',array_only($data,['id'])),$data)->toJson();
        return $ret;
    }
        
    /**
     * tableDeploy
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_tables_deploy($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->getJson(route('api_tables_deploy',array_only($data,['id'])).'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * saveTableDeploy
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            'validate' => '', //String 属性数据类型
     *            </pre>
     */
    public function api_save_table_deploy($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
            'validate' => array_get($params,'validate',''),// 属性数据类型 String
        ];
        $ret = $this->postJson(route('api_save_table_deploy',array_only($data,['id'])),$data)->toJson();
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
        $ret = $this->getJson(route('outer_api_components_list').'?'.http_build_query($data))->toJson();
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
        $ret = $this->postJson(route('outer_api_save_form_component'),$data)->toJson();
        return $ret;
    }
        
    /**
     * 表单列表
     *
     * 
     */
    public function outer_api_query_forms($params = [])
    {
        $data = [

        ];
        $ret = $this->getJson(route('outer_api_query_forms').'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * 表单详情
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function outer_api_forms_detail($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->getJson(route('outer_api_forms_detail').'?'.http_build_query($data))->toJson();
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
    public function api_auto_attrs_query($params = [])
    {
        $data = [
            'p' => array_get($params,'p',''),// 页数 String
            'n' => array_get($params,'n',''),// 每页条数 String
        ];
        $ret = $this->getJson(route('api_auto_attrs_query').'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * create
     *
     * @param array $params
     *            <pre>
     *            'attr_name' => '', //Varchar 属性名字
     *            'attr_name_cn' => '', //Varchar 显示中文名
     *            'attr_type' => '', //Varchar 属性类别
     *            'form_type' => '', //Varchar 表单控件类别
     *            </pre>
     */
    public function api_auto_attrs_create($params = [])
    {
        $data = [
            'attr_name' => array_get($params,'attr_name',''),// 属性名字 Varchar
            'attr_name_cn' => array_get($params,'attr_name_cn',''),// 显示中文名 Varchar
            'attr_type' => array_get($params,'attr_type',''),// 属性类别 Varchar
            'form_type' => array_get($params,'form_type',''),// 表单控件类别 Varchar
        ];
        $ret = $this->postJson(route('api_auto_attrs_create'),$data)->toJson();
        return $ret;
    }
        
    /**
     * detail
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_auto_attrs_detail($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->getJson(route('api_auto_attrs_detail',array_only($data,['id'])).'?'.http_build_query($data))->toJson();
        return $ret;
    }
        
    /**
     * update
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            'attr_name' => '', //Varchar 属性名字
     *            'attr_name_cn' => '', //Varchar 显示中文名
     *            'attr_type' => '', //Varchar 属性类别
     *            'form_type' => '', //Varchar 表单控件类别
     *            </pre>
     */
    public function api_auto_attrs_update($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
            'attr_name' => array_get($params,'attr_name',''),// 属性名字 Varchar
            'attr_name_cn' => array_get($params,'attr_name_cn',''),// 显示中文名 Varchar
            'attr_type' => array_get($params,'attr_type',''),// 属性类别 Varchar
            'form_type' => array_get($params,'form_type',''),// 表单控件类别 Varchar
        ];
        $ret = $this->putJson(route('api_auto_attrs_update',array_only($data,['id'])),$data)->toJson();
        return $ret;
    }
        
    /**
     * delete
     *
     * @param array $params
     *            <pre>
     *            'id' => '', //String id
     *            </pre>
     */
    public function api_auto_attrs_delete($params = [])
    {
        $data = [
            'id' => array_get($params,'id',''),// id String
        ];
        $ret = $this->deleteJson(route('api_auto_attrs_delete',array_only($data,['id'])),$data)->toJson();
        return $ret;
    }

}
