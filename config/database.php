<?php

declare(strict_types=1);

return [
    'connections' => [
        'mysql' => [
            'url' => env('DATABASE_URL', 'mysql://user:password@localhost/database'),
        ]
    ],
    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => false, // disable to preserve original behavior for existing applications
    ],

];
