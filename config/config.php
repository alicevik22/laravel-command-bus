<?php

return [
    'type' => env('COMMAND_BUS_TYPE', 'async'), // async or sync

    'async' => [
        'queue' => env('COMMAND_BUS_ASYNC_QUEUE', 'commands'),
        'connection' => env('COMMAND_BUS_ASYNC_CONNECTION'),
        'delay' => env('COMMAND_BUS_DELAY'),
    ],

    'handlers' => [
        // Command::class => Handler::class,
        // or
        // Command::class => fn ($command) => ''
    ],
];
