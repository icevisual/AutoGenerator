<?php
namespace App\Console\Achieves\APIGenerator;

use Illuminate\Database\Schema\Blueprint;
use App\Models\System\Tables;
use App\Models\System\Columns;
use App\Console\Achieves\Common\TestRouteGener;

class GenerateBasicCRUD
{

    protected function convertCamelName($name)
    {
        return ucfirst(camel_case($name));
    }

    protected function convertModelData($columnConfig)
    {
        $_inputMap = [];
        $tabPlaceholder = '    ';
        $linePrefix = str_repeat($tabPlaceholder, 3);
        foreach ($columnConfig as $v) {
            if ($v['IS_INPUT'] == Columns::IS_INPUT_YES) {
                // TODO Parse DATA_TYPE
                if ($v['COLUMN_DEFAULT'] && 'NULL' != $v['COLUMN_DEFAULT']) {
                    $_inputMap[] = $linePrefix . "'{$v['COLUMN_NAME']}' => array_get(\$data, '{$v['COLUMN_NAME']}','{$v['COLUMN_DEFAULT']}')," . PHP_EOL;
                } else {
                    $_inputMap[] = $linePrefix . "'{$v['COLUMN_NAME']}' => array_get(\$data, '{$v['COLUMN_NAME']}')," . PHP_EOL;
                }
                // TODO Parse default value
            }
        }
        $ret = implode('', $_inputMap);
        return substr($ret, 0, 0 - strlen(PHP_EOL));
    }

    protected function convertQueryColumns($table, $columnConfig)
    {
        $_inputMap = [];
        $tabPlaceholder = '    ';
        $linePrefix = str_repeat($tabPlaceholder, 3);
        foreach ($columnConfig as $v) {
            if ($v['IS_INPUT'] == Columns::IS_INPUT_YES) {
                $_inputMap[] = $linePrefix . "'{$table['TABLE_NAME']}.{$v['COLUMN_NAME']}'," . PHP_EOL;
            }
        }
        $ret = implode('', $_inputMap);
        return substr($ret, 0, 0 - strlen(PHP_EOL));
    }

    protected function convertArrayOutput($data)
    {
        ob_start();
        echoArrayKV($data);
        $output = ob_get_clean();
        $ret = '';
        $tabPlaceholder = '    ';
        foreach (explode(PHP_EOL, $output) as $key => $line) {
            if ($line) {
                $line = str_replace("\t", $tabPlaceholder, $line);
                if ($key > 0) {
                    $ret .= $tabPlaceholder . $line . PHP_EOL;
                } else {
                    $ret .= $line . PHP_EOL;
                }
            }
        }
        return $ret;
    }

    protected function convertInputMap($columnConfig)
    {
        $_inputMap = [];
        $tabPlaceholder = '    ';
        $linePrefix = str_repeat($tabPlaceholder, 3);
        foreach ($columnConfig as $v) {
            if ($v['IS_INPUT'] == Columns::IS_INPUT_YES) {
                // TODO Parse DATA_TYPE
                if ($v['COLUMN_DEFAULT'] && 'NULL' != $v['COLUMN_DEFAULT']) {
                    $_inputMap[] = $linePrefix . "'{$v['COLUMN_NAME']}' => \Input::get('{$v['COLUMN_NAME']}','{$v['COLUMN_DEFAULT']}'), // {$v['DATA_TYPE']} {$v['COLUMN_NAME_CN']}" . PHP_EOL;
                } else {
                    $_inputMap[] = $linePrefix . "'{$v['COLUMN_NAME']}' => \Input::get('{$v['COLUMN_NAME']}'), // {$v['DATA_TYPE']} {$v['COLUMN_NAME_CN']}" . PHP_EOL;
                }
                // TODO Parse default value
            }
        }
        $ret = implode('', $_inputMap);
        return substr($ret, 0, 0 - strlen(PHP_EOL));
    }

