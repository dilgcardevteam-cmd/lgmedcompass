<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'login' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'login' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('archived users see a deactivation message when logging in with their email', function () {
    $user = User::factory()->create();
    $user->delete();

    $message = 'Your account has been deactivated. Please contact the administrator for assistance.';

    $response = $this->from('/login')->post('/login', [
        'login' => $user->email,
        'password' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login')
        ->assertSessionHasErrors(['login' => $message]);

    $this->get('/login')->assertSee($message);
});

test('archived users see a deactivation message when logging in with their username', function () {
    $user = User::factory()->create();
    $user->delete();

    $response = $this->from('/login')->post('/login', [
        'login' => $user->username,
        'password' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login')
        ->assertSessionHasErrors([
            'login' => 'Your account has been deactivated. Please contact the administrator for assistance.',
        ]);
});

test('active accounts can log in when an archived account shares their email', function () {
    $archivedUser = User::factory()->create();
    $email = $archivedUser->email;
    $archivedUser->delete();

    $activeUser = User::factory()->create([
        'email' => $email,
    ]);

    $this->post('/login', [
        'login' => $email,
        'password' => 'password',
    ])->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticatedAs($activeUser);
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
