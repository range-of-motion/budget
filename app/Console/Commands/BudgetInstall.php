<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Ignoring this command from code coverage as it is dependent on binaries
 * that may or may not be installed on the machine.
 *
 * @codeCoverageIgnore
 */
class BudgetInstall extends Command
{
    protected $signature = 'budget:install';

    protected $description = 'Runs most of the commands needed to make Budget work';

    private function executeCommand($command): string
    {
        $process = new Process($command);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    public function handle(): void
    {
        $this->info('Installing Node.js packages');
        $this->executeCommand(['npm', 'install']);

        $this->info('Compiling front-end assets');
        $this->executeCommand(['npm', 'run', 'build']);

        $this->executeCommand(['cp', '.env.example', '.env']);
        $this->executeCommand(['php', 'artisan', 'key:generate']);
        $this->executeCommand(['php', 'artisan', 'storage:link']);

        $this->info('Done!');
    }
}
