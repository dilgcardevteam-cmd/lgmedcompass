<?php

use App\Models\Section;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200)
        ->assertSee('name="nickname"', false);
});

test('new users can register with a nickname', function () {
    $section = Section::create(['name' => 'Planning']);

    $this->post('/register', [
        'first_name' => 'Taylor',
        'last_name' => 'Example',
        'nickname' => 'Tay',
        'position' => 'Staff',
        'username' => 'taylor_example',
        'email' => 'taylor@example.com',
        'password' => 'StrongPass1!',
        'password_confirmation' => 'StrongPass1!',
        'section_id' => $section->id,
    ])->assertRedirect(route('verification.notice'));

    $this->assertDatabaseHas('users', [
        'email' => 'taylor@example.com',
        'nickname' => 'Tay',
    ]);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
