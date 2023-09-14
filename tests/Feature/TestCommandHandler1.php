<?php

namespace LaravelCommandBus\Tests\Feature;

use Psr\Log\LoggerInterface;

class TestCommandHandler1
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function __invoke(TestCommand1 $command): void
    {
        $this->logger->info($command->message);
    }
}
