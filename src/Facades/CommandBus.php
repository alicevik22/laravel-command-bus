<?php

namespace LaravelCommandBus\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use LaravelCommandBus\CommandBus\CommandBusDispatcherInterface;

/**
 * @method static void dispatch(object $command)
 */
final class CommandBus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CommandBusDispatcherInterface::class;
    }
}
