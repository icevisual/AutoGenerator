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
        
        $data = [
            'attr_form' => [
                'attrs' => [
                    'caption' => '新建组件属性',
                    'formColor' => 'box-info',
                    'buttons' => [
                        'preinstall' => [
                            'submit' => '1',
                            'cancel' => '1'
                        ]
                    ],
                    'action' => [
                        'uri' => '/api/attr/' . $id,
                        'method' => 'PUT',
                        'success' => [
                            'redirect' => '/attrs'
                        ]
                    ]
                ],
                'fields' => [
                    'id' => [
                        'name' => '属性 ID',
                        'type' => 'input',
                        'hidden' => true,
                        'attrs' => [
                            'type' => 'hidden'
                        ],
                        'value' => $detail->id
                    ],
                    'attr_name' => [
                        'name' => '属性名',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '属性名'
                        ],
                        'value' => $detail->attr_name
                    ],
                    'attr_name_cn' => [
                        'name' => '显示中文名',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '显示中文名'
                        ],
                        'value' => $detail->attr_name_cn
                    ],
                    'attr_value' => [
                        'name' => '属性值',
                        'type' => 'input',
                        "validate" => [
                        "rules" => "sometimes"
                        ],
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '属性值'
                        ],
                        'value' => $detail->attr_value
                    ],
                    'attr_type' => [
                        'name' => '属性类别',
                        'type' => 'select',
                        'value' => $detail->attr_type,
                        'data' => [
                            '0' => [
                                'value' => 'string',
                                'text' => 'string'
                            ],
                            '1' => [
                                'value' => 'integer',
                                'text' => 'integer'
                            ],
                            '2' => [
                                'value' => 'float',
                                'text' => 'float'
                            ],
                            '3' => [
                                'value' => 'boolean',
                                'text' => 'boolean'
                            ],
                            '4' => [
                                'value' => 'array',
                                'text' => 'array'
                            ],
                            '5' => [
                                'value' => 'json',
                                'text' => 'json'
                            ]
                        ]
                    ],
                    'form_type' => [
                        'name' => '渲染类别',
                        'type' => 'select',
                        'value' => $detail->form_type,
                        'data' => [
                            '0' => [
                                'value' => 'input',
                                'text' => 'input'
                            ],
                            '1' => [
                                'value' => 'select',
                                'text' => 'select'
                            ],
                            '2' => [
                                'value' => 'checkbox',
                                'text' => 'checkbox'
                            ],
                            '3' => [
                                'value' => 'radio',
                                'text' => 'radio'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        return $this->__json($data);
    }

    public function delete($id)
    {
        if ($id) {
            Attrs::where('id', $id)->delete();
        }
        return $this->__json();
    }
}


