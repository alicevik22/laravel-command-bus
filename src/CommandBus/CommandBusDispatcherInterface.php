<?php

namespace LaravelCommandBus\CommandBus;

interface CommandBusDispatcherInterface
{
    public function dispatch(object $command): void;
}
