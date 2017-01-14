<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\System\Tables;

class TableController extends Controller
{

    public function create()
    {
        $data = [
            'table_name' => \Input::get('table_name'), // String 控件名称
            'table_comment' => \Input::get('table_comment'), // String 控件描述
            'columns' => \Input::get('columns')// String 属性数据类型
        ];
        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'table_name' => 'required|regex:/^[a-zA-Z][\d\w\_]*$/i|unique:tables,table_name',
                'table_comment' => 'required',
                'columns' => 'required|array',
                'columns.*.COLUMN_NAME' => 'required',
                'columns.*.COLUMN_NAME_CN' => 'required',
                'columns.*.COLUMN_COMMENT' => 'required',
            ], // 条件
            'attributes' => [
                'component_name' => '组件名称',
                'component_desc' => '组件描述',
                'attrs' => '组件属性',
                'attrs.*.default_value' => '默认值'
            ]
        ]); // 属性名映射
        $obj = Tables::createNewTable($data);
        return $this->__json($obj);
    }

    public function query()
    {
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10); // 每页条数
        
        $data = \App\Models\InformationSchema\Tables::queryTables([], $page, $pageSize);
        
        return $this->__json($data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'table_name' => \Input::get('table_name'), // String 控件名称
            'table_comment' => \Input::get('table_comment'), // String 控件描述
            'columns' => \Input::get('columns')// String 属性数据类型
        ];
        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'id' => 'required|exists:tables',
                'table_name' => 'required|unique:tables,table_name,'.$data['id'].',id',
                'table_comment' => 'required',
                'columns' => 'required|array',
            ], // 条件
            'attributes' => [
                'component_name' => '组件名称',
                'component_desc' => '组件描述',
                'attrs' => '组件属性',
                'attrs.*.default_value' => '默认值'
            ]
        ]); // 属性名映射
        $obj = Tables::updateTable($data);
        return $this->__json();
    }

    public function detail($id)
    {
        $detail = Component::componentDetail($id);
        
        $file = 'jsonf/table.js';
        if (file_exists(public_path($file))) {
        
            $json = file_get_contents(public_path($file));
            $json = json_decode($json,1);
            array_set($json, 'component_form.attrs.action.uri', '/api/component/'.$id);
            array_set($json, 'component_form.attrs.action.method', 'PUT');
            array_set($json, 'component_form.fields.id', [
                'name' => ' ID',
                'type' => 'input',
                'hidden' => true,
                'value' => $detail['component']['id']
            ]);
            array_set($json, 'component_form.fields.component_name.value',$detail['component']['component_name'] );
            array_set($json, 'component_form.fields.component_desc.value',$detail['component']['component_desc'] );
            array_set($json, 'attrs_bind_table.data.list',$detail['attrs'] );
            return $this->__json($json);
        }
        return $this->__json(\ErrorCode::SYSTEM_ERROR);
    }

    public function delete($id)
    {
        if ($id) {
            Component::where('id', $id)->delete();
            ComponentAttrs::where('component_id', $id)->delete();
        }
        return $this->__json();
    }
}


