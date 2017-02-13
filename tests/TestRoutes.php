<?php 

use App\Services\Open\OpenServices;

class TestRoutes extends TestCase
{
        
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
