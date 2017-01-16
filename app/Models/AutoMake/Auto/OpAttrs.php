<?php
namespace App\Models\AutoMake\Auto;

use App\Models\BaseModel;

class OpAttrs extends BaseModel
{
    protected $connection = 'auto';

    protected $table = 'op_attrs';
    
    public $timestamps = false;
    
    public $guarded = [];   
}