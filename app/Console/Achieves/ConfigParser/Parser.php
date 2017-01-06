<?php
namespace App\Console\Achieves\ConfigParser;

class Parser
{
    
    public function extendConfig($defaultConfig,$config){
        return $defaultConfig + $config;
    }
    

    public function parseApiParameter($data)
    {
        
    }
    
    public function parseApiValidate($data)
    {
    
    }
    
    
    public function parseApiConfig($config)
    {
        $defaultConfig = [];
        
        $usingConfig = $this->extendConfig($defaultConfig, $config);
        
        // 1. 数据 ，2. 验证 ,3. 流程,4. 返回
        
        $adjudicator = new Adjudicator();
        
        $container = [];
        
        foreach ($usingConfig as $key => $value){
            if($adjudicator->judgeApiParameter($key, $value)){
                $container[Adjudicator::API_PARAMETER] = $this->parseApiParameter($value);
            }
            if($adjudicator->judgeApiValidate($key, $value)){
                $container[Adjudicator::API_VALIDATE] = $this->parseApiValidate($value);
            }
        }
        
        
        
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
            'data-flow' => [
                'call' => [
                    'f' => 'simpleCreate',
                    'w' => [
                        'fieldsMap' => [
                            'attr_type' => 'data.attr_type',
                            'form_type' => 'data.form_type',
                            'secret' => 'str_random(20)'
                        ]
                    ],
                    'r' => '',
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
    
    
    public static function flowParser()
    {
        
    }
}















