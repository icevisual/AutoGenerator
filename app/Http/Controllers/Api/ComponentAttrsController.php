<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;
use App\Models\Form\Component;
use App\Models\Form\ComponentAttrs;

class ComponentAttrsController extends Controller
{

    public function create()
    {
        $data = [
            'attr_name' => \Input::get('attr_name'), // String 属性名称
            'attr_name_cn' => \Input::get('attr_name_cn'), // String 显示中文名
            'attr_value' => \Input::get('attr_value'), // String 属性值
            'attr_type' => \Input::get('attr_type'), // String 属性数据类型
            'form_type' => \Input::get('form_type')
        ]; // String 表单控件类别

        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'attr_name' => 'required',
                'attr_name_cn' => 'required',
                'attr_value' => 'sometimes',
                'attr_type' => 'required',
                'form_type' => 'required'
            ], // 条件
            'attributes' => [
                'form_type' => '表单控件类别',
                'attr_name' => '属性名称',
                'attr_name_cn' => '显示中文名',
                'attr_value' => '属性值',
                'attr_type' => '属性数据类型'
            ]
        ]) // 属性名映射
;
        $obj = Attrs::createNewAttr($data);
        return $this->__json($obj->toArray());
    }

    public function query()
    {
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10000); // 每页条数
        
        $data = Attrs::queryAttrs([], $page, $pageSize);
        
        return $this->__json($data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'attr_name' => \Input::get('attr_name'), // String 属性名称
            'attr_name_cn' => \Input::get('attr_name_cn'), // String 显示中文名
            'attr_value' => \Input::get('attr_value'), // String 属性值
            'attr_type' => \Input::get('attr_type'), // String 属性数据类型
            'form_type' => \Input::get('form_type')
        ]; // String 表单控件类别

        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'id' => 'required|numeric|exists:attrs',
                'attr_name' => 'required',
                'attr_name_cn' => 'required',
                'attr_value' => 'sometimes',
                'attr_type' => 'required',
                'form_type' => 'required'
            ], // 条件
            'attributes' => [
                'id' => '属性ID',
                'form_type' => '表单控件类别',
                'attr_name' => '属性名称',
                'attr_name_cn' => '显示中文名',
                'attr_value' => '属性值',
                'attr_type' => '属性数据类型'
            ]
        ]) // 属性名映射
;
        $obj = Attrs::updateAttr($data['id'], array_except($data, [
            'id'
        ]));
        return $this->__json();
    }

    public function detail($id)
    {
        $detail = Attrs::attrDetail($id);
        if (! $detail) {
            return $this->__json(\ErrorCode::VITAL_NOT_FOUND);
        }
        $file = 'jsonf/attr.js';
        if (file_exists(public_path($file))) {
            
            $json = file_get_contents(public_path($file));
            $json = json_decode($json,1);
            array_set($json, 'attr_form.attrs.action.uri', '/api/attr/' . $id);
            array_set($json, 'attr_form.attrs.action.method', 'PUT');
            array_set($json, 'attr_form.fields.id', [
                'name' => '属性 ID',
                'type' => 'input',
                'hidden' => true,
                'attrs' => [
                    'type' => 'hidden'
                ],
                'value' => $detail->id
            ]);
            array_set($json, 'attr_form.fields.attr_name.value',$detail->attr_name );
            array_set($json, 'attr_form.fields.attr_name_cn.value',$detail->attr_name_cn );
            array_set($json, 'attr_form.fields.attr_value.value',$detail->attr_value );
            array_set($json, 'attr_form.fields.attr_type.value',$detail->attr_type );
            array_set($json, 'attr_form.fields.form_type.value',$detail->form_type );
            return $this->__json($json);
        }
        return $this->__json(\ErrorCode::SYSTEM_ERROR);
    }

    public function delete($id)
    {
        if ($id) {
            Attrs::where('id', $id)->delete();
        }
        return $this->__json();
    }
}


