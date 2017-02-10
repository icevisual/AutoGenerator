<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Achieves\ConfigParser\SimpleCreate;
use App\Console\Achieves\ConfigParser\Adjudicator;
use App\Models\InformationSchema\Tables;
use function GuzzleHttp\json_encode;

class Test extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    
    public function tttt($a,$b =1){
        
    }
    
    /**
     * @param unknown $class_method
     * Class name and method name delimited by ::.
     */
    public function getMethodParametersWithReflection($class_method)
    {
        $ReflectionMethod = new \ReflectionMethod($class_method);
    
        $paArray = $ReflectionMethod->getParameters();
    
        $params = [];
    
        foreach ($paArray as $v){
            $pa = [];
            if($v->isDefaultValueAvailable()){
                $pa['default'] = $v->getDefaultValue();
            }
            $pa['name'] = $v->getName();
            $params[$v->getName()] = $pa;
        }
        return $params;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $class_method = __CLASS__.'::tttt';
        
        dd($this->getMethodParametersWithReflection($class_method));
        exit;
        
        
        
        dd(unserialize('a:7:{s:9:"last_time";s:10:"1484879493";s:7:"last_ip";s:15:"183.128.128.151";s:10:"login_fail";i:0;s:10:"headimgurl";s:129:"http://wx.qlogo.cn/mmopen/HmVQlX9WkBvjyp913zkQfxegoicPYmvJoGv5ZLUCCoggiaWbrNZsPicZG8NLQFDXNgwiak37OEvKibdJgz4fwSSWnWsOeOWaqzRym/0";s:8:"nickname";s:10:"小'));
        
        
        dd(md5('19e19465b6226697cd5eae022116e895ff9be47a'));
        
        $subject = json_encode([
            'asd' => 'asd',
            'dfff' => '1231321'
        ]);
        dump($subject);
        $r = preg_match_all('/\:\"([^\"]*)\"/', $subject,$natch);
        dump($natch);
        dd($r);
        
        
        
        $str = 'externalApi.php';
        
        dump(strpos($str, '.php'));
        dump(strlen($str) - 4);
        strlen($str) - 4 ;
        dump(strpos($str, '.php') == strlen($str) - 4); ;
        
        
        dd($str);
        
        
        
        $ret = \App\Models\System\Tables::tableDetail(10);
        
        edump($ret);
        
       
        
        $ret = \App\Models\System\Tables::queryTables();
        
        edump($ret);
        
        dump( Tables::queryTables());
        
        exit;
        
        Adjudicator::autoGeneration('judge','',true);
        
        
        exit;
        //
        $ret = SimpleCreate::analysisSimpleCreate([
            'symbol' => 'simpleCreate',
            'model' => 'App\Models\Form\Attrs',
            'createFields' => [
                'attr_name',
                'attr_name_cn',
                'attr_type',
                'form_type'
            ]
        ], [
            'data' => [
                'attr_name' => 'data.attr_name',
                'attr_name_cn' => 'data.attr_name_cn',
                'attr_value' => 'data.attr_value',
                'attr_type' => 'data.attr_type',
                'form_type' => 'data.form_type'
            ]
        ]);
        dump($ret);
    }
}
