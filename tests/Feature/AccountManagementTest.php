<?php

use App\Models\User;

test('admin can view account management page', function () {
    $admin = User::factory()->create([
        'role' => 'Admin',
    ]);

    User::factory()->create([
        'name' => 'Zara Employee',
        'section' => 'LGOO',
    ]);

    $response = $this->actingAs($admin)->get(route('account-management.index'));

    $response->assertOk();
    $response->assertSee('Account Management');
});

test('employee cannot view account management page', function () {
    $employee = User::factory()->create([
        'role' => 'Employee',
    ]);

    $response = $this->actingAs($employee)->get(route('account-management.index'));

    $response->assertForbidden();
});

test('account management filters users by name and section', function () {
    $admin = User::factory()->create([
        'role' => 'Admin',
    ]);

    User::factory()->create([
        'name' => 'Albert One',
        'section' => 'LGOO',
    ]);

    User::factory()->create([
        'name' => 'Brian Two',
        'section' => 'LGPOPS',
    ]);

    $response = $this->actingAs($admin)->get(route('account-management.index', [
        'name' => 'Albert',
        'section' => 'LGOO',
    ]));

    $response->assertOk();
    $response->assertSee('Albert One');
    $response->assertDontSee('Brian Two');
});

test('admin can update user role', function () {
    $admin = User::factory()->create([
        'role' => 'Admin',
    ]);

    $targetUser = User::factory()->create([
        'role' => 'Employee',
    ]);

    $response = $this->actingAs($admin)->patch(route('account-management.update-role', $targetUser), [
        'role' => 'Admin',
    ]);

    $response->assertRedirect();
    expect($targetUser->fresh()->role)->toBe('Admin');
});

test('cannot demote the only admin user', function () {
    $admin = User::factory()->create([
        'role' => 'Admin',
    ]);

    $response = $this->actingAs($admin)->patch(route('account-management.update-role', $admin), [
        'role' => 'Employee',
    ]);

    $response->assertSessionHasErrors('role');
    expect($admin->fresh()->role)->toBe('Admin');
});

test('can demote an admin user when more than one admin exists', function () {
    $admin = User::factory()->create([
        'role' => 'Admin',
    ]);

    $targetAdmin = User::factory()->create([
        'role' => 'Admin',
    ]);

    $response = $this->actingAs($admin)->patch(route('account-management.update-role', $targetAdmin), [
        'role' => 'Employee',
    ]);

    $response->assertRedirect();
    expect($targetAdmin->fresh()->role)->toBe('Employee');
});

test('admin can delete another user', function () {
    $admin = User::factory()->create([
        'role' => 'Admin',
    ]);

    $targetUser = User::factory()->create();

    $response = $this->actingAs($admin)->delete(route('account-management.destroy', $targetUser));

    $response->assertRedirect();
    $this->assertDatabaseMissing('users', [
        'id' => $targetUser->id,
    ]);
});
