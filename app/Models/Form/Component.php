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
    
}