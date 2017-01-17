<?php
namespace App\Models\AutoMake\Auto;

use App\Models\BaseModel;

class Attrs extends BaseModel
{
    protected $connection = 'auto';

    protected $table = 'attrs';
    
    public $timestamps = false;
    
    public $guarded = [];    
    
    public static function createRecord($data){
        $createData = [
            'attr_name' => array_get($data, 'attr_name'),
            'attr_name_cn' => array_get($data, 'attr_name_cn'),
            'attr_type' => array_get($data, 'attr_type','string'),
            'form_type' => array_get($data, 'form_type','input'),
        ];
        return self::create($createData);
    }
    
    public static function updateRecord($data){
        $updateData = [
            'attr_name' => array_get($data, 'attr_name'),
            'attr_name_cn' => array_get($data, 'attr_name_cn'),
            'attr_type' => array_get($data, 'attr_type','string'),
            'form_type' => array_get($data, 'form_type','input'),
        ];
        $table = self::where('id',$data['id'])->update($updateData);
        return $table;
    }
    
    public static function queryRecords($search = [],$page = 1,$pageSize = 1000,$order = []){

        $handler = self::select([
            'attrs.attr_name',
            'attrs.attr_name_cn',
            'attrs.attr_type',
            'attrs.form_type',
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
    
    public static function recordDelete($id){
        return self::where('id',$id)->delete();
    }
    
    public static function recordDetail($id){
        return self::where('id',$id)->first();
    }
}