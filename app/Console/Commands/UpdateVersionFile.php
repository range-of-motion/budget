<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Ignoring this command from code coverage as it is dependent on whether Git is
 * installed or not, which can vary from machine to machine.
 *
 * @codeCoverageIgnore
 */
class UpdateVersionFile extends Command
{
    protected $signature = 'app:update-version-file';

    protected $description = 'Updates the version in version.txt';

    public function handle(): int
    {
        if (trim(shell_exec('git rev-parse --is-inside-work-tree')) !== 'true') {
            $this->warn('Not inside a Git repository, skipping');

            return 0;
        }

        $version = trim(shell_exec('git describe --always --tags'));

        $versionFile = fopen('version.txt', 'w');

        fwrite($versionFile, $version);

        fclose($versionFile);

        $this->info('Detected ' . $version . ' and wrote to version file');

        return 0;
    }
}
