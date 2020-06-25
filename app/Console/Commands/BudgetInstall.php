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

    private function executeCommand($command): string
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    private function nodePackageManagerExists(): bool
    {
        $output = $this->executeCommand(['which', 'npm']);

        return strpos($output, 'not found') === false;
    }

    private function yarnExists(): bool
    {
        $output = $this->executeCommand(['which', 'yarn']);

        return strpos($output, 'not found') === false;
    }

    public function handle(): void
    {
        if ($this->yarnExists()) {
            $this->executeCommand(['yarn', 'install']);
            $this->executeCommand(['yarn', 'run', 'production']);
        } elseif ($this->nodePackageManagerExists()) {
            $this->executeCommand(['npm', 'install']);
            $this->executeCommand(['npm', 'run', 'production']);
        } else {
            $this->warn('Neither Yarn or NPM were found, please install either and retry this command');
        }

        $this->executeCommand(['cp', '.env.example', '.env']);
        $this->executeCommand(['php', 'artisan', 'key:generate']);
        $this->executeCommand(['php', 'artisan', 'storage:link']);
    }
}
