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
        ->assertSee('id="ppaAdminFabToggle"', false)
        ->assertSee('id="ppaDeleteProjectDialog"', false)
        ->assertSee('Save project details');

    $employee = User::factory()->create(['role' => 'Employee']);

    $this->actingAs($employee)
        ->get(route('ppa.section', 'lgrpcs'))
        ->assertOk()
        ->assertDontSee('id="ppaAdminFabToggle"', false)
        ->assertDontSee('id="ppaDeleteProjectDialog"', false)
        ->assertDontSee('Save project details');
});

test('QMS projects are available from the public PPA section', function () {
    $projectNames = [
        'QP 01 BODBA',
        'QP 02 APMV',
        'QP 03 FTA',
        'QP 04 FDP',
        'QP 05 Confidential Funds',
        'QP 06 CSC Service Rendered',
        'QP 07 Cert of Incumbency',
        'QP 43 LTIA',
        'QP 44 Seal of Good Local Governance (SGLG) Assessment Shared Folder',
    ];

    $this->get(route('landingpage.qms'))
        ->assertOk()
        ->assertDontSee('id="loading-screen"')
        ->assertSee('class="header-section"', false)
        ->assertSee('class="modern-grid"', false)
        ->assertSee('<footer', false)
        ->assertSee('id="navLinks"', false)
        ->assertSeeText('Quality Management System')
        ->assertSeeTextInOrder($projectNames);
});

test('admins can update project names, descriptions, and external links', function () {
    $admin = User::factory()->create(['role' => 'Admin']);
    $project = PpaProject::query()->where('section_code', 'dsu')->firstOrFail();

    $this->actingAs($admin)
        ->put(route('ppa.project.update', $project), [
            'name' => 'Updated DSU Project',
            'description' => 'Updated project description.',
            'external_url' => 'https://drive.google.com/example',
        ])
        ->assertRedirect(route('ppa.section', 'dsu'));

    $updatedProject = $project->fresh();

    expect($updatedProject->name)->toBe('Updated DSU Project')
        ->and($updatedProject->description)->toBe('Updated project description.')
        ->and($updatedProject->external_url)->toBe('https://drive.google.com/example');
});

test('admins can add a project to a PPA section', function () {
    $admin = User::factory()->create(['role' => 'Admin']);

    $this->actingAs($admin)
        ->post(route('ppa.project.store', 'dsu'), [
            'name' => 'New Data Services Project',
            'description' => 'A newly added project.',
            'external_url' => 'https://drive.google.com/new-project',
        ])
        ->assertRedirect(route('ppa.section', 'dsu'));

    $project = PpaProject::query()
        ->where('section_code', 'dsu')
        ->where('name', 'New Data Services Project')
        ->firstOrFail();

    expect($project->description)->toBe('A newly added project.')
        ->and($project->external_url)->toBe('https://drive.google.com/new-project');

    $this->assertDatabaseHas('ppa_projects', [
        'id' => $project->id,
        'is_active' => true,
    ]);
});

test('admins can permanently delete a project', function () {
    $admin = User::factory()->create(['role' => 'Admin']);
    $project = PpaProject::query()->where('section_code', 'dsu')->firstOrFail();

    $this->actingAs($admin)
        ->delete(route('ppa.project.destroy', $project))
        ->assertRedirect(route('ppa.section', 'dsu'));

    $this->assertDatabaseMissing('ppa_projects', [
        'id' => $project->id,
    ]);
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

test('employees cannot add or delete PPA projects', function () {
    $employee = User::factory()->create(['role' => 'Employee']);
    $project = PpaProject::query()->where('section_code', 'dsu')->firstOrFail();

    $this->actingAs($employee)
        ->post(route('ppa.project.store', 'dsu'), [
            'name' => 'Unauthorized project',
            'description' => 'Should not be saved.',
        ])
        ->assertForbidden();

    $this->delete(route('ppa.project.destroy', $project))
        ->assertForbidden();

    $this->assertDatabaseMissing('ppa_projects', [
        'name' => 'Unauthorized project',
        'section_code' => 'dsu',
    ]);
    $this->assertDatabaseHas('ppa_projects', [
        'id' => $project->id,
    ]);
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
