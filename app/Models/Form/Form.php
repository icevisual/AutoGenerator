<?php
namespace App\Models\Form;

use App\Models\BaseModel;

class Form extends BaseModel
{

    protected $table = 'form';

    public $timestamps = false;

    public $guarded = [];

    protected $createSql = "
DROP TABLE IF EXISTS `op_form`;
CREATE TABLE `op_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL COMMENT '表单ID',
  `form_name` varchar(80) NOT NULL COMMENT '表单名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='表单表'
        ";

    public static function createForm($data)
    {
        $formData = [
            'form_name' => str_random(20),
        ];
        \DB::beginTransaction();
        $form = self::create($formData);
        foreach ($data as $v){
            foreach ($v['attrs'] as $v1){
                FormComponent::addRecord([
                    'form_id' => $form['id'], // 组件ID
                    'component_id' => $v['id'], // 组件ID
                    'attr_id' => $v1['attrId'], // 属性ID
                    'attr_value' => $v1['defaultValue'] // 属性默认值
                ]);
            }
        }
        \DB::commit();
        return $form;
    }
    
}