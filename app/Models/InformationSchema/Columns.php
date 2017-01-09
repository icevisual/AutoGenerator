<?php
namespace App\Models\InformationSchema;

use App\Models\BaseModel;

class Columns extends BaseModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'information_schema';
    
    protected $table = 'COLUMNS';
    
    public $timestamps = false;
    
    public $guarded = [];
    
    public static function queryTableColumns($TABLE_NAME){
        $TABLE_SCHEMA = \Config::get('database.connections.mysql.database');
        $handler = self::select([
//             'COLUMNS.ORDINAL_POSITION',
            'COLUMNS.COLUMN_NAME',
            'COLUMNS.COLUMN_COMMENT',
            \DB::raw("IFNULL(COLUMNS.COLUMN_DEFAULT,'NULL')"),
            'COLUMNS.IS_NULLABLE',
//             'COLUMNS.DATA_TYPE',
            'COLUMNS.COLUMN_TYPE',
            \DB::raw("'' AS validate"),
//             'COLUMNS.CHARACTER_MAXIMUM_LENGTH',
//             'COLUMNS.NUMERIC_PRECISION',
//             'COLUMNS.NUMERIC_SCALE',
//             'COLUMNS.CHARACTER_SET_NAME',
//             'COLUMNS.COLLATION_NAME',
            
        ])->where('COLUMNS.TABLE_SCHEMA',$TABLE_SCHEMA)
          ->where('COLUMNS.TABLE_NAME',$TABLE_NAME);
        $paginate = $handler->get();
        $list = $paginate->toArray();
        return $list;
    }
    

}