    protected function ruleAddConnect($rule,$connection,$needle = 'exists')
    {
        $needle = trim($needle,':').':';
        $haystack = $rule;
        if (($pos = strpos($haystack, $needle)) !== false) {
            $rest = substr($haystack, $pos + strlen($needle));
            
            $ruleConfig = explode('|', $rest,2);
            $ruleConfig = $ruleConfig[0];
            
            $arimTable = explode(',', $ruleConfig,2);
            $arimTable = $arimTable[0];
            
            if(strpos($arimTable, '.') === false){
                return substr($haystack, 0,$pos).$needle.$connection.'.'.$rest;
            }
        }
        return $rule;
    }

    protected function convertValidateConfig($columnConfig, $table)
    {
        $_customValidateConfig = [];
        
        $_customValidateConfig = [
            'rules' => [
                'id' => 'required|exists:' . $table['CONNECTION'] . '.' . $table['TABLE_NAME']
            ], // 条件
            'attributes' => []
        ];
        
        foreach ($columnConfig as $v) {
            if ($v['IS_INPUT'] == Columns::IS_INPUT_YES) {
                $_customValidateConfig['rules'][$v['COLUMN_NAME']] = $this->ruleAddConnect($v['COLUMN_VALIDATE'], $table['CONNECTION']);
//                 $_customValidateConfig['rules'][$v['COLUMN_NAME']] = $v['COLUMN_VALIDATE'];
                $_customValidateConfig['attributes'][$v['COLUMN_NAME']] = $v['COLUMN_NAME_CN'];
            }
        }
        $str = $this->convertArrayOutput($_customValidateConfig);
        return $str;
    }

    public function makeModel($table, $columnConfig)
    {
        $config = \Config::get('database.connections');
        
        $modelNameCamel = $this->convertCamelName($table['TABLE_NAME']);
        
        $connectionNameCamel = $this->convertCamelName($table['CONNECTION']);
        
        $dist = app_path('Models/AutoMake/' . $connectionNameCamel);
        
        if (! file_exists($dist)) {
            @mkdir($dist);
        }
        
        $distFile = $dist . '/' . $modelNameCamel . '.php';
        
        $modelData = $this->convertModelData($columnConfig);
        
        $queryColumns = $this->convertQueryColumns($table, $columnConfig);
        
        $template = <<<EOL
<?php
namespace App\Models\AutoMake\\{$connectionNameCamel};

use App\Models\BaseModel;

class {$modelNameCamel} extends BaseModel
{
    protected \$connection = '{$table['CONNECTION']}';

    protected \$table = '{$table['TABLE_NAME']}';
    
    public \$timestamps = false;
    
    public \$guarded = [];    
    
    public static function createRecord(\$data){
        \$createData = [
$modelData
        ];
        return self::create(\$createData);
    }
    
    public static function updateRecord(\$data){
        \$updateData = [
$modelData
        ];
        \$table = self::where('id',\$data['id'])->update(\$updateData);
        return \$table;
    }
    
    public static function queryRecords(\$search = [],\$page = 1,\$pageSize = 1000,\$order = []){

        \$handler = self::select([
$queryColumns
        ]);
        \$paginate = \$handler->paginate(\$pageSize, [
            '*'
        ], 'p', \$page);
        \$list = \$paginate->toArray();
    
        \$data = [
            'total' => \$list['total'],
            'current_page' => \$list['current_page'],
            'last_page' => \$list['last_page'],
            'per_page' => \$list['per_page'],
            'list' => \$list['data']
        ];
        return \$data;
    }
    
    public static function recordDelete(\$id){
        return self::where('id',\$id)->delete();
    }
    
    public static function recordDetail(\$id){
        return self::where('id',\$id)->first();
    }
}
EOL;
        file_put_contents($distFile, $template);
        
        return [
            'namespace' => "App\Models\AutoMake\\{$connectionNameCamel}",
            'class' => $modelNameCamel
        ];
    }

