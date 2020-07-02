<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DispatchJob extends Command
{
    protected $signature = 'job:dispatch {job}';
    protected $description = 'Dispatches job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $className = '\App\Jobs\\' . $this->argument('job');

        if (class_exists($className)) {
            $className::dispatch();
        } else {
            echo 'Couldn\'t find specified job' . PHP_EOL;
        }
    }
}
