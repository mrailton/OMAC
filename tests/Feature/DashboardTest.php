<?php

declare(strict_types=1);

use App\Models\User;

test('dashboard page is accessible', function (): void {
    $this->actingAs(User::factory()->create());
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Dashboard');
});
