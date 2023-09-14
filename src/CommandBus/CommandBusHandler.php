<?php

namespace LaravelCommandBus\CommandBus;

use InvalidArgumentException;

final class CommandBusHandler implements CommandBusHandlerInterface
{
    /**
     * @param array<class-string, callable(object $command): void|class-string> $commandHandlers
     */
    public function __construct(private array $commandHandlers = [])
    {
    }

    public function handle(object $command): void
    {
        $this->runCommandHandlerForCommand($command);
    }

    public function runCommandHandlerForCommand(object $command): void
    {
        $handler = $this->getCommandHandlerForCommand($command);

        if (!is_callable($handler)) {
            $handler = app($handler);
        }

        if (!is_callable($handler)) {
            throw new InvalidArgumentException(sprintf('Handler for "%s" is not callable.', $command::class));
        }

        if (is_callable($handler)) {
            $handler($command);
        }
    }

    private function getCommandHandlerForCommand(object $command): callable|string
    {
        return $this->commandHandlers[$command::class] ??
            throw new InvalidArgumentException(
                sprintf('Command handler not found for command "%s".', $command::class)
            );
    }
}
