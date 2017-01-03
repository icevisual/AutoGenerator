<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;
use App\Models\Form\Component;
use App\Models\Form\ComponentAttrs;

class ComponentController extends Controller
{

    public function create()
    {
        $data = [
            'component_name' => \Input::get('component_name'), // String 控件名称
            'component_desc' => \Input::get('component_desc'), // String 控件描述
            'attrs' => \Input::get('attrs')// String 属性数据类型
        ];
        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'component_name' => 'required|unique:component,component_name',
                'component_desc' => 'required',
                'attrs' => 'required|array',
//                 'attrs.*.default_value' => 'required',
                'attrs.*.id' => 'required'
            ], // 条件
            'attributes' => [
                'component_name' => '组件名称',
                'component_desc' => '组件描述',
                'attrs' => '组件属性',
                'attrs.*.default_value' => '默认值'
            ]
        ]); // 属性名映射
        $component = Component::createNewComponent($data);
        return $this->__json($component->toArray());
    }

    public function query()
    {
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10); // 每页条数
        
        $data = Component::queryComponent([], $page, $pageSize);
        
        return $this->__json($data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id, // String 组件名称
            'component_name' => \Input::get('component_name'), // String 组件名称
            'component_desc' => \Input::get('component_desc'), // String 组件描述
            'attrs' => \Input::get('attrs')// String 属性数据类型
        ];
        runCustomValidator([
            'data' => $data, // 数据
            'rules' => [
                'id' => 'required|numeric|exists:component',
                'component_name' => 'required|unique:component,component_name,'.$data['id'],',id',
                'component_desc' => 'required',
                'attrs' => 'required|array',
//                 'attrs.*.default_value' => 'required',
                'attrs.*.id' => 'required'
            ], // 条件
            'attributes' => [
                'component_name' => '组件名称',
                'component_desc' => '组件描述',
                'attrs' => '组件属性',
                'attrs.*.default_value' => '默认值'
            ]
        ]);
        $component = Component::updateComponent($data);
        return $this->__json();
    }

    public function detail($id)
    {
        $detail = Component::componentDetail($id);
        
        $data = [
            'component_attrs_table' => [
                'attrs' => [
                    'caption' => '组件属性表',
                    'uris' => [
                        'query' => [
                            'url' => '/api/attrs',
                            'param' => [],
                            'method' => 'GET'
                        ]
                    ],
                    'ajax' => true,
                    'rownum' => false,
                    'hidden' => [],
                    'operation' => true,
                    'operations' => [
                        'addbind' => [
                            "color" => "btn-success",
                            "text" => "+"
                        ]
                    ],
                    'header' => [
                        '0' => [
                            'name' => 'ID',
                            'width' => '20px'
                        ],
                        '属性名',
                        '显示名称',
                        '属性值',
                        '数据类型',
                        '渲染类型',
                    ]
                ],
                'data' => [
                    'total' => '2',
                    'current_page' => '1',
                    'last_page' => '1',
                    'per_page' => '10',
                    'list' => []
                ]
            ],
            'attrs_bind_table' => [
                'attrs' => [
                    'caption' => '组件属性表',
                    'ajax' => false,
                    'uris' => [
                        'query' => [
                            'url' => '/api/attrs',
                            'param' => [],
                            'method' => 'GET'
                        ]
                    ],
                    'rownum' => true,
                    'hidden' => [],
                    'advancedColumn' => [
                        'default_value' => [
                            'type' => 'input'
                        ]
                    ],
                    'operation' => true,
                    'operations' => [
                        'attrunbind' => [
                            'color' => 'btn-warning',
                            'text' => 'R'
                        ]
                    ],
                    'header' => [
                        '0' => [
                            'name' => 'ID',
                            'width' => '20px'
                        ],
                        '属性名',
                        '属性值',
                        '数据类型',
                        '渲染类型',
                    ]
                ],
                'data' => [
                    'total' => '3',
                    'current_page' => '1',
                    'last_page' => '1',
                    'per_page' => '10',
                    'list' => $detail['attrs']
                ]
            ],
            'component_form' => [
                'attrs' => [
                    'caption' => '组件',
                    'buttons' => [
                        'preinstall' => [
                            'submit' => false,
                            'cancel' => '1'
                        ],
                        'others' => [
                            [
                                'name' => 'submit',
                                'class' => 'btn-info',
                                'event' => 'submit',
                            ]
                        ]
                    ],
                    'action' => [
                        'uri' => '/api/component/'.$id,
                        'method' => 'PUT',
                        'success' => [
                            'redirect' => '/components'
                        ]
                    ]
                ],
                'fields' => [
                    'id' => [
                        'name' => ' ID',
                        'type' => 'input',
                        'hidden' => true,
                        'value' => $detail['component']['id']
                    ],
                    'component_name' => [
                        'name' => '组件名称',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'default' => 'asdda',
                            'placeholder' => '组件名称'
                        ],
                        'value' => $detail['component']['component_name']
                    ],
                    'component_desc' => [
                        'name' => '组件描述',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '组件描述'
                        ],
                        'value' => $detail['component']['component_desc']
                    ]
                ]
            ]
        ];
        return $this->__json($data);
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


