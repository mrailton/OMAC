<?php

declare(strict_types=1);

return [

    'disks' => [
        'backup' => [
            'driver' => 's3',
            'key' => env('AWS_BACKUP_ACCESS_KEY_ID'),
            'secret' => env('AWS_BACKUP_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BACKUP_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],
    ],

];
