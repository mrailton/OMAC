<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('user can not login if account is rate limited', function () {
    $user = User::factory()->create();

    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', ['email' => $user->email, 'password' => 'wrong-password']);
    }

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('an authenticated user can not access the login page', function () {
    $this->actingAs(user())
        ->get('/login')
        ->assertRedirectToRoute('dashboard');
});

test('a user can logout', function () {
    actingAs(user())->post(route('logout'))
        ->assertRedirect('/');

    assertGuest();
});
