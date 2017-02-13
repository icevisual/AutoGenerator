<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestRoute extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testroute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'testroute';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        mt_mark('start');
        $ApidocAnnGener = new  \App\Console\Achieves\Common\TestRouteGener();
        $ApidocAnnGener->run();
        $this->comment(PHP_EOL . '--END--' . PHP_EOL);
        dmt_mark('start','end');
    }
    
}
