<?php
namespace App\Console\Achieves\ConfigParser;

class Parser
{

    const PART_PARAMETER = 'data';

    const PART_VALIDATE = 'validate';

    const PART_PROCESSES = 'processes';

    const PART_RETURN = 'return';

    public function extendConfig($defaultConfig, $config)
    {
        return $defaultConfig + $config;
    }

    public function parseParameter($data)
    {
        $demo = [
            'name' => [
                'm' => 'n',
                'n' => '名称',
                'd' => ''
            ],
            'value' => '名称',
            'typeid' => 'tid'
        ];
        
        $ret = [];
        
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $ret[$k] = $v;
            } else {
                $ret[$k] = [
                    'm' => $k,
                    'n' => $v
                ];
            }
        }
        return $ret;
    }

    public function parseValidate($data)
    {
        return $data;
    }

    public function parseProcesses($data)
    {
        return $data;
    }

    public function parseReturn($data)
    {
        return $data;
    }

    public function isPart($pattern, $value)
    {
        return $pattern == $value;
    }

    public function doProcessRequest($config, \Illuminate\Http\Request $request)
    {
        $parsedConfig = $this->doParseConfig($config);
        
        runCustomValidator($parsedConfig[PART_VALIDATE] + [
            'data' => $request->all(),
            'attributes' => $parsedConfig[PART_PARAMETER]['attributes']
        ] // TODO set attributes ( key => cn_name )
);
    }

    public function doParseConfig($config)
    {
        $defaultConfig = [];
        $usingConfig = $this->extendConfig($defaultConfig, $config);
        // 1. 数据 ，2. 验证 ,3. 流程,4. 返回
        $container = [];
        foreach ($usingConfig as $key => $value) {
            switch ($key) {
                case PART_PARAMETER:
                    $container[PART_PARAMETER] = $this->parseParameter($value);
                    break;
                case PART_VALIDATE:
                    $container[PART_VALIDATE] = $this->parseValidate($value);
                    break;
                case PART_PROCESSES:
                    $container[PART_PROCESSES] = $this->parseProcesses($value);
                    break;
                case PART_RETURN:
                    $container[PART_RETURN] = $this->parseReturn($value);
                    break;
                default:
                    break;
            }
        }
        return $container;
        
        $config = [
            'symbol' => 'simpleCreate',
            'model' => 'App\Models\Form\Attrs',
            'parameters' => [
                'data'
            ],
            'validate' => [
                'rules' => [
                    'attr_name' => 'required|unique:attrs,attr_name',
                    'attr_name_cn' => 'required',
                    'attr_type' => 'required',
                    'form_type' => 'required'
                ],
                'message' => [
                    'name.required' => '请填写得得得'
                ]
            ],
            'createFields' => [
                'attr_name',
                'attr_type',
                'form_type'
            ],
            'fieldsMap' => [
                'default_value' => 'data.attr_value'
            ],
            'return' => 'array|object'
        ];
        
        $simpleCreate = [
            'data' => [
                'attr_name' => '属性名称',
                'attr_name_cn' => '显示名称',
                'attr_type' => '数据类型',
                'form_type' => '渲染类别'
            ],
            'validate' => [
                'rules' => [
                    'attr_name' => 'required|unique:attrs,attr_name',
                    'attr_name_cn' => 'required',
                    'attr_type' => 'required',
                    'form_type' => 'required'
                ],
                'message' => [
                    'name.required' => '请填写得得得'
                ]
            ],
            'processes' => [
                'call' => [
                    'f' => 'simpleCreate',
                    'w' => [
                        [
                            'createFields' => [
                                'attr_name',
                                'attr_name_cn',
                                'attr_type',
                                'form_type'
                            ]
                        ],
                        'data'
                    ],
                    'r' => 'attr'
                ]
            ],
            'return' => [
                'type' => 'json',
                'data' => [
                    'attr'
                ]
            ]
        ];
        
        $defaultConfig = [
            'data' => [
                'name' => [
                    'm' => 'n',
                    'n' => '名称',
                    'd' => ''
                ],
                'value' => '名称',
                'typeid' => 'tid'
            ],
            'validate' => [
                'rules' => [
                    'name' => 'required|exists',
                    'value' => 'required|max:10',
                    'typeid' => 'required|numeric|exists'
                ],
                'message' => [
                    'name.required' => '请填写得得得'
                ],
                'valueName' => [
                    'value' => [
                        'val1' => '第一类'
                    ]
                ]
            ],
            'processes' => [
                'call' => [
                    'f' => 'simpleCreate',
                    'w' => []

                    ,
                    'r' => ''
                ],
                'category' => [
                    'call' => 'getCategory',
                    'with' => [
                        'data.name'
                    ]
                ],
                'if' => [
                    'condition' => 'category',
                    'throw' => 'Exception'
                ],
                'else' => [
                    'newCategory' => [
                        'call' => 'createCategory',
                        'with' => 'data'
                    ]
                ],
                'return' => 'newCategory.id'
            ]
        ];
    }
}















