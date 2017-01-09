<?php
namespace App\Models\InformationSchema;

use App\Models\BaseModel;

class Tables extends BaseModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'information_schema';
    
    protected $table = 'TABLES';
    
    public $timestamps = false;
    
    public $guarded = [];

    
    public static function getTableName($id){
        $ret = \DB::select('select * from op_tables where id = ? ',[$id]);
        return $ret[0]->TABLE_NAME;
    }

        
    
    public static function queryTables($search = [],$page = 1,$pageSize = 1000,$order = []){
        
        $TABLE_SCHEMA = \Config::get('database.connections.mysql.database');
        
        $handler = self::select([
            'op_tables.id',
            'TABLES.TABLE_NAME',
            'TABLES.TABLE_COMMENT',
            'TABLES.TABLE_ROWS',
            'TABLES.DATA_LENGTH',
            'TABLES.AUTO_INCREMENT',
//             'TABLES.TABLE_COLLATION'
        ])
        ->join($TABLE_SCHEMA.'.op_tables','op_tables.TABLE_NAME','=','TABLES.TABLE_NAME')
        ->where('TABLES.TABLE_SCHEMA',$TABLE_SCHEMA);
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