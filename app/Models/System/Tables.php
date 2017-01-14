<?php
namespace App\Models\System;

use App\Models\BaseModel;


class Tables extends BaseModel
{
    protected $table = 'tables';
    
    public $timestamps = false;
    
    public $guarded = [];

    public static function getTableName($id){
        
        $table = self::find($id);
        
        return $table['TABLE_NAME'];
    }
    
    public static function createNewTable($data){
        $tableData = [
            'TABLE_NAME' => $data['table_name'],
            'TABLE_COMMENT' => $data['table_comment'],
        ];
        \DB::beginTransaction();
        $table = self::create($tableData);
        foreach ($data['columns'] as $v){
            $v['TABLE_ID'] = $table['id'];
            Columns::create($v);
        }
        \DB::commit();
        return $table;
    }
    
    public static function tableDetail($id){
        $table = self::where('id',$id)->first();
        $columns = Columns::where('TABLE_ID',$id)->get()->toArray();
        $detail = [
            'table_name' => $table['TABLE_NAME'],
            'table_comment' => $table['TABLE_COMMENT'],
            'columns' => $columns
        ];
        return $detail;
    }
    
    public static function updateTable(){
    
    }
    
}



