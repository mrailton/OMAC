<?php

declare(strict_types=1);

return [
    'shield_resource' => [
        'should_register_navigation' => true,
        'slug' => 'roles',
        'navigation_sort' => -1,
        'navigation_badge' => false,
        'navigation_group' => true,
        'is_globally_searchable' => false,
        'show_model_path' => false,
    ],

    'auth_provider_model' => [
        'fqcn' => \App\Models\User::class,
    ],

    'super_admin' => [
        'enabled' => true,
        'name' => 'super_admin',
        'define_via_gate' => false,
        'intercept_gate' => 'before', // after
    ],

    'user' => [
        'enabled' => true,
        'name' => 'user',
    ],

    'permission_prefixes' => [
        'resource' => [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ],

        'page' => 'page',
        'widget' => 'widget',
    ],

    'entities' => [
        'pages' => true,
        'widgets' => true,
        'resources' => true,
        'custom_permissions' => false,
    ],

    'generator' => [
        'option' => 'policies_and_permissions',
    ],

    'exclude' => [
        'enabled' => true,

        'pages' => [
            'Dashboard',
        ],

        'widgets' => [
            'AccountWidget', 'FilamentInfoWidget',
        ],

        'resources' => [],
    ],

    'register_role_policy' => [
        'enabled' => true,
    ],

];
