<?php

namespace ProjektGopher\GitHooks\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use ProjektGopher\GitHooks\GitHooksServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            GitHooksServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
