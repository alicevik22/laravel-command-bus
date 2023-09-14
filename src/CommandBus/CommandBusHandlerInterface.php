<?php

namespace LaravelCommandBus\CommandBus;

interface CommandBusHandlerInterface
{
    public function handle(object $command): void;
}
