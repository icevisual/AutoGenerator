<?php
namespace App\Models\System;

use App\Models\BaseModel;

class Columns extends BaseModel
{
    protected $table = 'columns';
    
    public $timestamps = false;
    
    public $guarded = [];
    
    
    public static function queryTableColumns($table_id){
        return self::where('TABLE_ID',$table_id)->get()->toArray();
    }

    public static function createNewColumn($data){
    
        $tableData = [
            'TABLE_NAME' => $data['table_name'],
            'TABLE_COMMENT' => $data['table_comment'],
        ];
        \DB::beginTransaction();
        $table = self::create($tableData);
        foreach ($data['columns'] as $v){
            
        }
        \DB::commit();
    }
    
}



