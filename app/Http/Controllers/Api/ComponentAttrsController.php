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
            'id' => \Input::get('id',0), // String 属性名称-中文
            'attr_name_cn' => \Input::get('attr_name_cn'), // String 属性名称-中文
            'attr_name_en' => \Input::get('attr_name_en'), // String 属性名称-英文
            'attr_type' => \Input::get('attr_type')// String 属性数据类型
        ];
        if(!$data['id']){
            unset($data['id']);
            runCustomValidator([
                'data' => $data, // 数据
                'rules' => [
                    'id' => 'sometimes|exists:attrs',
                    'attr_name_cn' => 'required|unique:attrs,attr_name_cn',
                    'attr_name_en' => 'required|unique:attrs,attr_name_en',
                    'attr_type' => 'required'
                ], // 条件
                'attributes' => [
                    'id' => '属性',
                    'attr_name_cn' => '属性名称-中文',
                    'attr_name_en' => '属性名称-英文',
                    'attr_type' => '属性数据类型'
                ]// 属性名映射
            ]);
            $obj = Attrs::createNewAttr($data);
            return $this->__json($obj->toArray());
        }else{
            runCustomValidator([
                'data' => $data, // 数据
                'rules' => [
                    'id' => 'sometimes|exists:attrs',
                    'attr_name_cn' => 'required|unique:attrs,attr_name_cn,'.$data['id'].',id',
                    'attr_name_en' => 'required|unique:attrs,attr_name_en,'.$data['id'].',id',
                    'attr_type' => 'required'
                ], // 条件
                'attributes' => [
                    'id' => '属性',
                    'attr_name_cn' => '属性名称-中文',
                    'attr_name_en' => '属性名称-英文',
                    'attr_type' => '属性数据类型'
                ]// 属性名映射
            ]);
            $obj = Attrs::updateAttr($data['id'],array_except($data, ['id']));
            return $this->__json();
        }
    }
    
    public function query()
    {
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10); // 每页条数
    
        $data = Attrs::queryAttrs([], $page, $pageSize);
    
        return $this->__json($data);
    }
    
    public function update()
    {
        return $this->__json();
    }
    
    public function detail($id)
    {
        $detail = Attrs::attrDetail($id);
        if(!$detail){
            return $this->__json(\ErrorCode::VITAL_NOT_FOUND);
        }
        $data = [
            'attr_form' => [
                'attrs' => [
                    'caption' => '新建组件属性',
                    'formColor' => 'box-warning',
                    'action' => [
                        'uri' => '/api/attr',
                        'method' => 'POST',
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
                            'type' => 'hidden',
                        ],
                        'value' => $detail->id,
                    ],
                    'attr_name_cn' => [
                        'name' => '属性名字中',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'default' => 'asdda',
                            'placeholder' => '属性名字中'
                        ],
                        'value' => $detail->attr_name_cn,
                    ],
                    'attr_name_en' => [
                        'name' => '属性名字英',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '属性名字英'
                        ],
                        'value' => $detail->attr_name_en,
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
        if($id){
            Attrs::where('id',$id)->delete();
        }
        return $this->__json();
    }
}


