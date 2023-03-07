<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('a guest can not access the dashboard', function () {
    get(route('dashboard'))
        ->assertRedirectToRoute('login');
});

test('an authenticated user can access the dashboard', function () {
    actingAs(user())->get(route('dashboard'))
        ->assertSee('This will be a dashboard (maybe)');
});
