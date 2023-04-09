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
        if (! $this->gitIsInitialized()) {
            $this->error('Git is not initialized in this project, aborting...');

            return Command::FAILURE;
        }

        $this->info('Installing git hooks...');

        $this->getHooks()->each(function ($hook) {
            if ($this->hookIsDisabled($hook)) {
                $this->warn("{$hook} git hook is disabled, skipping...");

                return;
            }

            $this->installHook($hook);
        });

        $this->info('Verifying hooks are executable...');
        exec('chmod +x '.config('git-hooks.scripts_dir').'/*');
        exec('chmod +x '.base_path('.git/hooks').'/*');
        exec('chmod +x '.__DIR__.'/../../bin/run-hook');

        $this->info('Git hooks installed successfully.');

        return Command::SUCCESS;
    }

    private function gitIsInitialized(): bool
    {
        return File::exists(base_path('.git'));
    }

    private function getHooks(): Collection
    {
        return collect(array_keys(config('git-hooks.hooks')));
    }

    private function hookIsDisabled(string $hook): bool
    {
        return in_array($hook, config('git-hooks.disabled'));
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
            $this->line("{$hook} file does not exist yet, creating...");
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
