<?php

namespace LaravelCommandBus\Tests;

use LaravelCommandBus\Providers\CommandBusProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            CommandBusProvider::class,
        ];
    }
}
