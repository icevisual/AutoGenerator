<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\System\Tables;
use App\Models\System\Columns;

class TableController extends Controller
{

    public function tableDeploy($id)
    {
        runCustomValidator([
            'data' => [
                'id' => $id
            ], // 数据
            'rules' => [
                'id' => 'required|exists:tables'
            ], // 条件
        ]);
        
        $tname = Tables::getTableName($id);
        $detail = Columns::queryTableColumns($id);
//         dump($detail);
        $file = 'jsonf/table-deploy.js';
        if (file_exists(public_path($file))) {
            
            $json = file_get_contents(public_path($file));
            $json = json_decode($json, 1);
            array_set($json, 'table.attrs.caption', '表 [' . $tname . '] 字段');
            array_set($json, 'table.attrs.tablename', $tname);
            // array_set($json, 'component_form.attrs.action.method', 'PUT');
            // array_set($json, 'component_form.fields.id', [
            // 'name' => ' ID',
            // 'type' => 'input',
            // 'hidden' => true,
            // 'value' => $detail['component']['id']
            // ]);
            // array_set($json, 'component_form.fields.component_name.value',$detail['component']['component_name'] );
            // array_set($json, 'component_form.fields.component_desc.value',$detail['component']['component_desc'] );
            array_set($json, 'table.data.list', $detail);
            return $this->__json($json);
        }
        return $this->__json(\ErrorCode::SYSTEM_ERROR);
    }

    public function getValidateCondition($type, $params = [])
    {
        $config = [
            'rules' => [
                'id' => 'required|exists:tables',
                'table_name' => 'required|regex:/^[a-zA-Z][\d\w\_]*$/i|unique:tables,table_name',
                'table_comment' => 'required',
                'columns' => 'required|array',
                'columns.*.COLUMN_NAME' => 'required',
                'columns.*.COLUMN_NAME_CN' => 'required',
                'columns.*.COLUMN_COMMENT' => 'required'
            ], // 条件
            'attributes' => [
                'table_name' => '表名',
                'table_comment' => '表备注',
                'columns' => '表字段',
                'columns.*.COLUMN_NAME' => '字段名',
                'columns.*.COLUMN_NAME_CN' => '字段中文名',
                'columns.*.COLUMN_COMMENT' => '字段备注'
            ]
        ];
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

    public function create()
    {
        $data = [
            'table_name' => \Input::get('table_name'), // String 控件名称
            'table_comment' => \Input::get('table_comment'), // String 控件描述
            'columns' => \Input::get('columns')
        ] // String 属性数据类型
;
        
        $config = $this->getValidateCondition('create');
        $config['data'] = $data;
        runCustomValidator($config); // 属性名映射
        $obj = Tables::createNewTable($data);
        return $this->__json($obj);
    }

    public function query()
    {
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10); // 每页条数
        
        $data = Tables::queryTables([], $page, $pageSize);
        
        return $this->__json($data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'table_name' => \Input::get('table_name'), // String 控件名称
            'table_comment' => \Input::get('table_comment'), // String 控件描述
            'columns' => \Input::get('columns')
        ] // String 属性数据类型
;
        
        $config = $this->getValidateCondition('update', [
            'id' => $data['id']
        ]);
        $config['data'] = $data;
        runCustomValidator($config); // 属性名映射
        $obj = Tables::updateTable($data);
        return $this->__json();
    }

    public function detail($id)
    {
        $detail = Tables::tableDetail($id);
        
        $file = 'jsonf/table.js';
        if (file_exists(public_path($file))) {
            
            $json = file_get_contents(public_path($file));
            $json = json_decode($json, 1);
            array_set($json, 'table_form.attrs.action.uri', '/api/table/' . $id);
            array_set($json, 'table_form.attrs.action.method', 'PUT');
            array_set($json, 'table_form.fields.id', [
                'name' => ' ID',
                'type' => 'input',
                'hidden' => true,
                'value' => $detail['id']
            ]);
            array_set($json, 'table_form.fields.TABLE_NAME.value', $detail['table_name']);
            array_set($json, 'table_form.fields.TABLE_COMMENT.value', $detail['table_comment']);
            array_set($json, 'table.data.list', $detail['columns']);
            return $this->__json($json);
        }
        return $this->__json(\ErrorCode::SYSTEM_ERROR);
    }

    public function delete($id)
    {
        if ($id) {
            \DB::beginTransaction();
            Tables::where('id', $id)->delete();
            Columns::where('table_id', $id)->delete();
            \DB::commit();
        }
        return $this->__json();
    }
}


