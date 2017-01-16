<?php
namespace App\Models\AutoMake\Auto;

use App\Models\BaseModel;

class Form extends BaseModel
{
    protected $connection = 'auto';

    protected $table = 'form';
    
    public $timestamps = false;
    
    public $guarded = [];   
    
    public static function createRecord($data){
        
    }
    
    public static function updateRecord($data){
        $updateData = [
            'TABLE_NAME' => $data['table_name'],
            'TABLE_COMMENT' => $data['table_comment'],
            'CONNECTION' => $data['connection'],
        ];
        $table = self::where('id',$data['id'])->update($updateData);
        return $table;
    }
    
    public static function queryRecords($search = [],$page = 1,$pageSize = 1000,$order = []){
    
        $handler = self::select([
            'tables.id',
            'tables.TABLE_NAME',
            'tables.TABLE_COMMENT',
            'tables.CONNECTION',
        ]);;
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