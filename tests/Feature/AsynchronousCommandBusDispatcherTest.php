<?php

use Illuminate\Support\Facades\Bus;
use LaravelCommandBus\CommandBus\AsynchronousCommandBusDispatcher;
use LaravelCommandBus\Jobs\ProcessCommand;
use LaravelCommandBus\Tests\TestCase;

class AsynchronousCommandBusDispatcherTest extends TestCase
{
    public function testDispatchesAsynchronousProcessCommand(): void
    {
        Bus::fake();

        $sut = new AsynchronousCommandBusDispatcher();

        $sut->dispatch(new stdClass());

        Bus::assertDispatched(ProcessCommand::class);
    }
}
