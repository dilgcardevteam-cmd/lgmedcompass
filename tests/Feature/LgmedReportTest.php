<?php

use App\Models\LgmedReport;
use App\Models\User;

test('guests are redirected to login', function () {
    $this->get(route('lgmed-reports.index'))->assertRedirect(route('login'));
});

test('employee can create, update and delete a report', function () {
    $user = User::factory()->create(['role' => 'Employee']);

    $this->actingAs($user)
        ->post(route('lgmed-reports.store'), ['ppa' => 'Sample PPA', 'frequency' => 'Annual', 'is_active' => '1'])
        ->assertRedirect(route('lgmed-reports.index'));

    $report = LgmedReport::query()->where('ppa', 'Sample PPA')->firstOrFail();
    expect($report->created_by)->toBe($user->id);

    $this->actingAs($user)
        ->put(route('lgmed-reports.update', $report), ['ppa' => 'Updated PPA', 'is_active' => '0'])
        ->assertRedirect(route('lgmed-reports.index'));

    expect($report->fresh()->ppa)->toBe('Updated PPA')
        ->and($report->fresh()->is_active)->toBeFalse();

    $this->actingAs($user)->delete(route('lgmed-reports.destroy', $report))->assertRedirect();
    $this->assertModelMissing($report);
});

test('ppa is required', function () {
    $user = User::factory()->create(['role' => 'Admin']);

    $this->actingAs($user)
        ->post(route('lgmed-reports.store'), ['ppa' => ''])
        ->assertSessionHasErrors('ppa');
});

test('technical inspector can view but not modify', function () {
    $user = User::factory()->create(['role' => 'Technical Inspector']);
    $report = LgmedReport::factory()->create();

    $this->actingAs($user)->get(route('lgmed-reports.index'))->assertOk()->assertSeeText($report->ppa);
    $this->actingAs($user)->get(route('lgmed-reports.show', $report))->assertOk();
    $this->actingAs($user)->get(route('lgmed-reports.index'))->assertDontSee('id="lrFormDialog"', false);
    $this->actingAs($user)->post(route('lgmed-reports.store'), ['ppa' => 'Blocked']);
    $this->actingAs($user)->delete(route('lgmed-reports.destroy', $report));

    expect(LgmedReport::query()->where('ppa', 'Blocked')->exists())->toBeFalse();
    $this->assertModelExists($report);
});

test('multiple focal persons are stored one per line and custom frequency is saved', function () {
    $user = User::factory()->create(['role' => 'Admin']);

    $this->actingAs($user)->post(route('lgmed-reports.store'), [
        'ppa' => 'Multi PPA',
        'frequency' => 'Others - specify',
        'frequency_other' => 'Every 2 weeks',
        'focal_person' => ['LGOO V Allan F. Ocal', 'LGOO V Lala G. Geron'],
    ])->assertRedirect(route('lgmed-reports.index'));

    $report = LgmedReport::query()->where('ppa', 'Multi PPA')->firstOrFail();
    expect($report->focal_person)->toBe("LGOO V Allan F. Ocal\nLGOO V Lala G. Geron")
        ->and($report->frequency)->toBe('Every 2 weeks');
});

test('others frequency requires a specified value', function () {
    $user = User::factory()->create(['role' => 'Admin']);

    $this->actingAs($user)
        ->post(route('lgmed-reports.store'), ['ppa' => 'X', 'frequency' => 'Others - specify'])
        ->assertSessionHasErrors('frequency_other');
});

test('search and filters combine', function () {
    $user = User::factory()->create(['role' => 'Employee']);
    LgmedReport::factory()->create(['ppa' => 'Alpha Report', 'section' => 'LG-RPCS', 'frequency' => 'Annual']);
    LgmedReport::factory()->create(['ppa' => 'Alpha Other', 'section' => 'LG-PMRAS', 'frequency' => 'Annual']);
    LgmedReport::factory()->create(['ppa' => 'Beta Report', 'section' => 'LG-RPCS', 'frequency' => 'Annual']);

    $this->actingAs($user)
        ->get(route('lgmed-reports.index', ['search' => 'Alpha', 'section' => 'LG-RPCS', 'frequency' => 'Annual']))
        ->assertOk()
        ->assertSeeText('Alpha Report')
        ->assertDontSeeText('Alpha Other')
        ->assertDontSeeText('Beta Report');
});

test('index is paginated', function () {
    $user = User::factory()->create(['role' => 'Employee']);
    LgmedReport::factory()->count(20)->create();

    $this->actingAs($user)->get(route('lgmed-reports.index'))->assertOk();
    expect(LgmedReport::query()->count())->toBe(20);
});

test('guests can view active reports publicly with search and filters', function () {
    LgmedReport::factory()->create(['ppa' => 'Public Alpha', 'section' => 'LG-RPCS', 'is_active' => true]);
    LgmedReport::factory()->create(['ppa' => 'Public Beta', 'section' => 'LG-PMRAS', 'is_active' => true]);
    LgmedReport::factory()->create(['ppa' => 'Hidden Inactive', 'is_active' => false]);

    $this->get(route('public.lgmed-reports.index'))
        ->assertOk()
        ->assertSee('Public Alpha')
        ->assertSee('Public Beta')
        ->assertDontSee('Hidden Inactive')
        ->assertDontSee('data-lr-add', false)
        ->assertDontSee('data-lr-edit', false);

    $this->get(route('public.lgmed-reports.index', ['search' => 'Alpha', 'section' => 'LG-RPCS']))
        ->assertSee('Public Alpha')
        ->assertDontSee('Public Beta');
});

test('guests can view an active report detail but not an inactive one', function () {
    $active = LgmedReport::factory()->create(['ppa' => 'Visible Detail', 'is_active' => true]);
    $inactive = LgmedReport::factory()->create(['is_active' => false]);

    $this->get(route('public.lgmed-reports.show', $active))->assertOk()->assertSee('Visible Detail');
    $this->get(route('public.lgmed-reports.show', $inactive))->assertNotFound();
});

test('guests cannot write reports', function () {
    $report = LgmedReport::factory()->create();

    $this->post(route('lgmed-reports.store'), ['ppa' => 'Nope'])->assertRedirect(route('login'));
    $this->delete(route('lgmed-reports.destroy', $report))->assertRedirect(route('login'));
    $this->assertModelExists($report);
});
