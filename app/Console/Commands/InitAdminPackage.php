<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitAdminPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:admin';

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
        $this->initCommand();
        return 0;
    }


    function initCommand(){

        Artisan::call('migrate:fresh');
        UserService::createDefaultUser();
        Artisan::call('db:seed');

        $this->info('Admin package succesfully initialized');

    }
}
