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

}