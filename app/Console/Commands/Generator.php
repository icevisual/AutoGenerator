<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Achieves\ConfigParser\SimpleCreate;
use App\Console\Achieves\ConfigParser\Adjudicator;
use App\Models\InformationSchema\Tables;
use function GuzzleHttp\json_decode;

class Generator extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g {action} {p=op_tables}';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        $funcName = strtolower($action) . 'Action';
        if (method_exists($this, $funcName)) {
            call_user_func([
                $this,
                $funcName
            ]);
        } else {
            $this->error(PHP_EOL . 'No Action Found');
        }
        $this->comment(PHP_EOL . '> DONE !');
    }
    
    
    public function selectAction(){
        $str = "bigint
blob
char
date
datetime
decimal
double
enum
float
int
longblob
longtext
mediumint
mediumtext
set
smallint
text
time
timestamp
tinyblob
tinyint
varbinary
varchar";
        
        
        $arr = [];
        
        foreach (explode("\n", $str) as $v){
            $arr[] = [
                'value' => $v,
                'text' => $v
            ];
            
        }
        edump(json_encode($arr));
        dump(explode("\n", $str));
    }
    
    public function asas($a){
        
    }
    
    
    public function tfAction(){
        
        $tablename = $this->argument('p');
        
        $data = \App\Models\InformationSchema\Columns::select([
            'COLUMN_NAME AS key',
            'COLUMN_COMMENT AS name'
        ])->where('TABLE_SCHEMA','automation')
        ->where('TABLE_NAME',$tablename)
        ->get()
        ->toArray();
        
//         echo '{';
        $output = '';
        foreach ($data as $v){
            $output .=<<<EOL
    "{$v['key']}": {
        "name": "{$v['name']}",
        "type": "input",
        "attrs": {
            "type": "text",
            "placeholder": "{$v['name']}"
        },
        "value": ""
    },

EOL;
        }
        $output = substr($output, 0,-2);
//         echo '}';
        $output = "{\n".$output."\n}";
        echo($output);
    }
    
    
    
    
    
}
