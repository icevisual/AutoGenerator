<?php
namespace App\Models\Form;

use App\Models\BaseModel;

class ComponentAttrs extends BaseModel
{

    protected $table = 'component_attrs';

    public $timestamps = false;

    public $guarded = [];

    protected $createSql = "
DROP TABLE IF EXISTS `op_component_attrs`;
CREATE TABLE `op_component_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL COMMENT '组件ID',
  `attr_id` int(11) NOT NULL COMMENT '属性ID',
  `default_value` varchar(80) DEFAULT NULL COMMENT '属性默认值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组件属性表';
        ";

    public static function addRecord($data)
    {
        return self::create([
            'component_id' => $data['component_id'], // 组件ID
            'attr_id' => $data['attr_id'], // 属性ID
//             'default_value' => $data['default_value'] // 属性默认值
        ]);
    }
    
    
    public static function getComponentAttrs($id)
    {
        return self::select([
            'attrs.id',
            'attrs.attr_name',
//             'attrs.attr_value',
            'attrs.attr_type',
            'attrs.form_type',
//             'component_attrs.default_value',
        ])->join('attrs','attrs.id','=','component_attrs.attr_id')
        ->where('component_attrs.component_id',$id)
        ->get()
        ->toArray();
    }
    
    
    

}