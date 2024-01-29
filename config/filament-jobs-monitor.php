<?php

use Croustibat\FilamentJobsMonitor\Resources\QueueMonitorResource;

return [
    'resources' => [
        'enabled' => true,
        'label' => 'Queue Monitor',
        'plural_label' => 'Queue Monitor',
        'navigation_group' => 'System',
        'navigation_icon' => 'heroicon-o-cpu-chip',
        'navigation_sort' => null,
        'navigation_count_badge' => false,
        'resource' => QueueMonitorResource::class,
    ],
    'pruning' => [
        'enabled' => true,
        'retention_days' => 31,
    ],
];
