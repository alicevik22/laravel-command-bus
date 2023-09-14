<?php

use Illuminate\Support\Facades\Bus;
use LaravelCommandBus\CommandBus\SynchronousCommandBusDispatcher;
use LaravelCommandBus\Jobs\ProcessCommand;
use LaravelCommandBus\Tests\TestCase;

class SynchronousCommandBusDispatcherTest extends TestCase
{
    public function testDispatchesSynchronousProcessCommand(): void
    {
        Bus::fake();

        $sut = new SynchronousCommandBusDispatcher();

        $sut->dispatch(new stdClass());

        Bus::assertDispatchedSync(ProcessCommand::class);
    }
}
