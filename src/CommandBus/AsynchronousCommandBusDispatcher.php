<?php

namespace LaravelCommandBus\CommandBus;

use Illuminate\Support\Facades\Log;
use LaravelCommandBus\Jobs\ProcessCommand;

final class AsynchronousCommandBusDispatcher implements CommandBusDispatcherInterface
{
    public function dispatch(object $command): void
    {
        ProcessCommand::dispatch($command)
            ->onQueue(config('command-bus.async.queue'))
            ->onConnection(config('command-bus.async.connection'))
            ->delay(config('command-bus.async.delay'));

        Log::notice(sprintf('Dispatched command "%s"', $command::class));
    }
}
