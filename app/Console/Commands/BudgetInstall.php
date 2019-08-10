<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BudgetInstall extends Command {
    protected $signature = 'budget:install {--dev} {--translation}';

    protected $description = 'Runs most of the commands needed to make Budget work';

    public function __construct() {
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
        $command = ['composer', 'install'];
        if (!$this->option('dev')) {
            array_push($command, '--no-dev');
        }

        $this->executeCommand($command);
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

    public function yarnBuild() {
        $command = ['yarn', 'run', 'development'];
        if ($this->option('dev')) {
            array_push($command, '--watch');
        }

        $this->executeCommand($command);
    }

    public function generateVuei18nTranslations() {
        $this->executeCommand(['php', 'artisan', 'vue-i18n:generate']);
    }

    public function handle() {
        if (!$this->option('translation')) {
            $this->composerInstall();
            $this->yarnInstall();
            $this->artisanPrepare();
            $this->yarnBuild();
        }
        $this->generateVuei18nTranslations();
    }
}
