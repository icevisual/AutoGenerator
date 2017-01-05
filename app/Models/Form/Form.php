<?php
namespace App\Models\Form;

use App\Models\BaseModel;

class Form extends BaseModel
{

    protected $table = 'form';

    public $timestamps = true;

    public $guarded = [];

    protected $createSql = "
DROP TABLE IF EXISTS `op_form`;
CREATE TABLE `op_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_name` varchar(80) NOT NULL COMMENT '表单名称',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='表单表'
        ";
    



    public static function formDetail($id){
        
        $separator = '#E#';
        
        $form = self::find($id);
        $form = $form->toArray();
        $prefix = \DB::getTablePrefix();
        
        $handler = self::select([
            'component.id',
            'component.component_name AS componentName',
            'component.component_desc AS componentDesc',
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.id,'{$separator}') AS attr_id"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.attr_name,'{$separator}') AS attr_name"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.attr_name_cn,'{$separator}') AS attr_name_cn"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.attr_type,'{$separator}') AS attr_type"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}attrs.form_type,'{$separator}') AS form_type"),
            \DB::raw("GROUP_CONCAT('{$separator}',{$prefix}form_component.attr_value,'{$separator}') AS default_value"),
        ])
        ->join('form_component','form_component.form_id','=','form.id')
        ->join('component','form_component.component_id','=','component.id')
        ->join('attrs','form_component.attr_id','=','attrs.id')
        ->where('form_component.form_id',$id)
        ->groupBy('component.id');
        $paginate = $handler->get();
        $list = [];
        $list['data'] = $paginate->toArray();
        
        foreach ($list['data'] as $k => $v){
            $attrs = [
                'attr_id' => groupConcatToArray($v['attr_id'],$separator),
                'attr_name' => groupConcatToArray($v['attr_name'],$separator),
                'attr_name_cn' => groupConcatToArray($v['attr_name_cn'],$separator),
                'default_value' => groupConcatToArray($v['default_value'],$separator),
                'attr_type' => groupConcatToArray($v['attr_type'],$separator),
                'form_type' => groupConcatToArray($v['form_type'],$separator),
            ];
            $at = [];
            foreach ($attrs['attr_id'] as $k1 => $v1){
                $at[$attrs['attr_name'][$k1]] = [
                    'attrId' => $attrs['attr_id'][$k1],
                    'attrName' => $attrs['attr_name'][$k1],
                    'attrNameCn' => $attrs['attr_name_cn'][$k1],
                    'defaultValue' => $attrs['default_value'][$k1],
                    'attrType' => $attrs['attr_type'][$k1],
                    'formType' => $attrs['form_type'][$k1],
                ];
            }
            $list['data'][$k]['attrs'] = $at;
            unset($list['data'][$k]['attr_id']);
            unset($list['data'][$k]['attr_name']);
            unset($list['data'][$k]['attr_name_cn']);
            unset($list['data'][$k]['default_value']);
            unset($list['data'][$k]['attr_type']);
            unset($list['data'][$k]['form_type']);
        }
        return  [
            'form' => $form,
            'components' => $list['data']
        ];
    }
    
    
    public static function queryForms($search = [],$page = 1,$pageSize = 10,$order = []){
        $handler = self::select([
            'form.id',
            'form.name',
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
    
    

    public static function createForm($name,$data)
    {
        $formData = [
            'name' => $name,
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