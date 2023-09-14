<?php

namespace LaravelCommandBus\CommandBus;

use Illuminate\Support\Facades\Log;
use LaravelCommandBus\Jobs\ProcessCommand;

final class SynchronousCommandBusDispatcher implements CommandBusDispatcherInterface
{
    public function dispatch(object $command): void
    {
        ProcessCommand::dispatchSync($command);

        Log::notice(sprintf('Dispatched command "%s"', $command::class));
    }
}
