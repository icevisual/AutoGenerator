<?php
namespace App\Console\Achieves\ConfigParser;

class SimpleCreate
{

    /**
     *
     * @param unknown $cfg
     *            <pre>
     *            {
     *            'symbol' : 'simpleCreate',
     *            'parameters' : ['data'],
     *            'createFields' : [
     *            'attr_type',
     *            'form_type'
     *            ],
     *            'fieldsMap' : {
     *            'form_type' : 'data.form_type'
     *            },
     *            'return' : 'array|object'
     *            }</pre>
     * @param unknown $params            
     * @return Ambigous <multitype:, boolean>|multitype:mixed |mixed
     */
    public static function analysisSimpleCreate($cfg, $params)
    {
        $config = [
            'symbol' => 'simpleCreate',
            'model' => 'App\Models\Form\Attrs',
            'parameters' => [
                'data'
            ],
            'createFields' => [
                'attr_name',
                'attr_type',
                'form_type'
            ],
            'fieldsMap' => [
                'default_value' => 'data.attr_value',
            ],
            'return' => 'array|object'
        ];
        
        $ret = runCustomValidator([
            'data' => [
                'symbol', // 唯一标识了一个解析模板
                'model', // 指明 model 的class
                'parameters', // 指明了保存的参数，默认 为 data 数组
                'createFields', // 指明了新建所需的字段
                'fieldsMap', // 指明了新建数据的字段和取值，取值 Get an item from an array using "dot" notation.
                'return'
            ] // 指明返回值，默认为整个新建的对象 array|object ['id']
, // 数据
            'data' => $cfg,
            'rules' => [
                'symbol' => 'required',
                'model' => 'required',
                'parameters' => 'array',
                'createFields' => 'required_without:fieldsMap',
                'fieldsMap' => 'required_without:createFields'
            ]
            // 'return',
            , // 条件
            'config' => [
                'ReturnOrException' => 0, // Return (0) Or Exception(1)
                'FirstOrAll' => 1
            ]
        ]);
        
        if (true !== $ret) {
            return $ret;
        }
        
        $config = $cfg;
        // TODO 0. Validate,save config
        // 1. 确定保存字段，createFields 和 fieldsMap 字段的 并集就是所有的字段
        
        $createFields = array_get($config, 'createFields', []);
        $fieldsMap = array_get($config, 'fieldsMap', []);
        $fields = array_keys(array_flip($createFields) + array_flip(array_keys($fieldsMap)));
        // 2. 给保存字段设置对应的值
        
        $createParams = [];
        foreach ($fields as $k) {
            if (isset($fieldsMap[$k])) {
                $createParams[$k] = array_get($params, $fieldsMap[$k]);
            } else {
                $createParams[$k] = array_get($params, 'data.' . $k);
            }
        }
        
        // 2. 调起保存方法
        $ReflectionMethod = new \ReflectionMethod($config['model'] . '::create');
        $ret = $ReflectionMethod->invoke(new $config['model'](), $createParams);
        
        // 3. 处理 返回
        $return = array_get($config, 'return', 'array');
        if (is_array($return)) {
            $retArray = [];
            foreach ($return as $v) {
                $v = $v . '';
                if (isset($ret[$v])) {
                    $retArray[$v] = $ret[$v];
                }
            }
            return $retArray;
        } else {
            if ('array' == strtolower($return)) {
                return $ret->toArray();
            } else {
                return $ret;
            }
        }
        return $ret;
    }
}















