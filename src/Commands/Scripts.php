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
        $this->getScripts($this->argument('hook'))->each(function ($script): void {
            if (str_starts_with($script, '@')) {
                $this->line(substr($script, 1));

                return;
            }
            $this->line($this->buildScriptPath($script));
        });

        return Command::SUCCESS;
    }

    private function getScripts(string $hook): Collection
    {
        return collect(config("git-hooks.hooks.{$hook}"));
    }

    private function buildScriptPath(string $script): string
    {
        return implode([config('git-hooks.scripts_dir'), '/', $script]);
    }
}
