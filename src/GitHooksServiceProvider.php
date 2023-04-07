<?php

namespace ProjektGopher\GitHooks;

use ProjektGopher\GitHooks\Commands\Install;
use ProjektGopher\GitHooks\Commands\Run;
use ProjektGopher\GitHooks\Commands\Scripts;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GitHooksServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-git-hooks')
            ->hasConfigFile()
            ->hasCommands([
                Install::class,
                Run::class,
                Scripts::class,
            ]);
    }
}
