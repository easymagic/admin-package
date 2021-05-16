<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Prophecy\Argument\Token\TokenInterface;

class SysReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sys:reset';

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
     * @return int
     */
    public function handle()
    {
        $this->recreateTables();
        $this->setupDefaultSystemUser();
//        $this->loadDefaultDeviceJson();
        return 0;
    }

    function recreateTables(){
        Artisan::call('migrate:fresh');
    }

    function loadDefaultDeviceJson(){
       Artisan::call('pull-from:device "device_data"');
    }

    function setupDefaultSystemUser(){
      Artisan::call('db:seed');
    }


}
