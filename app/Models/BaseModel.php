<?php
namespace App\Models;

class BaseModel extends \Eloquent
{
    public static function analysisSimpleCreate($cfg,$params)
    {
        $config = [
            'symbol' => 'simpleCreate',
            'model' => 'App\Models\Form\Attrs',
            'parameters' => [
                'data'
            ],
            'createFields' => [
                'attr_name',
                'attr_name_cn',
                'default_value',
                'attr_type',
                'form_type'
            ],
            'fieldsMap' => [
                'default_value' => 'data.attr_value',
            ],
            'return' => 'object'
        ];
        
        // 1. 确定保存字段，createFields 和 fieldsMap 字段的 并集就是所有的字段
        
        $createFields = array_get($config, 'createFields',[]);
        $fieldsMap = array_get($config, 'fieldsMap',[]);
        $fields = array_keys(array_flip($createFields) + array_flip(array_keys($fieldsMap)));
        // 2. 给保存字段设置对应的值
        
        $createParams = [];
        foreach ($fields as $k){
            if(isset($fieldsMap[$k])){
                $createParams[$k] = array_get($params, $fieldsMap[$k]);
            }else{
                $createParams[$k] = array_get($params, 'data.'.$k);
            }
        }
        
        // 2. 调起保存方法
        $ReflectionMethod = new \ReflectionMethod($config['model'].'::create');
        $ret = $ReflectionMethod->invoke(new $config['model'],$createParams);
        return $ret;
    }
}