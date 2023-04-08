<?php

namespace ProjektGopher\GitHooks\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Run extends Command
{
    protected $signature = 'git-hooks:get-run-cmd {hook}';

    protected $description = 'Get the bash command to run a given hook';

    public function handle(): int
    {
        if (File::exists(__DIR__.'/../../bin/skip-once')) {
            File::delete(__DIR__.'/../../bin/skip-once');

            return Command::SUCCESS;
        }

        $this->line(__DIR__."/../../bin/run-hook {$this->argument('hook')}");

        return Command::SUCCESS;
    }
}
