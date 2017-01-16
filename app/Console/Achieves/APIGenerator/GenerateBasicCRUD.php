<?php
namespace App\Console\Achieves\APIGenerator;

use Illuminate\Database\Schema\Blueprint;
use App\Models\System\Tables;
use App\Models\System\Columns;

class GenerateBasicCRUD
{

    public function makeModel($id)
    {
        $table = Tables::find($id);
        
        $config = \Config::get('database.connections');
        
        $modelNameCamel = ucfirst(camel_case($table['TABLE_NAME']));
        
        $connectionNameCamel = ucfirst(camel_case($table['CONNECTION']));
        
        $dist = app_path('Models/AutoMake/' . $connectionNameCamel);
        
        if (! file_exists($dist)) {
            @mkdir($dist);
        }
        
        $distFile = $dist . '/' . $modelNameCamel . '.php';
        
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
}
EOL;
        file_put_contents($distFile, $template);
        
        return [
            'namespace' => "App\Models\AutoMake\\{$connectionNameCamel}",
            'class' => $modelNameCamel
        ];
    }

    public function makeFunction($config, $func = 'create')
    {}

    public function getArrayOutput($data)
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

    public function makeValidateConfig($columnConfig)
    {
        $_customValidateConfig = [];
        
        $_customValidateConfig = [
            'rules' => [], // 条件
            'attributes' => []
        ];
        
        foreach ($columnConfig as $v) {
            $_customValidateConfig['rules'][$v['COLUMN_NAME']] = $v['COLUMN_VALIDATE'];
            $_customValidateConfig['attributes'][$v['COLUMN_NAME']] = $v['COLUMN_NAME_CN'];
        }
        $str = $this->getArrayOutput($_customValidateConfig);
        return $str;
    }

    public function makeInputMap($columnConfig)
    {
        $_inputMap = [];
        $tabPlaceholder = '    ';
        $linePrefix = str_repeat($tabPlaceholder, 3);
        foreach ($columnConfig as $v) {
            if ($v['IS_INPUT'] == Columns::IS_INPUT_YES) {
                // TODO Parse DATA_TYPE
                $_inputMap[] = $linePrefix . "'{$v['COLUMN_NAME']}' => \Input::get('{$v['COLUMN_NAME']}'), // {$v['DATA_TYPE']} {$v['COLUMN_NAME_CN']}" . PHP_EOL;
                // TODO Parse default value
            }
        }
        $ret = implode('', $_inputMap);
        return substr($ret, 0, 0 - strlen(PHP_EOL));
    }

    public function makeController($id)
    {
        $dist = app_path('Http/Controllers/AutoMake/TableController.php');
        
        $_columnConfig = Columns::queryColumnsConfig($id);
        
        $_customValidateConfig = $this->makeValidateConfig($_columnConfig);
        
        $_inputMap = $this->makeInputMap($_columnConfig);
        
        $_model = $this->makeModel($id);
        
        $_modelFullClass = $_model['namespace'].'/'.$_model['class'];
        
        $_modelFullClass = trim($_modelFullClass,'\\');
        
        $_modelFullClass = str_replace('/', '\\', $_modelFullClass);
        // dd($_inputMap);
        // makeInputMap
        // TODO 生成 APIDoc 注释
        $template = <<<EOL
<?php
namespace App\Http\Controllers\AutoMake;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use $_modelFullClass;

class TableController extends Controller
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
        \$obj = {$_model['class']}::updateTable(\$data);
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
        
        dump($template);
        file_put_contents($dist, $template);
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

    public function run($id = 2)
    {
        $this->makeController($id);
        
        exit();
        
        $this->makeValidateConfig($id);
        
        exit();
        dump($this->_customValidateConfig);
        
        ob_start();
        
        echoArrayKV($this->_customValidateConfig);
        
        $output = ob_get_clean();
        
        dump('    protected  $_customValidateConfig = ' . $output);
        
        exit();
        
        // make controller , make function ,make model ,make route
        $model = $this->makeModel($id);
        
        $this->makeController($id, $model);
        
        //
        // \Schema::table('columns',function(Blueprint $table){
        // $table->dropColumn('DDDD');
        // });
        
        // \Schema::table('columns',function(Blueprint $table){
        // $table->tinyInteger('IS_INPUT')->default(1)->comment('是否从接口输入获取，1否，2是')->after('IS_NULLABLE');
        // });
    }
}