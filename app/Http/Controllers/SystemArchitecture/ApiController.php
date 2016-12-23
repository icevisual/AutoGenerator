<?php
namespace App\Http\Controllers\SystemArchitecture;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class ApiController extends Controller
{

    public function formConfig()
    {
        $data = [
            'formConfig' => [
                'accessKey' => [
                    'name' => '开发者 AccessKey',
                    'validate' => [
                        'rules' => 'required|max:20',
                        'message' => [
                            'require' => '请填写 开发者 AccessKey'
                        ]
                    ],
                    'type' => 'input',
                    'attrs' => [
                        'type' => 'text',
                        'default' => 'asdda',
                        'placeholder' => '开发者 AccessKey'
                    ],
                    'value' => ''
                ],
                'accessSecret' => [
                    'name' => '开发者 AccessSecret',
                    'validate' => [
                        'rules' => 'required|max:20',
                        'message' => [
                            'require' => '请填写 开发者 AccessSecret'
                        ]
                    ],
                    'type' => 'input',
                    'attrs' => [
                        'type' => 'text',
                        'placeholder' => '开发者 AccessSecret'
                    ],
                    'value' => ''
                ],
                'logLevel' => [
                    'name' => '日志级别',
                    'type' => 'select',
                    'value' => 'debug',
                    'attrs' => [
                        'multiple' => 'multiple'
                    ],
                    'data' => [
                        '0' => [
                            'value' => 'debug',
                            'text' => 'debug'
                        ],
                        '1' => [
                            'value' => 'info',
                            'text' => 'info'
                        ],
                        '2' => [
                            'value' => 'notice',
                            'text' => 'notice'
                        ],
                        '3' => [
                            'value' => 'warning',
                            'text' => 'warning'
                        ],
                        '4' => [
                            'value' => 'error',
                            'text' => 'error'
                        ]
                    ]
                ],
                'env' => [
                    'name' => '环境',
                    'type' => 'select',
                    'value' => 'local',
                    'data' => [
                        '0' => [
                            'value' => 'local',
                            'text' => '本地(192.168.5.61:8083)'
                        ],
                        '1' => [
                            'value' => 'test',
                            'text' => '测试(121.41.33.141:8083)'
                        ],
                        '2' => [
                            'value' => 'production',
                            'text' => '正式(120.26.109.169:8083)'
                        ]
                    ]
                ]
            ]
        ];
        
        
        $data = [
            'componentForm' => [
                'attrs' => [
                    'caption' => '组件',
                ],
                'fields' => [
                    'component_name' => [
                        'name' => '组件名称',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'default' => 'asdda',
                            'placeholder' => '组件名称'
                        ],
                        'value' => ''
                    ],
                    'component_desc' => [
                        'name' => '组件描述',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '组件描述'
                        ],
                        'value' => ''
                    ],
                ]
            ],
            'attrBindForm' => [
                'attrs' => [
                    'caption' => '添加属性',
                ],
                'fields' => [
                    'attr_id' => [
                        'name' => '属性ID',
                        'type' => 'select',
                        'value' => 'string',
                        'data' => [
                            [
                                'value' => 'string',
                                'text' => 'string'
                            ],
                            [
                                'value' => 'integer',
                                'text' => 'integer'
                            ],
                            [
                                'value' => 'float',
                                'text' => 'float'
                            ],
                            [
                                'value' => 'boolean',
                                'text' => 'boolean'
                            ],
                        ]
                    ],
                    'default_value' => [
                        'name' => '属性默认值',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '属性默认值'
                        ],
                        'value' => ''
                    ],
                ]
            ],
            'attrForm' => [
                'attrs' => [
                    'caption' => '新建组件属性',
                    'formColor' => 'box-warning'
                ],
                'fields' => [
                    'attr_name_cn' => [
                        'name' => '属性名字中',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'default' => 'asdda',
                            'placeholder' => '属性名字中'
                        ],
                        'value' => ''
                    ],
                    'attr_name_en' => [
                        'name' => '属性名字英',
                        'type' => 'input',
                        'attrs' => [
                            'type' => 'text',
                            'placeholder' => '属性名字英'
                        ],
                        'value' => ''
                    ],
                    'attr_type' => [
                        'name' => '属性类别',
                        'type' => 'select',
                        'value' => 'string',
                        'data' => [
                            [
                                'value' => 'string',
                                'text' => 'string'
                            ],
                            [
                                'value' => 'integer',
                                'text' => 'integer'
                            ],
                            [
                                'value' => 'float',
                                'text' => 'float'
                            ],
                            [
                                'value' => 'boolean',
                                'text' => 'boolean'
                            ],
                        ]
                    ]
                ]
            ]
        ];
        return $this->__json($data);
    }

    public function sidebarMenu()
    {
        $data = [
            [
                'group' => 'MAIN NAVIGATION',
                'menus' => [
                    [
                        'icon' => 'fa-dashboard',
                        'title' => 'Demo',
                        'submenus' => [
                            [
                                'href' => route('demo_list'),
                                'icon' => 'fa-circle-o',
                                'title' => 'List Demo'
                            ],
                            [
                                'href' => route('demo_create'),
                                'icon' => 'fa-circle-o',
                                'title' => 'Form Demo'
                            ]
                        ]
                    ],
                    [
                        'icon' => 'fa-files-o',
                        'title' => 'Layout Options',
                        'submenus' => [
                            [
                                'href' => route('components_list'),
                                'icon' => 'fa-circle-o',
                                'title' => 'COMPONENTS LIST'
                            ],
                            [
                                'href' => route('components_create'),
                                'icon' => 'fa-circle-o',
                                'title' => 'COMPONENTS CREATE'
                            ],
                        ]
                    ]
                ]
            ]
        ];
        
        $pathname = \Input::get('pathname');
        foreach ($data as $k =>  $v){
            // Group 
            foreach ($v['menus'] as $k1 =>  $v1){
                // menu
                foreach ($v1['submenus'] as $k2 => $v2){
                    // submenus
                    $parse_url = parse_url($v2['href']);
                    if($parse_url['path'] == $pathname){
                        $data[$k]['menus'][$k1]['submenus'][$k2]['active'] = true;
                        $data[$k]['menus'][$k1]['active'] = true;
                        break 3;
                    }
                }
            }
        }
        
        
        return $this->__json($data);
    }
}

