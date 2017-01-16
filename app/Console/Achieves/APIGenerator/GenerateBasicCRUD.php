<?php

namespace App\Console\Achieves\APIGenerator;

use Illuminate\Database\Schema\Blueprint;
use App\Models\System\Tables;

class GenerateBasicCRUD {
    
    
    public static function makeModel($id){
        $dist = app_path('Models/Auto');
        
        $table = Tables::find($id);
        
        $modelName = $table['TABLE_NAME'];
        
        $modelNameCamel = ucfirst(camel_case($modelName));
        
        $template =<<<EOL
<?php
namespace App\Models\Auto;

use App\Models\BaseModel;

class {$modelNameCamel} extends BaseModel
{
    protected \$table = '{$modelName}';
    
    public \$timestamps = false;
    
    public \$guarded = [];   
            
}     
EOL;
        
        dump($template);
        
    }
    
    
    public static function run(){
        
        
        
        self::makeModel(5);
        
        //
//         \Schema::table('columns',function(Blueprint $table){
//             $table->dropColumn('DDDD');
//         });
        
//         \Schema::table('columns',function(Blueprint $table){
//             $table->tinyInteger('IS_INPUT')->default(1)->comment('是否从接口输入获取，1否，2是')->after('IS_NULLABLE');
//         });
        
        
        
    }
    
    
    
    
    
    
    
}