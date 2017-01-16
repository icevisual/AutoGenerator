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
            'CONNECTION' => $data['connection'],
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
            'id' =>  $table['id'],
            'table_name' => $table['TABLE_NAME'],
            'table_comment' => $table['TABLE_COMMENT'],
            'connection' => $table['CONNECTION'],
            'columns' => $columns
        ];
        return $detail;
    }
    

    public static function queryTables($search = [],$page = 1,$pageSize = 1000,$order = []){
    
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
    
    public static function updateTable($data){
        $updateData = [
            'TABLE_NAME' => $data['table_name'],
            'TABLE_COMMENT' => $data['table_comment'],
            'CONNECTION' => $data['connection'],
        ];
        \DB::beginTransaction();
        $table = self::where('id',$data['id'])->update($updateData);
        Columns::where('TABLE_ID',$data['id'])->delete();
        foreach ($data['columns'] as $v){
            $v['TABLE_ID'] = $data['id'];
            Columns::create($v);
        }
        \DB::commit();
        return $table;
    }
    
}



