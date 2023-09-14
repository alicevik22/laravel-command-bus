<?php

namespace LaravelCommandBus\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LaravelCommandBus\CommandBus\CommandBusHandlerInterface;

final class ProcessCommand implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(private object $command)
    {
    }

    public function handle(CommandBusHandlerInterface $commandBusHandler): void
    {
        Log::notice(sprintf('Handling command "%s".', $this->command::class));

        $commandBusHandler->handle($this->command);

        Log::notice(sprintf('Finished handling command "%s".', $this->command::class));
    }
}
