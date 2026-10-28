<?php

use App\Models\DocumentProcess;
use App\Models\Section;
use App\Models\User;

function documentWorkflowUploadPayload(Section $section, string $typeOfPaper, ?string $otherType = null): array
{
    return [
        'subject_title' => 'Regional Meeting',
        'focal_person' => 'Jordan Lee',
        'section' => $section->id,
        'type_of_paper' => $typeOfPaper,
        'type_of_paper_other' => $otherType,
    ];
}

test('document process upload stores a specified other paper type', function () {
    $section = Section::create(['name' => 'Planning']);
    $user = User::factory()->create([
        'section_id' => $section->id,
        'role' => 'Employee',
    ]);

    $this->actingAs($user)
        ->post(route('documents.quick-store'), documentWorkflowUploadPayload($section, 'Others', 'Travel Order'))
        ->assertRedirect(route('documents.my-tasks'));

    $documentProcess = DocumentProcess::query()->firstOrFail();

    expect($documentProcess->type_of_paper)->toBe('Others')
        ->and($documentProcess->type_of_paper_other)->toBe('Travel Order');
});

test('document process upload requires a paper type specification when others is selected', function () {
    $section = Section::create(['name' => 'Planning']);
    $user = User::factory()->create([
        'section_id' => $section->id,
        'role' => 'Employee',
    ]);

    $this->actingAs($user)
        ->from(route('documents.my-tasks'))
        ->post(route('documents.quick-store'), documentWorkflowUploadPayload($section, 'Others'))
        ->assertSessionHasErrors('type_of_paper_other');
});
