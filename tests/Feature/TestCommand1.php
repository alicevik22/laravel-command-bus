<?php

namespace LaravelCommandBus\Tests\Feature;

class TestCommand1
{
    public function __construct(public string $message)
    {
    }
}
