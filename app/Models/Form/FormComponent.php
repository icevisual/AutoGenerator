<?php
namespace App\Models\Form;

use App\Models\BaseModel;

class FormComponent extends BaseModel
{

    protected $table = 'form_component';

    public $timestamps = false;

    public $guarded = [];

    protected $createSql = "
DROP TABLE IF EXISTS `op_form_component`;
CREATE TABLE `op_form_component` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL COMMENT '表单ID',
  `component_id` int(11) NOT NULL COMMENT '组件ID',
  `attr_id` varchar(80) NOT NULL COMMENT '属性ID',
  `attr_value` varchar(80) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组件实例表'
        ";

    /**
     * <pre>
     * 'form_id' => $data['form_id'], // 组件ID
            'component_id' => $data['component_id'], // 组件ID
            'attr_id' => $data['attr_id'], // 属性ID
            'attr_value' => $data['attr_value'] // 属性默认值
            </pre>
     * @param unknown $data
     * @return \Illuminate\Database\Eloquent\static
     */
    public static function addRecord($data)
    {
        return self::create([
            'form_id' => $data['form_id'], // 组件ID
            'component_id' => $data['component_id'], // 组件ID
            'attr_id' => $data['attr_id'], // 属性ID
            'attr_value' => $data['attr_value'] // 属性默认值
        ]);
    }
    
}