<?php

use App\Models\PpaProject;
use App\Models\User;

test('public landing and authenticated PPA view use the same project records', function () {
    $project = PpaProject::query()->where('section_code', 'lgrpcs')->firstOrFail();

    $this->get(route('landingpage.lgrpcs'))
        ->assertOk()
        ->assertSeeText($project->name)
        ->assertSeeText($project->description)
        ->assertSee($project->external_url);

    $admin = User::factory()->create(['role' => 'Admin']);

    $this->actingAs($admin)
        ->get(route('ppa.section', 'lgrpcs'))
        ->assertOk()
        ->assertSeeText($project->name)
        ->assertSeeText($project->description)
        ->assertSee($project->external_url)
        ->assertSee('Save project details');

    $employee = User::factory()->create(['role' => 'Employee']);

    $this->actingAs($employee)
        ->get(route('ppa.section', 'lgrpcs'))
        ->assertOk()
        ->assertDontSee('Save project details');
});

test('admins can update project descriptions and external links', function () {
    $admin = User::factory()->create(['role' => 'Admin']);
    $project = PpaProject::query()->where('section_code', 'dsu')->firstOrFail();

    $this->actingAs($admin)
        ->put(route('ppa.project.update', $project), [
            'description' => 'Updated project description.',
            'external_url' => 'https://drive.google.com/example',
        ])
        ->assertRedirect(route('ppa.section', 'dsu'));

    $updatedProject = $project->fresh();

    expect($updatedProject->description)->toBe('Updated project description.')
        ->and($updatedProject->external_url)->toBe('https://drive.google.com/example');
});

test('employees cannot update project details', function () {
    $employee = User::factory()->create(['role' => 'Employee']);
    $project = PpaProject::query()->where('section_code', 'dsu')->firstOrFail();

    $this->actingAs($employee)
        ->put(route('ppa.project.update', $project), [
            'description' => 'Should not be saved.',
            'external_url' => 'https://drive.google.com/example',
        ])
        ->assertForbidden();

    expect($project->fresh()->description)->not->toBe('Should not be saved.');
});

test('other authenticated roles cannot update project details', function () {
    $user = User::factory()->create(['role' => 'User']);
    $project = PpaProject::query()->where('section_code', 'dsu')->firstOrFail();

    $this->actingAs($user)
        ->put(route('ppa.project.update', $project), [
            'description' => 'Should not be saved.',
            'external_url' => 'https://drive.google.com/example',
        ])
        ->assertForbidden();

    expect($project->fresh()->description)->not->toBe('Should not be saved.');
});

test('PPA upload endpoints are no longer available', function () {
    $user = User::factory()->create(['role' => 'Admin']);

    $this->actingAs($user)
        ->postJson('/ppa/upload')
        ->assertMethodNotAllowed();
});
