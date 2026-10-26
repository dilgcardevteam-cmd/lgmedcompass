<?php

use App\Models\User;

test('authenticated user can submit an all day calendar event', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/calendar/events', [
        'title' => 'Planning Day',
        'type' => 'Event',
        'start_date' => '2026-03-05 00:00:00',
        'end_date' => '2026-03-05 23:59:59',
        'location' => 'Main Office',
        'notes' => 'Quarterly planning',
    ]);

    $response->assertOk();
    $this->assertDatabaseHas('events', [
        'title' => 'Planning Day',
        'type' => 'Event',
        'location' => 'Main Office',
    ]);
});

test('calendar event submission requires type and valid dates', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/calendar/events', [
        'title' => 'Broken Event',
        'start_date' => 'not-a-date',
        'end_date' => '2026-03-05 23:59:59',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['type', 'start_date']);
});
