<?php

namespace LaravelCommandBus\Tests\Unit;

use LaravelCommandBus\CommandBus\CommandBusHandlerInterface;
use LaravelCommandBus\Jobs\ProcessCommand;
use LaravelCommandBus\Tests\TestCase;
use Mockery;
use stdClass;

class ProcessCommandTest extends TestCase
{
    public function testItCallsHandleOnCommandBusHandlerWithCorrectCommand(): void
    {
        $command = new stdClass();
        $command->test = 1;

        $sut = new ProcessCommand($command);

        $commandBusHandlerMock = Mockery::mock(CommandBusHandlerInterface::class);

        $commandBusHandlerMock->shouldIgnoreMissing();

        $commandBusHandlerMock
            ->expects()
            ->handle($command)
            ->once();

        $sut->handle($commandBusHandlerMock);
    }
}
