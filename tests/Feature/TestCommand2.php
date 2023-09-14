<?php

namespace LaravelCommandBus\Tests\Feature;

readonly class TestCommand2
{
    public function __construct(public string $message)
    {
    }
}
