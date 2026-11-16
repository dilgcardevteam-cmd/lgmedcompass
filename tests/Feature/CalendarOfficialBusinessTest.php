<?php

use App\Models\Event;
use App\Models\Section;
use App\Models\User;

function createCalendarUser(Section $section, string $firstName, string $lastName): User
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

function officialBusinessData(array $focalPersonIds): array
{
    return [
        'title' => 'Regional Planning Meeting',
        'type' => 'official_business',
        'visibility_type' => 'global',
        'location' => 'Main Office',
        'start_date' => '2026-10-28 08:00:00',
        'end_date' => '2026-10-28 17:00:00',
        'focal_person_ids' => $focalPersonIds,
    ];
}

test('official business can be assigned to multiple focal persons', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarUser($section, 'Casey', 'Creator');
    $firstFocalPerson = createCalendarUser($section, 'Taylor', 'First');
    $secondFocalPerson = createCalendarUser($section, 'Jordan', 'Second');

    $response = $this->actingAs($creator)->postJson('/calendar/events', officialBusinessData([
        $firstFocalPerson->id,
        $secondFocalPerson->id,
    ]));

    $response->assertCreated();
    $event = Event::query()->firstOrFail();

    expect($event->focalPersonIds())->toBe([$firstFocalPerson->id, $secondFocalPerson->id]);

    $this->actingAs($creator)
        ->getJson("/calendar/events/{$event->id}")
        ->assertOk()
        ->assertJsonPath('focal_person', 'Taylor First, Jordan Second')
        ->assertJsonPath('focal_person_names', ['Taylor First', 'Jordan Second'])
        ->assertJsonPath('focal_person_ids', [$firstFocalPerson->id, $secondFocalPerson->id]);

    $this->actingAs($creator)
        ->getJson('/calendar/events')
        ->assertOk()
        ->assertJsonPath('0.personnel', ['Casey Creator', 'Taylor First', 'Jordan Second']);
});

test('official business focal persons can be updated', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarUser($section, 'Casey', 'Creator');
    $firstFocalPerson = createCalendarUser($section, 'Taylor', 'First');
    $secondFocalPerson = createCalendarUser($section, 'Jordan', 'Second');

    $event = Event::create([
        'title' => 'Regional Planning Meeting',
        'type' => 'official_business',
        'location' => 'Main Office',
        'start_date' => '2026-10-28 08:00:00',
        'end_date' => '2026-10-28 17:00:00',
        'focal_person_id' => $firstFocalPerson->id,
        'section_id' => $section->id,
        'visibility_type' => 'section',
        'user_id' => $creator->id,
    ]);
    $event->focalPersons()->sync([$firstFocalPerson->id]);

    $this->actingAs($creator)
        ->putJson("/calendar/events/{$event->id}", officialBusinessData([
            $firstFocalPerson->id,
            $secondFocalPerson->id,
        ]))
        ->assertOk();

    expect($event->fresh()->focalPersonIds())->toBe([$firstFocalPerson->id, $secondFocalPerson->id]);
});

test('official business requires at least one focal person', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarUser($section, 'Casey', 'Creator');

    $this->actingAs($creator)
        ->postJson('/calendar/events', officialBusinessData([]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors('focal_person_ids');
});

test('off site is no longer an event type', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarUser($section, 'Casey', 'Creator');
    $focalPerson = createCalendarUser($section, 'Taylor', 'Focal');

    $this->actingAs($creator)
        ->postJson('/calendar/events', [
            ...officialBusinessData([$focalPerson->id]),
            'type' => 'offsite',
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('type');
});

test('legacy off site events are displayed and saved as official business', function () {
    $section = Section::create(['name' => 'Planning']);
    $creator = createCalendarUser($section, 'Casey', 'Creator');
    $focalPerson = createCalendarUser($section, 'Taylor', 'Focal');
    $event = Event::create([
        'title' => 'Regional Planning Meeting',
        'type' => 'offsite',
        'location' => 'Main Office',
        'start_date' => '2026-10-28 08:00:00',
        'end_date' => '2026-10-28 17:00:00',
        'focal_person_id' => $focalPerson->id,
        'section_id' => $section->id,
        'visibility_type' => 'section',
        'user_id' => $creator->id,
    ]);

    $this->actingAs($creator)
        ->getJson("/calendar/events/{$event->id}")
        ->assertOk()
        ->assertJsonPath('type', 'official_business');

    $this->actingAs($creator)
        ->putJson("/calendar/events/{$event->id}", officialBusinessData([$focalPerson->id]))
        ->assertOk();

    expect($event->fresh()->type)->toBe('official_business');
});
