<?php

declare(strict_types=1);

use App\Models\User;

test('members page is accessible', function (): void {
    $this->actingAs(User::factory()->create()->givePermissionTo('view_any_member'));
    $response = $this->get('/members');

    $response->assertStatus(200);
    $response->assertSee('Members');
});
