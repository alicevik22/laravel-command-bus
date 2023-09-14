<?php

namespace LaravelCommandBus\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelCommandBus\CommandBus\AsynchronousCommandBusDispatcher;
use LaravelCommandBus\CommandBus\CommandBusDispatcherInterface;
use LaravelCommandBus\CommandBus\CommandBusHandler;
use LaravelCommandBus\CommandBus\CommandBusHandlerInterface;
use LaravelCommandBus\CommandBus\SynchronousCommandBusDispatcher;

final class CommandBusProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'command-bus');

        $this->app->bind(
            CommandBusHandlerInterface::class,
            function (): CommandBusHandlerInterface {
                return new CommandBusHandler(config('command-bus.handlers', []));
            }
        );

        $this->app->bind(
            CommandBusDispatcherInterface::class,
            config('command-bus.type') === 'async' ?
                AsynchronousCommandBusDispatcher::class : SynchronousCommandBusDispatcher::class
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../../config/config.php' => config_path('command-bus.php'),
                ]
            );
        }
    }
}
