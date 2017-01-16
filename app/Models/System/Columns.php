<?php
namespace App\Models\System;

use App\Models\BaseModel;

class Columns extends BaseModel
{
    protected $table = 'columns';
    
    public $timestamps = false;
    
    public $guarded = [];
    
    const IS_INPUT_YES = 2;
    const IS_INPUT_NO = 1;
    
    public static function queryColumnsConfig($id){
        return self::select([
            'columns.COLUMN_NAME',
            'columns.COLUMN_NAME_CN',
            'columns.COLUMN_DEFAULT',
            'columns.IS_NULLABLE',
            'columns.IS_INPUT',
            'columns.DATA_TYPE',
            'columns.COLUMN_VALIDATE',
        ])->where('TABLE_ID',$id)
          ->get()
          ->toArray();
    }
    
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



