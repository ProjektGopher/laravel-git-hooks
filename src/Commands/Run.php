<?php

namespace ProjektGopher\GitHooks\Commands;

use Illuminate\Console\Command;

class Run extends Command
{
    protected $signature = 'git-hooks:get-run-cmd {hook}';

    protected $description = 'Get the bash command to run a given hook';

    public function handle(): int
    {
        $this->line(__DIR__."/../run-hook {$this->argument('hook')}");

        return Command::SUCCESS;
    }
}