    public function makeController($_table, $_columnConfig, $_model)
    {
        $_customValidateConfig = $this->convertValidateConfig($_columnConfig, $_table);
        
        $_inputMap = $this->convertInputMap($_columnConfig);
        
        $_modelFullClass = $_model['namespace'] . '/' . $_model['class'];
        
        $_modelFullClass = trim($_modelFullClass, '\\');
        
        $_modelFullClass = str_replace('/', '\\', $_modelFullClass);
        
        $_controllerName = $this->convertCamelName($_table['TABLE_NAME']);
        
        $dist = app_path('Http/Controllers/AutoMake/' . $_controllerName . 'Controller.php');
        
        // TODO 生成 APIDoc 注释
        $template = <<<EOL
<?php
namespace App\Http\Controllers\AutoMake;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use $_modelFullClass;

class {$_controllerName}Controller extends Controller
{
    protected \$_customValidateConfig = $_customValidateConfig

    public function create()
    {
        \$data = [
$_inputMap
        ]; 
        \$config = \$this->getValidateCondition('create');
        \$config['data'] = \$data;
        runCustomValidator(\$config); // 属性名映射
        \$obj = {$_model['class']}::createRecord(\$data);
        return \$this->__json(\$obj);
    }

    public function query()
    {
        \$page = \Input::get('p', 1); // 页数
        \$pageSize = \Input::get('n', 10); // 每页条数
        \$data = {$_model['class']}::queryRecords([], \$page, \$pageSize);
        return \$this->__json(\$data);
    }

    public function update(\$id)
    {
        \$data = [
            'id' => \$id,
$_inputMap
        ];
        
        \$config = \$this->getValidateCondition('update', [
            'id' => \$data['id']
        ]);
        \$config['data'] = \$data;
        runCustomValidator(\$config); // 属性名映射
        \$obj = {$_model['class']}::updateRecord(\$data);
        return \$this->__json();
    }

    public function detail(\$id)
    {
        \$detail = {$_model['class']}::recordDetail(\$id);
        return \$this->__json(\$detail);
    }

    public function delete(\$id)
    {
        {$_model['class']}::recordDelete(\$id);
        return \$this->__json();
    }
}
EOL;
        file_put_contents($dist, $template);
        return [
            'namespace' => "App\Http\Controllers\AutoMake",
            'class' => "{$_controllerName}Controller"
        ];
    }

    protected $_customValidateConfig = [
        'rules' => [
            'id' => 'required|exists:tables',
            'table_name' => 'required|regex:/^[a-zA-Z][\d\w\_]*$/i|unique:tables,table_name',
            'table_comment' => 'required'
        ], // 条件
        'attributes' => [
            'table_name' => '表名',
            'table_comment' => '表备注'
        ]
    ];

    public function makeRoute($_table, $_controller)
    {
        $tableName = $_table['TABLE_NAME'];
        $controllerClass = $_controller['class'];
        $dist = app_path('Routes/AutoMake/' . $tableName . '.php');
        $template = <<<EOL
<?php


Route::get('/{$tableName}', [
    'as' => 'api_auto_{$tableName}_query',
    'uses' => 'AutoMake\\{$controllerClass}@query'
]);
Route::post('/{$tableName}', [
    'as' => 'api_auto_{$tableName}_create',
    'uses' => 'AutoMake\\{$controllerClass}@create'
]);
Route::get('/{$tableName}/{id}', [
    'as' => 'api_auto_{$tableName}_detail',
    'uses' => 'AutoMake\\{$controllerClass}@detail'
]);
Route::put('/{$tableName}/{id}', [
    'as' => 'api_auto_{$tableName}_update',
    'uses' => 'AutoMake\\{$controllerClass}@update'
]);
Route::delete('/{$tableName}/{id}', [
    'as' => 'api_auto_{$tableName}_delete',
    'uses' => 'AutoMake\\{$controllerClass}@delete'
]);
EOL;
        
        file_put_contents($dist, $template);
    }

    protected function convertDefault($defaultValue)
    {
        if ('NULL' == $defaultValue) {
            return NULL;
        }
        return $defaultValue;
    }

