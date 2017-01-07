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

    public static function queryTables($search = [],$page = 1,$pageSize = 1000,$order = []){
        
        $TABLE_SCHEMA = \Config::get('database.connections.mysql.database');
        
        $handler = self::select([
            'TABLES.TABLE_NAME',
            'TABLES.TABLE_COMMENT',
            'TABLES.TABLE_ROWS',
            'TABLES.DATA_LENGTH',
            'TABLES.AUTO_INCREMENT',
//             'TABLES.TABLE_COLLATION'
        ])->where('TABLE_SCHEMA',$TABLE_SCHEMA);
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