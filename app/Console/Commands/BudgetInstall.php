<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BudgetInstall extends Command
{
    protected $signature = 'budget:install {--node-package-manager=}';
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

    private function programExists(string $program): bool
    {
        try {
            $this->executeCommand(['which', $program]);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function handle(): void
    {
        $nodePackageManager = $this->option('node-package-manager');

        if (!$nodePackageManager) {
            $nodePackageManager = $this->choice('Which package manager would you like to use for Node.js?', [
                'npm',
                'yarn',
            ]);
        }

        if (!$this->programExists($nodePackageManager)) {
            $this->error('Could not find "' . $nodePackageManager . '", will not be able to compile front-end assets');
        } else {
            $this->info('Installing Node.js packages');
            $this->executeCommand([$nodePackageManager, 'install']);

            $this->info('Compiling front-end assets');
            $this->executeCommand([$nodePackageManager, 'run', 'production']);
        }

        $this->executeCommand(['cp', '.env.example', '.env']);
        $this->executeCommand(['php', 'artisan', 'key:generate']);
        $this->executeCommand(['php', 'artisan', 'storage:link']);

        $this->info('Done!');
    }
}
