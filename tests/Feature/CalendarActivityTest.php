<?php

use App\Models\Event;
use App\Models\Section;
use App\Models\User;

function createCalendarActivityTestUser(Section $section): User
{
    return User::factory()->create([
        'first_name' => 'Casey',
        'last_name' => 'Creator',
        'username' => fake()->unique()->userName(),
        'position' => 'Staff',
        'section_id' => $section->id,
        'role' => 'Admin',
    ]);
}

function calendarActivityData(string $activityType = 'Meeting', ?string $other = null): array
{
    return [
        'title' => 'Regional Planning Workshop',
        'type' => 'event',
        'activity_type' => $activityType,
        'activity_type_other' => $other,
        'visibility_type' => 'private',
        'start_date' => '2026-10-28 08:00:00',
        'end_date' => '2026-10-28 17:00:00',
    ];
}

test('activities display their type beside the subject in the calendar', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarActivityTestUser($section);

    $this->actingAs($creator)
        ->postJson('/calendar/events', calendarActivityData())
        ->assertCreated();

    $event = Event::query()->firstOrFail();

    expect($event->activity_type)->toBe('Meeting')
        ->and($event->calendar_title)->toBe('Meeting: Regional Planning Workshop');

    $this->actingAs($creator)
        ->getJson('/calendar/events')
        ->assertOk()
        ->assertJsonPath('0.title', 'Meeting: Regional Planning Workshop')
        ->assertJsonPath('0.subject', 'Regional Planning Workshop')
        ->assertJsonPath('0.activity_type', 'Meeting');

    $this->actingAs($creator)
        ->getJson("/calendar/events/{$event->id}")
        ->assertOk()
        ->assertJsonPath('title', 'Meeting: Regional Planning Workshop')
        ->assertJsonPath('subject', 'Regional Planning Workshop');
});

test('other activity types require a custom label which is displayed with the subject', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarActivityTestUser($section);

    $this->actingAs($creator)
        ->postJson('/calendar/events', calendarActivityData('Others, specify'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors('activity_type_other');

    $this->actingAs($creator)
        ->postJson('/calendar/events', calendarActivityData('Others, specify', 'Consultation'))
        ->assertCreated();

    $event = Event::query()->firstOrFail();

    expect($event->activity_type_other)->toBe('Consultation')
        ->and($event->calendar_title)->toBe('Consultation: Regional Planning Workshop');
});
