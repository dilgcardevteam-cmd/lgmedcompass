<?php

use App\Models\Document;
use App\Models\Section;
use App\Models\User;

dataset('document frequencies and deadline counts', [
    'weekly' => ['weekly', 52],
    'bi-monthly' => ['bi-monthly', 24],
    'monthly' => ['monthly', 12],
    'quarterly' => ['quarterly', 4],
    'semestral' => ['semestral', 2],
    'annual' => ['annual', 1],
    'as-needed' => ['as-needed', 1],
]);

test('document submissions support each frequency and optional reporting deadlines', function (string $frequency, int $deadlineCount) {
    $section = Section::create(['name' => 'Test Section']);
    $user = User::factory()->create(['section_id' => $section->id, 'role' => 'Employee']);
    $deadlines = collect(range(0, $deadlineCount - 1))
        ->map(fn (int $week) => now()->addWeeks($week)->toDateString())
        ->all();

    $response = $this->actingAs($user)->post(route('documents.store'), [
        'subject_title' => 'Frequency test',
        'section' => $section->id,
        'frequency' => $frequency,
        'focal_person' => $user->name,
        'deadlines' => $deadlines,
    ]);

    $response->assertRedirect(route('documents.index'));

    $document = Document::query()->where('subject_title', 'Frequency test')->firstOrFail();

    expect($document->frequency)->toBe($frequency)
        ->and($document->schedules()->count())->toBe($deadlineCount);
})->with('document frequencies and deadline counts');

test('document submission succeeds with no reporting deadlines', function () {
    $section = Section::create(['name' => 'Test Section']);
    $user = User::factory()->create(['section_id' => $section->id, 'role' => 'Employee']);

    $response = $this->actingAs($user)->post(route('documents.store'), [
        'subject_title' => 'No deadline test',
        'section' => $section->id,
        'frequency' => 'monthly',
        'focal_person' => $user->name,
    ]);

    $response->assertRedirect(route('documents.index'));

    $document = Document::query()->where('subject_title', 'No deadline test')->firstOrFail();

    expect($document->schedules()->count())->toBe(0);
});

test('document submissions save multiple who will comply selections and the other specification', function () {
    $section = Section::create(['name' => 'Test Section']);
    $user = User::factory()->create(['section_id' => $section->id, 'role' => 'Employee']);

    $response = $this->actingAs($user)->post(route('documents.store'), [
        'subject_title' => 'Compliance options test',
        'section' => $section->id,
        'frequency' => 'monthly',
        'focal_person' => $user->name,
        'who_will_comply' => ['LGU', 'Others'],
        'who_will_comply_other' => 'Partner agency',
    ]);

    $response->assertRedirect(route('documents.index'));

    $document = Document::query()->where('subject_title', 'Compliance options test')->firstOrFail();

    expect($document->who_will_comply)->toBe(['LGU', 'Others'])
        ->and($document->who_will_comply_other)->toBe('Partner agency');
});

test('document submission requires a specification when others will comply', function () {
    $section = Section::create(['name' => 'Test Section']);
    $user = User::factory()->create(['section_id' => $section->id, 'role' => 'Employee']);

    $response = $this->actingAs($user)->post(route('documents.store'), [
        'subject_title' => 'Missing other specification',
        'section' => $section->id,
        'frequency' => 'monthly',
        'focal_person' => $user->name,
        'who_will_comply' => ['Others'],
    ]);

    $response->assertSessionHasErrors('who_will_comply_other');
});
