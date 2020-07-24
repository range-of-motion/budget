<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class BudgetUpdate extends Command
{
    protected $signature = 'budget:update';
    protected $description = 'Update the application to the latest version';

    public function __construct()
    {
        parent::__construct();
    }

    private function doesBinaryExist(string $name): bool
    {
        return shell_exec('which ' . $name);
    }

    public function handle(): void
    {
        if (!$this->doesBinaryExist('git')) {
            throw new Exception('Could not find Git');
        }

        // Fetch tags from repository
        shell_exec('git fetch --tags');

        $currentVersion = rtrim(shell_exec('git describe --tag --abbrev=0'), PHP_EOL);
        $latestVersion = rtrim(shell_exec('git describe --tags $(git rev-list --tags --max-count=1)'), PHP_EOL);

        $this->info('Currently running on ' . $currentVersion . ', latest version is ' . $latestVersion);

        if ($currentVersion === $latestVersion) {
            echo 'You\'ve already installed the latest version' . PHP_EOL;

            exit(0);
        }

        if (!$this->doesBinaryExist('composer')) {
            throw new Exception('Could not find Composer, reverting update');
        }

        // Check out on latest version
        shell_exec('git checkout -f ' . $latestVersion);

        // Enable maintenance mode
        shell_exec('php artisan down');

        // Install Composer dependencies
        shell_exec('composer install --no-dev -o');

        // Migrate database
        shell_exec('php artisan migrate --force');

        // Transpile front-end assets
        $nodePackageManager = null;

        if ($this->doesBinaryExist('npm')) {
            $nodePackageManager = 'npm';
        } elseif ($this->doesBinaryExist('yarn')) {
            $nodePackageManager = 'yarn';
        }

        if (!$nodePackageManager) {
            $this->warn('Neither NPM nor Yarn were found, could not update front-end assets');
        } else {
            shell_exec($nodePackageManager . ' install && ' . $nodePackageManager . ' run production');
        }

        // Destroy existing sessions
        shell_exec('rm ' . storage_path() . '/framework/sessions/*');

        // Disable maintenance mode
        shell_exec('php artisan up');

        $this->info('Successfully updated to ' . $latestVersion . ', you should probably restart your queue workers as well'); // phpcs:ignore
    }
}
