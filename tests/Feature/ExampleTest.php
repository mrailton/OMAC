<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('the application returns a successful response', function () {
    actingAs(User::factory()->create());
    $response = $this->get('/');

    $response->assertStatus(200);
});