    public function makeTable($_table, $_columnConfig)
    {
        $Builder = \Schema::connection($_table['CONNECTION']);
        $map = [
            'bigint' => 'bigInteger',
            'char' => 'char',
            'date' => 'date',
            'datetime' => 'dateTime',
            'decimal' => 'decimal',
            'double' => 'double',
            'float' => 'float',
            'int' => 'integer',
            'mediumint' => 'mediumInteger',
            'smallint' => 'smallInteger',
            'text' => 'text',
            'time' => 'time',
            'timestamp' => 'timestamp',
            'tinyint' => 'tinyInteger',
            'varchar' => 'string'
        ];
        
        if ($Builder->hasTable($_table['TABLE_NAME'])) {
            $Builder->drop($_table['TABLE_NAME']);
        }
        
        // 4 个类型
        // $table->bigInteger($column, $autoIncrement = false, $unsigned = false);
        // $table->char($column, $length = 255);
        // $table->date($column);
        // $table->decimal($column, $total = 8, $places = 2);
        
        // nginx
        $Builder->create($_table['TABLE_NAME'], function (Blueprint $table) use($map, $_columnConfig) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            foreach ($_columnConfig as $v) {
                $func = $map[$v['DATA_TYPE']];
                
                if ('id' == $v['COLUMN_NAME']) {
                    $columnDefine = $table->$func($v['COLUMN_NAME'], true, true);
                } else {
                    $columnDefine = $table->$func($v['COLUMN_NAME']);
                }
                
                if ('YES' == $v['IS_NULLABLE']) {
                    $columnDefine->nullable();
                }
                $defaultValue = $this->convertDefault($v['COLUMN_DEFAULT']);
                if ($defaultValue) {
                    $columnDefine->default($defaultValue);
                }
                if ($v['COLUMN_COMMENT']) {
                    $columnDefine->comment($v['COLUMN_COMMENT']);
                }
            }
            
            // $table->bigInteger($column, $autoIncrement = false, $unsigned = false);
            // $table->char($column, $length = 255);
            // $table->date($column);
            // $table->dateTime($column);
            // $table->decimal($column, $total = 8, $places = 2);
            // $table->double($column, $total = null, $places = null);
            // $table->float($column, $total = 8, $places = 2);
            // $table->integer($column, $autoIncrement = false, $unsigned = false);
            // $table->mediumInteger($column, $autoIncrement = false, $unsigned = false);
            // $table->smallInteger($column, $autoIncrement = false, $unsigned = false);
            // $table->text($column);
            // $table->time($column);
            // $table->timestamp($column);
            // $table->tinyInteger($column, $autoIncrement = false, $unsigned = false);
            // $table->string($column, $length = 255);
            
            // $table->dropColumn('DDDD');
        });
        
        // \Schema::table('columns', function (Blueprint $table) {
        // $table->dropColumn('COLUMN_COPY');
        // // $columnDefine = $table->tinyInteger('COLUMN_COPY');
        // // $columnDefine->default(1);
        // // $columnDefine->comment('是否从接口输入获取，1否，2是');
        // // $columnDefine->after('IS_NULLABLE');
        // });
        
//         exit();
        
//         \Schema::table('columns', function (Blueprint $table) {
//             $table->tinyInteger('IS_INPUT')
//                 ->default(1)
//                 ->comment('是否从接口输入获取，1否，2是')
//                 ->after('IS_NULLABLE');
//         });
    }
    
    
    public function makeTestCase(){
        // mk Create Test Case
        // 
        $TestRouteGener = new TestRouteGener();
        $TestRouteGener->make('tests/AutoMake/TestAutoMake.php',[
            'only' => 'api/auto*'
        ]);
        
        
        
        
    }
    

    public function run($id = 2)
    {
//         $tArray = [
//             'required|exists:tables',
//             'exists:table',
//             'exists:table|',
//             'exists:table,',
//             'exists:auto.table,',
//         ];
//         foreach ($tArray as $v){
//             $rest = $this->ruleAddConnect($v);
//             dump($rest);
//         }
//         exit();
        
        $_table = Tables::find($id);
        
        $_columnConfig = Columns::queryColumnsConfig($_table['id']);
        
        $this->makeTable($_table, $_columnConfig);
        
        $_model = $this->makeModel($_table, $_columnConfig);
        
        $_controller = $this->makeController($_table, $_columnConfig, $_model);

        $this->makeRoute($_table,$_controller);

    }
}