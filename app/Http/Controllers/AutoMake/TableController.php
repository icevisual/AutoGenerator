<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\System\Tables;
use App\Models\System\Columns;

class TableController extends Controller
{
    protected $_customValidateConfig = [
        'rules' => [
            'id' => 'required|exists:tables',
            'table_name' => 'required|regex:/^[a-zA-Z][\d\w\_]*$/i|unique:tables,table_name',
            'table_comment' => 'required',
        ], // 条件
        'attributes' => [
            'table_name' => '表名',
            'table_comment' => '表备注',
        ]
    ];

    public function create()
    {
        $data = [
            'table_name' => \Input::get('TABLE_NAME'), // String 控件名称
            'table_comment' => \Input::get('TABLE_COMMENT'), // String 控件描述
            'connection' => \Input::get('CONNECTION'), // String 控件描述
        ]; 
        $config = $this->getValidateCondition('create');
        $config['data'] = $data;
        runCustomValidator($config); // 属性名映射
        $obj = Tables::createRecord($data);
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
            'table_name' => \Input::get('TABLE_NAME'), // String 控件名称
            'table_comment' => \Input::get('TABLE_COMMENT'), // String 控件描述
            'connection' => \Input::get('CONNECTION'), // String 控件描述
        ]; // String 属性数据类型
        
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
        $detail = Tables::recordDetail($id);
        return $this->__json($detail);
    }

    public function delete($id)
    {
        Tables::recordDelete($id);
        return $this->__json();
    }
}


