<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServerConnectionControl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ServerConnectionControl:cron';

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
        $line = "{}";
        $file=fopen('test.json','w');
        fwrite($file,json_encode($line));
        fclose($file);
        session(['key' => 'value']);
        Cache::put('key', 'value');
        return 0;
    }
}
