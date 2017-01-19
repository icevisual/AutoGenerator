<?php
namespace App\Http\Controllers\AutoMake;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\AutoMake\Auto\Attrs;

class AttrsController extends Controller
{
    protected $_customValidateConfig = [
        'rules' => [
            'id' => 'required|exists:auto.attrs',
            'attr_name' => 'required|unique:auto.attrs,attr_name',
            'attr_name_cn' => 'required',
            'attr_type' => 'required',
            'form_type' => 'required',
        ],
        'attributes' => [
            'attr_name' => '属性名字',
            'attr_name_cn' => '显示中文名',
            'attr_type' => '属性类别',
            'form_type' => '表单控件类别',
        ],
    ];


    public function create()
    {
        $data = [
            'attr_name' => \Input::get('attr_name'), // varchar 属性名字
            'attr_name_cn' => \Input::get('attr_name_cn'), // varchar 显示中文名
            'attr_type' => \Input::get('attr_type','string'), // varchar 属性类别
            'form_type' => \Input::get('form_type','input'), // varchar 表单控件类别
        ]; 
        $config = $this->getValidateCondition('create');
        $config['data'] = $data;
        runCustomValidator($config); // 属性名映射
        $obj = Attrs::createRecord($data);
        return $this->__json($obj);
    }

    public function query()
    {
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10); // 每页条数
        $data = Attrs::queryRecords([], $page, $pageSize);
        return $this->__json($data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'attr_name' => \Input::get('attr_name'), // varchar 属性名字
            'attr_name_cn' => \Input::get('attr_name_cn'), // varchar 显示中文名
            'attr_type' => \Input::get('attr_type','string'), // varchar 属性类别
            'form_type' => \Input::get('form_type','input'), // varchar 表单控件类别
        ];
        
        $config = $this->getValidateCondition('update', [
            'id' => $data['id']
        ]);
        $config['data'] = $data;
        runCustomValidator($config); // 属性名映射
        $obj = Attrs::updateRecord($data);
        return $this->__json();
    }

    public function detail($id)
    {
        $detail = Attrs::recordDetail($id);
        return $this->__json($detail);
    }

    public function delete($id)
    {
        Attrs::recordDelete($id);
        return $this->__json();
    }
}