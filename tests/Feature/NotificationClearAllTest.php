<?php

use App\Models\User;
use Illuminate\Support\Str;

test('user can clear all unread notifications without affecting read or other users notifications', function () {
    $user = User::factory()->create([
        'role' => 'Employee',
    ]);
    $otherUser = User::factory()->create([
        'role' => 'Employee',
    ]);

    $unreadNotification = $user->notifications()->create([
        'id' => (string) Str::uuid(),
        'type' => 'test',
        'data' => ['title' => 'Unread notification'],
    ]);
    $readAt = now()->subDay();
    $readNotification = $user->notifications()->create([
        'id' => (string) Str::uuid(),
        'type' => 'test',
        'data' => ['title' => 'Read notification'],
        'read_at' => $readAt,
    ]);
    $otherUsersNotification = $otherUser->notifications()->create([
        'id' => (string) Str::uuid(),
        'type' => 'test',
        'data' => ['title' => 'Another user notification'],
    ]);

    $response = $this->actingAs($user)->postJson(route('notifications.clear'));

    $response->assertOk()->assertJson(['success' => true]);
    expect($unreadNotification->fresh()->read_at)->not->toBeNull()
        ->and($readNotification->fresh()->read_at->toDateTimeString())->toBe($readAt->toDateTimeString())
        ->and($otherUsersNotification->fresh()->read_at)->toBeNull();
});
