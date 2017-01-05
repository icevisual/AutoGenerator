<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BaseModel;

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $ret = BaseModel::analysisSimpleCreate([], [
            [
                'attr_name' => 'data.attr_name',
                'attr_name_cn' => 'data.attr_name_cn',
                'default_value' => 'data.attr_value',
                'attr_type' => 'data.attr_type',
                'form_type' => 'data.form_type'
            ]
        ]);
        dump($ret);
    }
}
