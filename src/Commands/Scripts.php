<?php

namespace ProjektGopher\GitHooks\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class Scripts extends Command
{
    protected $signature = 'git-hooks:scripts {hook}';

    protected $description = 'Get a list of scripts for a given hook';

    public function handle(): int
    {
        $this->getScripts($this->argument('hook'))->each(fn ($script) => $this->line($this->buildScriptPath($script))
        );

        return Command::SUCCESS;
    }

    private function getScripts(string $hook): Collection
    {
        return collect(config("git_hooks.hooks.{$hook}"));
    }

    private function buildScriptPath(string $script): string
    {
        return implode([config('git_hooks.scripts_dir'), '/', $script]);
    }
}
