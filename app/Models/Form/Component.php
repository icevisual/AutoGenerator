<?php

namespace App\Models\Form;

use App\Models\BaseModel;

class Component extends BaseModel
{
    protected $table = 'component';
    
    public $timestamps = false;
    
    public $guarded = [];
    
    protected $createSql = "
DROP TABLE IF EXISTS `op_component`;
CREATE TABLE `op_component` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `component_name` varchar(80) NOT NULL COMMENT '组件名称',
  `component_desc` varchar(255) NOT NULL COMMENT '组件描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组件表';
        ";

    public static function updateComponent($data){
        \DB::beginTransaction();
        self::where('id',$data['id'])->update([
            'component_name' => $data['component_name'],
            'component_desc' => $data['component_desc']
        ]);
        ComponentAttrs::where('component_id',$data['id'])->delete();
        foreach ($data['attrs'] as $v){
            ComponentAttrs::addRecord([
                'component_id' => $data['id'],//组件ID
                'attr_id' => $v['id'],//属性ID
                'default_value' => $v['default_value'],//属性默认值
            ]);
        }
        \DB::commit();
        return true;
    }
    
    
    public static function createNewComponent($data){
        \DB::beginTransaction();
        $component = self::create([
            'component_name' => $data['component_name'],
            'component_desc' => $data['component_desc']
        ]);
        foreach ($data['attrs'] as $v){
            ComponentAttrs::addRecord([
                'component_id' => $component['id'],//组件ID
                'attr_id' => $v['id'],//属性ID
                'default_value' => $v['default_value'],//属性默认值
            ]);
        }
        \DB::commit();
        return $component;
    }
    
    public static function componentDetail($id){
        $component = self::find($id);
        return [
            'component' => $component->toArray(),
            'attrs' => ComponentAttrs::getComponentAttrs($id)
        ] ;
    }
    
    
    public static function queryComponent($search = [],$page = 1,$pageSize = 10,$order = []){
        $handler = self::select([
            'component.id',
            'component.component_name',
            'component.component_desc',
        ]);
        $paginate = $handler->paginate($pageSize, [
            '*'
        ], 'p', $page);
        $list = $paginate->toArray();
        
        $data = [
            'total' => $list['total'],
            'current_page' => $list['current_page'],
            'last_page' => $list['last_page'],
            'per_page' => $list['per_page'],
            'list' => $list['data']
        ];
        return $data;
    }
    
    public static function queryComponentsWithDetail($search = [],$page = 1,$pageSize = 10,$order = []){
        
        $separator = '#E#';
        
        $prefix = \DB::getTablePrefix();
        
        $handler = self::select([
            'component.id',
            'component.component_name',
            'component.component_desc',
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.id,'{$separator}') AS attr_id"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.attr_name_cn,'{$separator}') AS attr_name_cn"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.attr_name_en,'{$separator}') AS attr_name_en"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.attr_type,'{$separator}') AS attr_type"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}component_attrs.default_value,'{$separator}') AS default_value"),
//             'attrs.attr_name_cn',
//             'attrs.attr_name_en',
//             'attrs.attr_type',
        ])->join('component_attrs','component_attrs.component_id','=','component.id')
        ->join('attrs','component_attrs.attr_id','=','attrs.id')
        ->groupBy('component.id');
        $paginate = $handler->paginate($pageSize, [
            '*'
        ], 'p', $page);
        $list = $paginate->toArray();
        
        foreach ($list['data'] as $k => $v){
            
            $attrs = [
                'attr_id' => groupConcatToArray($v['attr_id'],$separator),
                'attr_name_cn' => groupConcatToArray($v['attr_name_cn'],$separator),
                'attr_name_en' => groupConcatToArray($v['attr_name_en'],$separator),
                'attr_type' => groupConcatToArray($v['attr_type'],$separator),
                'default_value' => groupConcatToArray($v['default_value'],$separator),
            ];
            $at = [];
            foreach ($attrs['attr_id'] as $k1 => $v1){
                $at[] = [
                    'attr_id' => $attrs['attr_id'][$k1],
                    'attr_name_cn' => $attrs['attr_name_cn'][$k1],
                    'attr_name_en' => $attrs['attr_name_en'][$k1],
                    'attr_type' => $attrs['attr_type'][$k1],
                    'default_value' => $attrs['default_value'][$k1],
                ];
            }
            $list['data'][$k]['attrs'] = $at;
            unset($list['data'][$k]['attr_id']);
            unset($list['data'][$k]['attr_name_cn']);
            unset($list['data'][$k]['attr_name_en']);
            unset($list['data'][$k]['attr_type']);
            unset($list['data'][$k]['default_value']);
        }
        
        $data = [
            'total' => $list['total'],
            'current_page' => $list['current_page'],
            'last_page' => $list['last_page'],
            'per_page' => $list['per_page'],
            'list' => $list['data']
        ];
        return $data;
    }
    
    
    
    
}