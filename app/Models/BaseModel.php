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
        
        $fields = array_get($config, 'createFields',[]);
        
        
        
        
        $data = $params[0];
        $createParams = array_only($data, $config['createFields']);
        $ReflectionMethod = new \ReflectionMethod($config['model'].'::create');
        $ret = $ReflectionMethod->invoke(new $config['model'],$createParams);
        return $ret;
    }
}