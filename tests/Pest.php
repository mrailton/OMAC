<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

function user(): User
{
    $data = [
        'name' => 'Test User',
        'email' => 'test@user.com',
        'password' => 'password',
    ];

    return User::first() ?: User::create($data);
}
