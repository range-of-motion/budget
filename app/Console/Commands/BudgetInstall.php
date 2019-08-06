<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BudgetInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budget:install';

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

    public function executeCommand($command) {
        $process = new Process($command);
        $process->setTty(true);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getIncrementalErrorOutput();
        echo $process->getOutput();
    }

    public function composerInstall() {
        $this->executeCommand(['composer', 'install', '--no-dev']);
    }

    public function yarnInstall() {
        $this->executeCommand(['yarn', 'install']);
    }

    public function artisanPrepare() {
        $this->executeCommand(['cp', '.env.example', '.env']);
        $this->executeCommand(['php', 'artisan', 'key:generate']);
        $this->executeCommand(['php', 'artisan', 'storage:link']);
        $this->executeCommand(['php', 'artisan', 'migrate']);
    }

    public function yarnRunDev() {
        $this->executeCommand(['yarn', 'run', 'development']);
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $this->composerInstall();
        $this->yarnInstall();
        $this->artisanPrepare();
        $this->yarnRunDev();
    }
}
