<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BudgetInstall extends Command
{
    protected $signature = 'budget:install';

    protected $description = 'Runs most of the commands needed to make Budget work';

    public function __construct()
    {
        parent::__construct();
    }

    public function executeCommand($command)
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getIncrementalErrorOutput();
        echo $process->getOutput();
    }

    public function composerInstall()
    {
        $this->executeCommand(['composer', 'install', '--no-dev']);
    }

    public function yarnInstall()
    {
        $this->executeCommand(['yarn', 'install']);
    }

    public function artisanPrepare()
    {
        $this->executeCommand(['cp', '.env.example', '.env']);
        $this->executeCommand(['php', 'artisan', 'key:generate']);
        $this->executeCommand(['php', 'artisan', 'storage:link']);
    }

    public function yarnBuild()
    {
        $this->executeCommand(['yarn', 'run', 'development']);
    }

    public function handle()
    {
        $this->composerInstall();
        $this->yarnInstall();
        $this->artisanPrepare();
        $this->yarnBuild();
    }
}
