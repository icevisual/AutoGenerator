<?php

namespace App\Models\Form;

use App\Models\BaseModel;

class Attrs extends BaseModel
{
    protected $table = 'attrs';
    
    public $timestamps = false;
    
    public $guarded = [];
    
    protected $createSql = "
DROP TABLE IF EXISTS `op_attrs`;
CREATE TABLE `op_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name_cn` varchar(80) NOT NULL COMMENT '属性名字',
  `attr_name_en` varchar(80) NOT NULL COMMENT '属性名字',
  `attr_type` varchar(80) NOT NULL COMMENT '属性类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组件属性表';
        ";
    
    
    public static function createNewAttr($data){
        return self::create($data);
    }
    
    public static function queryAttrs($search = [],$page = 1,$pageSize = 10,$order = []){
        $handler = self::select([
            'attrs.id',
            'attrs.attr_name_cn',
            'attrs.attr_name_en',
            'attrs.attr_type' 
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