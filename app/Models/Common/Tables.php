<?php
namespace App\Models\Common;

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

}



