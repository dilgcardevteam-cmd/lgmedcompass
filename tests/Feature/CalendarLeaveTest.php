<?php

use App\Models\Event;
use App\Models\Section;
use App\Models\User;

function createCalendarLeaveTestUser(Section $section, string $firstName, string $lastName): User
{
    return User::factory()->create([
        'first_name' => $firstName,
        'last_name' => $lastName,
        'username' => fake()->unique()->userName(),
        'position' => 'Staff',
        'section_id' => $section->id,
        'role' => 'Admin',
    ]);
}

function calendarLeaveData(array $focalPersonIds, string $leaveType = 'Vacation Leave', ?string $other = null): array
{
    return [
        'type' => 'leave',
        'visibility_type' => 'global',
        'leave_type' => $leaveType,
        'leave_type_other' => $other,
        'start_date' => '2026-10-28 08:00:00',
        'end_date' => '2026-10-28 17:00:00',
        'focal_person_ids' => $focalPersonIds,
    ];
}

test('leave can be created with a leave type and multiple focal persons', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarLeaveTestUser($section, 'Casey', 'Creator');
    $firstFocalPerson = createCalendarLeaveTestUser($section, 'Taylor', 'First');
    $secondFocalPerson = createCalendarLeaveTestUser($section, 'Jordan', 'Second');

    $calendarPage = $this->actingAs($creator)
        ->get(route('calendar.index'))
        ->assertOk();

    foreach (Event::LEAVE_TYPES as $leaveType) {
        $calendarPage->assertSeeText($leaveType);
    }

    $this->actingAs($creator)
        ->postJson('/calendar/events', calendarLeaveData([
            $firstFocalPerson->id,
            $secondFocalPerson->id,
        ]))
        ->assertCreated();

    $event = Event::query()->firstOrFail();

    expect($event->leave_type)->toBe('Vacation Leave')
        ->and($event->title)->toBe('Vacation Leave')
        ->and($event->leave_type_other)->toBeNull()
        ->and($event->focalPersonIds())->toBe([$firstFocalPerson->id, $secondFocalPerson->id]);

    $this->actingAs($creator)
        ->getJson("/calendar/events/{$event->id}")
        ->assertOk()
        ->assertJsonPath('title', 'Vacation Leave')
        ->assertJsonPath('leave_type', 'Vacation Leave')
        ->assertJsonPath('focal_person_names', ['Taylor First', 'Jordan Second']);

    $this->actingAs($creator)
        ->getJson('/calendar/events')
        ->assertOk()
        ->assertJsonPath('0.title', 'Vacation Leave');
});

test('other leave type requires a specification', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarLeaveTestUser($section, 'Casey', 'Creator');
    $focalPerson = createCalendarLeaveTestUser($section, 'Taylor', 'First');

    $this->actingAs($creator)
        ->postJson('/calendar/events', calendarLeaveData([
            $focalPerson->id,
        ], 'Others, specify'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors('leave_type_other');
});

test('leave focal persons and type can be updated', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarLeaveTestUser($section, 'Casey', 'Creator');
    $firstFocalPerson = createCalendarLeaveTestUser($section, 'Taylor', 'First');
    $secondFocalPerson = createCalendarLeaveTestUser($section, 'Jordan', 'Second');

    $event = Event::create([
        'title' => 'Annual Leave Request',
        'type' => 'leave',
        'leave_type' => 'Vacation Leave',
        'start_date' => '2026-10-28 08:00:00',
        'end_date' => '2026-10-28 17:00:00',
        'section_id' => $section->id,
        'focal_person_id' => $firstFocalPerson->id,
        'visibility_type' => 'section',
        'user_id' => $creator->id,
    ]);
    $event->focalPersons()->sync([$firstFocalPerson->id]);

    $this->actingAs($creator)
        ->putJson("/calendar/events/{$event->id}", calendarLeaveData([
            $firstFocalPerson->id,
            $secondFocalPerson->id,
        ], 'Others, specify', 'Family care leave'))
        ->assertOk();

    $updatedEvent = $event->fresh();

    expect($updatedEvent->leave_type)->toBe('Others, specify')
        ->and($updatedEvent->title)->toBe('Family care leave')
        ->and($updatedEvent->leave_type_other)->toBe('Family care leave')
        ->and($updatedEvent->focalPersonIds())->toBe([$firstFocalPerson->id, $secondFocalPerson->id]);
});
