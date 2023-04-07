<?php

namespace ProjektGopher\GitHooks\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Install extends Command
{
    protected $signature = 'git-hooks:install';

    protected $description = 'Install git hooks';

    public function handle(): int
    {
        $this->info('Installing git hooks...');

        $this->getHooks()->each(function ($hook) {
            if ($this->hookIsDisabled($hook)) {
                $this->warn("{$hook} git hook is disabled, skipping...");

                return;
            }

            $this->installHook($hook);
        });

        $this->info('Verifying hooks are executable...');
        exec('chmod +x '.config('git_hooks.scripts_dir').'/*');
        exec('chmod +x '.base_path('.git/hooks').'/*');
        exec('chmod +x '.__DIR__.'/../run-hook');

        $this->info('Git hooks installed successfully.');

        return Command::SUCCESS;
    }

    private function getHooks(): Collection
    {
        return collect(array_keys(config('git_hooks.hooks')));
    }

    private function hookIsDisabled(string $hook): bool
    {
        return in_array($hook, config('git_hooks.disabled'));
    }

    private function hookIsInstalled(string $hook): bool
    {
        return strpos(
            File::get(base_path(".git/hooks/{$hook}")),
            "eval \"$(php artisan git-hooks:get-run-cmd {$hook})\"",
        ) !== false;
    }

    private function installHook(string $hook): void
    {
        if (! File::exists(base_path(".git/hooks/{$hook}"))) {
            File::put(base_path(".git/hooks/{$hook}"), '#!/bin/sh'.PHP_EOL);
        }

        if ($this->hookIsInstalled($hook)) {
            $this->warn("{$hook} git hook already installed, skipping...");

            return;
        }

        File::append(
            base_path(".git/hooks/{$hook}"),
            "eval \"$(php artisan git-hooks:get-run-cmd {$hook})\"".PHP_EOL,
        );

        $this->info("{$hook} git hook installed successfully.");
    }
}
