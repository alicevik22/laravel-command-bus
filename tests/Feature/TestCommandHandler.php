<?php

namespace LaravelCommandBus\Tests\Feature;

use JetBrains\PhpStorm\NoReturn;
use Psr\Log\LoggerInterface;

class TestCommandHandler
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    #[NoReturn] public function __invoke(TestCommand1 $command): void
    {
        $this->logger->info($command->message);
    }
}
