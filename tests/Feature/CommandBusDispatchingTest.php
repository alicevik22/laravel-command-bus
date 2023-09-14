<?php

namespace LaravelCommandBus\Tests\Feature;

use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use LaravelCommandBus\CommandBus\CommandBusHandler;
use LaravelCommandBus\CommandBus\CommandBusHandlerInterface;
use LaravelCommandBus\Facades\CommandBus;
use LaravelCommandBus\Tests\TestCase;

class CommandBusDispatchingTest extends TestCase
{
    public function testCommandIsDispatchedWhenCommandHandlerIsDefined(): void
    {
        $this->app->bind(
            CommandBusHandlerInterface::class,
            function () {
                return new CommandBusHandler(
                    [
                        TestCommand1::class => TestCommandHandler1::class,
                    ]
                );
            }
        );

        Log::spy()->shouldIgnoreMissing()
            ->expects()
            ->info('hello')
            ->once();

        CommandBus::dispatch(new TestCommand1('hello'));
    }

    public function testExceptionIsThrownWhenCommandHandlerIsNotDefined(): void
    {
        $this->expectException(InvalidArgumentException::class);

        CommandBus::dispatch(new TestCommand2('hello'));
    }

    public function testExceptionIsThrownWhenCommandHandlerIsNotCallable(): void
    {
        $this->app->bind(
            CommandBusHandlerInterface::class,
            function () {
                return new CommandBusHandler(
                    [
                        TestCommand1::class => TestCommandHandler2::class,
                    ]
                );
            }
        );

        $this->expectException(InvalidArgumentException::class);

        CommandBus::dispatch(new TestCommand1('hello'));
    }
}
