<?php

namespace App\Console\Commands;

use App\Services\DeviceService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PullFromDevice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull-from:device {locationPath}';

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

    private $locationPath = null;

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

        $this->locationPath = $this->argument('locationPath');

        $this->info('Reading from device location path ....');
        $this->info($this->locationPath);

        $this->execCommand();

        return 0;
    }

    function execCommand(){

        $json = Storage::disk('public-path')->get($this->locationPath . '/data.json'); /// will be replaced by an API call to device IP-Address.

        $json = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json);
        $json = json_decode( $json , true);
        $this->info('Fetching json payload ... ');
//        $this->info($json);
        DeviceService::readFromJson($json);

        $this->info('Data read...');

    }


}
