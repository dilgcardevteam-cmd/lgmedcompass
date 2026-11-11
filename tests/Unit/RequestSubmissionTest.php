<?php

use App\Models\ServiceRequest;
use App\Models\User;
use App\Notifications\ServiceRequestReceived;
use App\Notifications\ServiceRequestWorkflowUpdate;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

uses(Tests\TestCase::class);

beforeEach(function () {
    Schema::create('sections', function (Blueprint $table): void {
        $table->id();
        $table->string('name');
    });

    Schema::create('users', function (Blueprint $table): void {
        $table->id();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('email')->nullable();
        $table->foreignId('section_id')->nullable();
        $table->string('role')->nullable();
        $table->boolean('is_approved')->default(false);
        $table->timestamp('email_verified_at')->nullable();
        $table->softDeletes();
    });

    $notificationsMigration = require base_path('database/migrations/2026_03_11_084227_create_notifications_table.php');
    $notificationsMigration->up();
    $migration = require base_path('database/migrations/2026_11_10_084521_create_service_requests_table.php');
    $migration->up();
    $routingMigration = require base_path('database/migrations/2026_11_10_092545_add_analysis_routing_fields_to_service_requests_table.php');
    $routingMigration->up();
    $workflowMigration = require base_path('database/migrations/2026_11_10_095911_add_workflow_fields_to_service_requests_table.php');
    $workflowMigration->up();
    $deliverablesMigration = require base_path('database/migrations/2026_11_10_102500_add_completion_deliverables_to_service_requests_table.php');
    $deliverablesMigration->up();
    $requesterArchiveMigration = require base_path('database/migrations/2026_11_10_172104_add_requester_archive_timestamp_to_service_requests_table.php');
    $requesterArchiveMigration->up();
});

afterEach(function () {
    Schema::dropIfExists('service_request_deliverables');
    Schema::dropIfExists('service_requests');
    Schema::dropIfExists('notifications');
    Schema::dropIfExists('users');
    Schema::dropIfExists('sections');
});

test('a guest can submit a request with an optional private attachment', function () {
    Storage::fake('local');
    Notification::fake();

    $this->post(route('request.store'), [
        'requester_name' => 'Taylor Requester',
        'office_address' => 'Cordillera Administrative Region',
        'contact_number' => '09171234567',
        'email' => 'taylor@example.com',
        'service_type' => ServiceRequest::SERVICE_TYPE_OTHERS,
        'other_service_type' => 'Statistical consultation',
        'subject' => 'Request for assistance',
        'description' => 'Please provide assistance with this request.',
        'date_needed' => now()->addDays(3)->toDateString(),
        'document_link' => 'https://example.com/reference',
        'attachment' => UploadedFile::fake()->createWithContent('supporting-document.pdf', "%PDF-1.4\nTest attachment"),
    ])
        ->assertRedirect(route('request.index'))
        ->assertSessionHas('success')
        ->assertSessionHas('request_reference');

    $serviceRequest = ServiceRequest::query()->where('email', 'taylor@example.com')->firstOrFail();

    expect($serviceRequest->requester_user_id)->toBeNull()
        ->and($serviceRequest->requester_name)->toBe('Taylor Requester')
        ->and($serviceRequest->service_type)->toBe(ServiceRequest::SERVICE_TYPE_OTHERS)
        ->and($serviceRequest->other_service_type)->toBe('Statistical consultation')
        ->and($serviceRequest->target_section_id)->toBeNull()
        ->and($serviceRequest->status)->toBe(ServiceRequest::STATUS_RECEIVED)
        ->and($serviceRequest->requested_at)->not->toBeNull()
        ->and($serviceRequest->attachment_path)->not->toBeNull();

    Storage::disk('local')->assertExists($serviceRequest->attachment_path);
    $this->get(route('request.track', $serviceRequest->tracking_token))
        ->assertOk()
        ->assertSeeText('Request for assistance');
    Notification::assertSentOnDemand(ServiceRequestWorkflowUpdate::class);
});

test('guest tracking success confirmations are configured to fade and dismiss', function () {
    $serviceRequest = ServiceRequest::factory()->create();

    $this->withSession(['success' => 'Your response has been sent.'])
        ->get(route('request.track', $serviceRequest->tracking_token))
        ->assertOk()
        ->assertSee('data-auto-dismiss="5000"', false)
        ->assertSee('transition-opacity duration-500', false)
        ->assertSee("document.querySelectorAll('[data-auto-dismiss]')", false);
});

test('request workflow emails use a branded layout with request details and a plain text alternative', function () {
    $trackingToken = str_repeat('a', 64);
    $serviceRequest = ServiceRequest::factory()->create([
        'requester_name' => 'Taylor Requester',
        'subject' => 'Data review request',
        'service_type' => ServiceRequest::SERVICE_TYPE_OTHERS,
        'other_service_type' => 'Statistical consultation',
        'status' => ServiceRequest::STATUS_COMPLETED,
        'last_comment' => 'Your results are ready.',
        'deliverable_link' => 'https://example.com/results',
        'tracking_token' => $trackingToken,
    ]);

    $mail = (new ServiceRequestWorkflowUpdate(
        $serviceRequest,
        'Your request is complete',
        'The requested work has been completed.'
    ))->toMail(new AnonymousNotifiable);
    $html = $mail->render();
    $text = app('mailer')->render($mail->view['text'], $mail->data());

    expect($mail->subject)->toBe('Your request is complete')
        ->and($html)->toContain('LGMED Compass')
        ->and($html)->toContain('REQ-'.now()->format('Y').'-'.str_pad((string) $serviceRequest->id, 6, '0', STR_PAD_LEFT))
        ->and($html)->toContain('Your results are ready.')
        ->and($html)->toContain('https://example.com/results')
        ->and($html)->toContain(route('request.track', $trackingToken))
        ->and($text)->toContain('Data review request')
        ->and($text)->toContain(route('request.track', $trackingToken));
});

test('a signed-in request uses the authenticated name and email', function () {
    DB::table('users')->insert(['id' => 1]);

    $user = new User;
    $user->setAttribute('id', 1);
    $user->setAttribute('first_name', 'Signed');
    $user->setAttribute('last_name', 'In');
    $user->setAttribute('email', 'signed-in@example.com');
    $user->setAttribute('is_approved', true);
    $user->setAttribute('email_verified_at', now());

    $this->actingAs($user)
        ->post(route('request.store'), [
            'requester_name' => 'Spoofed Name',
            'office_address' => 'Cordillera Administrative Region',
            'contact_number' => '09171234567',
            'email' => 'spoofed@example.com',
            'service_type' => ServiceRequest::SERVICE_TYPE_OTHERS,
            'other_service_type' => 'Data report',
            'subject' => 'Request from a signed-in user',
            'description' => 'Please provide assistance with this request.',
            'date_needed' => now()->addDays(3)->toDateString(),
        ])
        ->assertRedirect(route('request.index'));

    $serviceRequest = ServiceRequest::query()->where('requester_user_id', 1)->firstOrFail();

    expect($serviceRequest->requester_name)->toBe('Signed In')
        ->and($serviceRequest->email)->toBe('signed-in@example.com');
});

test('signed-in request entries are collapsed disclosures that can be expanded', function () {
    DB::table('users')->insert([
        'id' => 1,
        'first_name' => 'Taylor',
        'last_name' => 'Requester',
        'email' => 'taylor@example.com',
        'role' => 'Employee',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);
    $user = User::query()->findOrFail(1);
    ServiceRequest::factory()->create([
        'requester_user_id' => $user->id,
        'subject' => 'Collapsed request subject',
    ]);

    $this->actingAs($user)
        ->get(route('request.index', ['tab' => 'my-requests']))
        ->assertOk()
        ->assertSee('<details', false)
        ->assertSee('<summary', false)
        ->assertSeeText('Collapsed request subject');
});

test('requesters can separate active and finished requests and archive their finished requests', function () {
    DB::table('users')->insert([
        'id' => 1,
        'first_name' => 'Taylor',
        'last_name' => 'Requester',
        'email' => 'taylor@example.com',
        'role' => 'Employee',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);
    $user = User::query()->findOrFail(1);
    ServiceRequest::factory()->create([
        'requester_user_id' => $user->id,
        'subject' => 'Active request',
        'status' => ServiceRequest::STATUS_UNDER_REVIEW,
    ]);
    $finishedRequest = ServiceRequest::factory()->create([
        'requester_user_id' => $user->id,
        'subject' => 'Finished request',
        'status' => ServiceRequest::STATUS_COMPLETED,
    ]);
    ServiceRequest::factory()->create([
        'requester_user_id' => $user->id,
        'subject' => 'Declined request',
        'status' => ServiceRequest::STATUS_DECLINED,
    ]);

    $this->actingAs($user)
        ->get(route('request.index', ['tab' => 'my-active']))
        ->assertOk()
        ->assertSeeText('Active Requests')
        ->assertSeeText('Active request')
        ->assertDontSeeText('Finished request')
        ->assertSeeText('Finished Requests');

    $this->get(route('request.index', ['tab' => 'my-finished']))
        ->assertOk()
        ->assertSeeText('Finished request')
        ->assertSeeText('Declined request')
        ->assertDontSeeText('Active request')
        ->assertSeeText('Archive request');

    DB::table('users')->insert([
        'id' => 2,
        'first_name' => 'Other',
        'last_name' => 'Requester',
        'email' => 'other@example.com',
        'role' => 'Employee',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);
    $this->actingAs(User::query()->findOrFail(2))
        ->post(route('request.archive', $finishedRequest))
        ->assertForbidden();

    $this->actingAs($user)
        ->post(route('request.archive', ServiceRequest::query()->where('subject', 'Active request')->firstOrFail()))
        ->assertStatus(409);

    $this->post(route('request.archive', $finishedRequest))
        ->assertRedirect(route('request.index', ['tab' => 'archive']))
        ->assertSessionHas('success');

    $this->get(route('request.index', ['tab' => 'archive']))
        ->assertOk()
        ->assertSeeText('Finished request')
        ->assertViewHas('requestCounts', fn (array $counts): bool => $counts['archive'] === 1
            && $counts['my-finished'] === 1);
});

test('request tabs show scoped counts for my requests, incoming, claimed tasks, and archive', function () {
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'DSU', 'last_name' => 'Staff', 'email' => 'dsu@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
        ['id' => 2, 'first_name' => 'Other', 'last_name' => 'User', 'email' => 'other@example.com', 'section_id' => null, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
    ]);
    $staff = User::query()->findOrFail(1);
    $otherUser = User::query()->findOrFail(2);

    ServiceRequest::factory()->count(2)->create(['requester_user_id' => $staff->id]);
    ServiceRequest::factory()->create([
        'requester_user_id' => $otherUser->id,
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
    ]);
    ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'status' => ServiceRequest::STATUS_UNDER_REVIEW,
    ]);
    ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'status' => ServiceRequest::STATUS_COMPLETED,
    ]);

    $this->actingAs($staff)
        ->get(route('request.index', ['tab' => 'incoming']))
        ->assertOk()
        ->assertViewHas('requestCounts', [
            'my-active' => 0,
            'my-finished' => 0,
            'incoming' => 1,
            'claimed' => 1,
            'archive' => 1,
        ])
        ->assertDontSeeText('New Request')
        ->assertSee('1 requests', false);

    $this->get(route('request.index', ['tab' => 'my-requests']))
        ->assertOk()
        ->assertViewHas('tab', 'incoming')
        ->assertDontSeeText('Active Requests');
});

test('DSU staff can poll for incoming request changes', function () {
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        'id' => 1,
        'first_name' => 'DSU',
        'last_name' => 'Staff',
        'email' => 'dsu@example.com',
        'section_id' => $dsuId,
        'role' => 'Employee',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);
    $staff = User::query()->findOrFail(1);
    $this->actingAs($staff);

    $initialResponse = $this->get(route('request.index', ['tab' => 'incoming']))
        ->assertOk()
        ->assertSeeText('Incoming Requests')
        ->assertDontSeeText('Active Requests')
        ->assertViewHas('requestUpdateSnapshot', fn (array $snapshot): bool => isset($snapshot['incoming'])
            && ! isset($snapshot['my-active']))
        ->assertSee('window.setInterval(checkRequestUpdates, 10000)', false);
    $initialSnapshot = $initialResponse->viewData('requestUpdateSnapshot');

    $this->get(route('request.check-updates'))
        ->assertOk()
        ->assertJsonPath('snapshot', $initialSnapshot);

    ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
    ]);

    $this->get(route('request.check-updates'))
        ->assertOk()
        ->assertJsonPath('snapshot.incoming.Received.count', 1);
});

test('staff outside receiving sections cannot poll incoming requests', function () {
    $sectionId = DB::table('sections')->insertGetId(['name' => 'Support Services Unit']);
    DB::table('users')->insert([
        'id' => 1,
        'first_name' => 'Section',
        'last_name' => 'Staff',
        'email' => 'staff@example.com',
        'section_id' => $sectionId,
        'role' => 'Employee',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);

    $this->actingAs(User::query()->findOrFail(1))
        ->get(route('request.check-updates'))
        ->assertOk()
        ->assertJsonMissingPath('snapshot.incoming');
});

test('request statuses use distinct colors in the signed-in request list', function () {
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        'id' => 1,
        'first_name' => 'DSU',
        'last_name' => 'Staff',
        'email' => 'dsu@example.com',
        'section_id' => $dsuId,
        'role' => 'Employee',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);

    foreach ([
        ServiceRequest::STATUS_RECEIVED,
        ServiceRequest::STATUS_UNDER_REVIEW,
        ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
    ] as $status) {
        ServiceRequest::factory()->create([
            'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
            'target_section_id' => $dsuId,
            'status' => $status,
        ]);
    }

    $this->actingAs(User::query()->findOrFail(1))
        ->get(route('request.index', ['tab' => 'incoming']))
        ->assertOk()
        ->assertSee('bg-sky-100 text-sky-800', false)
        ->assertSee('bg-blue-100 text-blue-800', false)
        ->assertSee('bg-amber-100 text-amber-900', false);

    foreach ([
        ServiceRequest::STATUS_COMPLETED,
        ServiceRequest::STATUS_DECLINED,
    ] as $status) {
        ServiceRequest::factory()->create([
            'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
            'target_section_id' => $dsuId,
            'status' => $status,
        ]);
    }

    $this->get(route('request.index', ['tab' => 'archive']))
        ->assertOk()
        ->assertSee('bg-green-100 text-green-800', false)
        ->assertSee('bg-red-100 text-red-800', false);
});

test('Data Analysis requests save selections and route to the Database and Statistical Unit', function () {
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);

    $this->post(route('request.store'), [
        'requester_name' => 'Taylor Requester',
        'office_address' => 'Cordillera Administrative Region',
        'contact_number' => '09171234567',
        'email' => 'taylor@example.com',
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'analysis_types' => ['Descriptive Analysis', 'Predictive Analysis'],
        'subject' => 'Analysis request',
        'description' => 'Please analyze the attached information.',
        'date_needed' => now()->addDays(3)->toDateString(),
    ])
        ->assertRedirect(route('request.index'));

    $serviceRequest = ServiceRequest::query()->where('subject', 'Analysis request')->firstOrFail();

    expect($serviceRequest->analysis_types)->toBe(['Descriptive Analysis', 'Predictive Analysis'])
        ->and($serviceRequest->target_section_id)->toBe($dsuId)
        ->and($serviceRequest->other_service_type)->toBeNull()
        ->and($serviceRequest->status)->toBe(ServiceRequest::STATUS_RECEIVED);
});

test('Data Analysis requests notify verified DSU staff other than the requester unless their account is pending', function () {
    Notification::fake();
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    $otherSectionId = DB::table('sections')->insertGetId(['name' => 'Support Services Unit']);
    $verifiedAt = now();

    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'Requester', 'last_name' => 'DSU', 'email' => 'requester@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => false, 'email_verified_at' => $verifiedAt],
        ['id' => 2, 'first_name' => 'Recipient', 'last_name' => 'DSU', 'email' => 'recipient@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => false, 'email_verified_at' => $verifiedAt],
        ['id' => 3, 'first_name' => 'Other', 'last_name' => 'Unit', 'email' => 'other@example.com', 'section_id' => $otherSectionId, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => $verifiedAt],
        ['id' => 4, 'first_name' => 'Pending', 'last_name' => 'DSU', 'email' => 'pending@example.com', 'section_id' => $dsuId, 'role' => 'Pending', 'is_approved' => false, 'email_verified_at' => $verifiedAt],
        ['id' => 5, 'first_name' => 'Unverified', 'last_name' => 'DSU', 'email' => 'unverified@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => null],
    ]);

    $requester = User::query()->findOrFail(1);
    $recipient = User::query()->findOrFail(2);
    $otherStaff = User::query()->findOrFail(3);
    $pendingStaff = User::query()->findOrFail(4);
    $unverifiedStaff = User::query()->findOrFail(5);

    $this->actingAs($requester)
        ->post(route('request.store'), [
            'office_address' => 'Cordillera Administrative Region',
            'contact_number' => '09171234567',
            'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
            'analysis_types' => ['Descriptive Analysis'],
            'subject' => 'DSU notification request',
            'description' => 'Please analyze the attached information.',
            'date_needed' => now()->addDays(3)->toDateString(),
        ])
        ->assertRedirect(route('request.index'));

    $serviceRequest = ServiceRequest::query()->where('subject', 'DSU notification request')->firstOrFail();

    Notification::assertSentTo($recipient, ServiceRequestReceived::class, function (ServiceRequestReceived $notification) use ($recipient, $serviceRequest): bool {
        return $notification->toDatabase($recipient)['service_request_id'] === $serviceRequest->id;
    });
    Notification::assertNotSentTo($requester, ServiceRequestReceived::class);
    Notification::assertNotSentTo($otherStaff, ServiceRequestReceived::class);
    Notification::assertNotSentTo($pendingStaff, ServiceRequestReceived::class);
    Notification::assertNotSentTo($unverifiedStaff, ServiceRequestReceived::class);
});

test('Others requests notify verified Admin reviewers unless their account is pending', function () {
    Notification::fake();
    $sectionId = DB::table('sections')->insertGetId(['name' => 'Support Services Unit']);
    $verifiedAt = now();

    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'Admin', 'last_name' => 'One', 'email' => 'admin@example.com', 'section_id' => $sectionId, 'role' => 'Admin', 'is_approved' => false, 'email_verified_at' => $verifiedAt],
        ['id' => 2, 'first_name' => 'Employee', 'last_name' => 'One', 'email' => 'employee@example.com', 'section_id' => $sectionId, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => $verifiedAt],
        ['id' => 3, 'first_name' => 'Pending', 'last_name' => 'Admin', 'email' => 'pending-admin@example.com', 'section_id' => $sectionId, 'role' => 'Pending', 'is_approved' => false, 'email_verified_at' => $verifiedAt],
    ]);

    $admin = User::query()->findOrFail(1);
    $employee = User::query()->findOrFail(2);
    $pendingAdmin = User::query()->findOrFail(3);

    $this->post(route('request.store'), [
        'requester_name' => 'Taylor Requester',
        'office_address' => 'Cordillera Administrative Region',
        'contact_number' => '09171234567',
        'email' => 'taylor@example.com',
        'service_type' => ServiceRequest::SERVICE_TYPE_OTHERS,
        'other_service_type' => 'Statistical consultation',
        'subject' => 'Admin notification request',
        'description' => 'Please review this request.',
        'date_needed' => now()->addDays(3)->toDateString(),
    ])->assertRedirect(route('request.index'));

    $serviceRequest = ServiceRequest::query()->where('subject', 'Admin notification request')->firstOrFail();

    Notification::assertSentTo($admin, ServiceRequestReceived::class, function (ServiceRequestReceived $notification) use ($admin, $serviceRequest): bool {
        return $notification->toDatabase($admin)['service_request_id'] === $serviceRequest->id;
    });
    Notification::assertNotSentTo($employee, ServiceRequestReceived::class);
    Notification::assertNotSentTo($pendingAdmin, ServiceRequestReceived::class);
});

test('a verified DSU staff member can claim an incoming request and the requester is notified', function () {
    Notification::fake();
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'DSU', 'last_name' => 'Staff', 'email' => 'dsu@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => false, 'email_verified_at' => now()],
        ['id' => 2, 'first_name' => 'Signed', 'last_name' => 'Requester', 'email' => 'requester@example.com', 'section_id' => null, 'role' => 'Employee', 'is_approved' => false, 'email_verified_at' => now()],
    ]);
    $staff = User::query()->findOrFail(1);
    $requester = User::query()->findOrFail(2);
    $serviceRequest = ServiceRequest::factory()->create([
        'requester_user_id' => $requester->id,
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'analysis_types' => ['Descriptive Analysis'],
        'target_section_id' => $dsuId,
    ]);

    $this->actingAs($staff)
        ->from(route('request.index', ['tab' => 'incoming']))
        ->post(route('request.claim', $serviceRequest))
        ->assertRedirect(route('request.index', ['tab' => 'incoming']))
        ->assertSessionHas('success');

    expect($serviceRequest->fresh()->status)->toBe(ServiceRequest::STATUS_UNDER_REVIEW)
        ->and($serviceRequest->fresh()->assigned_to_id)->toBe($staff->id)
        ->and($serviceRequest->fresh()->claimed_at)->not->toBeNull();

    $this->get(route('request.index', ['tab' => 'incoming']))
        ->assertOk()
        ->assertViewHas('incomingRequests', fn ($requests): bool => ! $requests->contains('id', $serviceRequest->id));

    $this->get(route('request.index', ['tab' => 'claimed']))
        ->assertOk()
        ->assertViewHas('claimedRequests', fn ($requests): bool => $requests->contains('id', $serviceRequest->id));

    Notification::assertSentTo($requester, ServiceRequestWorkflowUpdate::class);
});

test('deadline reminders notify assigned staff daily for open requests due within three days or overdue', function () {
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'DSU', 'last_name' => 'Staff', 'email' => 'dsu@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
        ['id' => 2, 'first_name' => 'Requester', 'last_name' => 'One', 'email' => 'requester@example.com', 'section_id' => null, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
    ]);
    $staff = User::query()->findOrFail(1);
    $requester = User::query()->findOrFail(2);
    $dueSoon = ServiceRequest::factory()->create([
        'requester_user_id' => $requester->id,
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'date_needed' => today()->addDays(3),
        'status' => ServiceRequest::STATUS_UNDER_REVIEW,
    ]);
    $overdue = ServiceRequest::factory()->create([
        'requester_user_id' => $requester->id,
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'date_needed' => today()->subDay(),
        'status' => ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
    ]);
    $dueToday = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'date_needed' => today(),
    ]);
    $dueLater = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'date_needed' => today()->addDays(4),
    ]);
    $alreadyCompleted = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'date_needed' => today()->addDay(),
        'status' => ServiceRequest::STATUS_COMPLETED,
    ]);

    $this->artisan('requests:send-deadline-reminders')
        ->assertSuccessful()
        ->expectsOutput('Sent 3 service request deadline reminder(s).');

    $notifications = $staff->notifications()->get();
    expect($notifications)->toHaveCount(3)
        ->and($notifications->pluck('data.service_request_id')->all())->toContain($dueSoon->id, $dueToday->id, $overdue->id)
        ->and($notifications->firstWhere('data.service_request_id', $dueSoon->id)->data['type'])->toBe('soon')
        ->and($notifications->firstWhere('data.service_request_id', $dueToday->id)->data['type'])->toBe('today')
        ->and($notifications->firstWhere('data.service_request_id', $overdue->id)->data['type'])->toBe('overdue')
        ->and($dueLater->exists)->toBeTrue()
        ->and($alreadyCompleted->exists)->toBeTrue();

    $this->artisan('requests:send-deadline-reminders')
        ->assertSuccessful()
        ->expectsOutput('Sent 0 service request deadline reminder(s).');
});

test('a DSU staff member can request more information and the guest can securely reply', function () {
    Notification::fake();
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'DSU', 'last_name' => 'Staff', 'email' => 'dsu@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => false, 'email_verified_at' => now()],
    ]);
    $staff = User::query()->findOrFail(1);
    $serviceRequest = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'analysis_types' => ['Descriptive Analysis'],
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'status' => ServiceRequest::STATUS_UNDER_REVIEW,
    ]);

    $this->actingAs($staff)
        ->patch(route('request.update-status', $serviceRequest), [
            'status' => ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
            'comment' => 'Please provide the date range for the dataset.',
        ])
        ->assertRedirect();

    expect($serviceRequest->fresh()->status)->toBe(ServiceRequest::STATUS_MORE_INFORMATION_NEEDED)
        ->and($serviceRequest->fresh()->last_comment)->toBe('Please provide the date range for the dataset.');

    $trackingToken = $serviceRequest->fresh()->tracking_token;
    $this->get(route('request.track', $trackingToken))
        ->assertOk()
        ->assertSeeText('Your response')
        ->assertSeeText('Please provide the date range for the dataset.');

    $this->post(route('request.respond', $trackingToken), [
        'response' => 'The dataset covers January through December 2025.',
    ])
        ->assertRedirect(route('request.track', $trackingToken))
        ->assertSessionHas('success');

    expect($serviceRequest->fresh()->status)->toBe(ServiceRequest::STATUS_UNDER_REVIEW)
        ->and($serviceRequest->fresh()->last_comment)->toBe('The dataset covers January through December 2025.');
    Notification::assertSentTo($staff, ServiceRequestWorkflowUpdate::class);
});

test('completed request files and links are available to a guest only through its private tracking token', function () {
    Storage::fake('local');
    Notification::fake();

    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'DSU', 'last_name' => 'Staff', 'email' => 'dsu@example.com', 'section_id' => $dsuId, 'role' => 'Employee', 'is_approved' => false, 'email_verified_at' => now()],
    ]);
    $staff = User::query()->findOrFail(1);
    $serviceRequest = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'analysis_types' => ['Descriptive Analysis'],
        'target_section_id' => $dsuId,
        'assigned_to_id' => $staff->id,
        'status' => ServiceRequest::STATUS_UNDER_REVIEW,
    ]);
    $file = UploadedFile::fake()->createWithContent('analysis-results.pdf', "%PDF-1.4\nTest results");

    $this->actingAs($staff)
        ->patch(route('request.update-status', $serviceRequest), [
            'status' => ServiceRequest::STATUS_COMPLETED,
            'completion_link' => 'https://example.com/results',
            'completion_files' => [$file],
        ])
        ->assertRedirect()
        ->assertSessionHas('success');

    $serviceRequest->refresh();
    $deliverable = $serviceRequest->deliverables()->firstOrFail();

    expect($serviceRequest->status)->toBe(ServiceRequest::STATUS_COMPLETED)
        ->and($serviceRequest->deliverable_link)->toBe('https://example.com/results');
    Storage::disk('local')->assertExists($deliverable->file_path);

    $trackingToken = $serviceRequest->tracking_token;
    $this->get(route('request.track', $trackingToken))
        ->assertOk()
        ->assertSeeText('Completed files and links')
        ->assertSeeText('analysis-results.pdf')
        ->assertSee('https://example.com/results', false);

    $this->get(route('request.track-deliverable', [$trackingToken, $deliverable]))
        ->assertOk()
        ->assertDownload('analysis-results.pdf');

    $this->get(route('request.track-deliverable', [str_repeat('x', 64), $deliverable]))
        ->assertNotFound();

    Notification::assertSentOnDemand(ServiceRequestWorkflowUpdate::class, function (ServiceRequestWorkflowUpdate $notification): bool {
        return str_contains($notification->message, 'completed files and link');
    });
});

test('signed-in requesters can download completion files but unrelated users cannot', function () {
    Storage::fake('local');
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'Requester', 'last_name' => 'One', 'email' => 'requester@example.com', 'section_id' => null, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
        ['id' => 2, 'first_name' => 'Requester', 'last_name' => 'Two', 'email' => 'other@example.com', 'section_id' => null, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
    ]);
    $requester = User::query()->findOrFail(1);
    $otherUser = User::query()->findOrFail(2);
    $serviceRequest = ServiceRequest::factory()->create([
        'requester_user_id' => $requester->id,
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'target_section_id' => $dsuId,
        'status' => ServiceRequest::STATUS_COMPLETED,
    ]);
    $filePath = 'service-request-deliverables/private-results.pdf';
    Storage::disk('local')->put($filePath, 'private results');
    $deliverable = $serviceRequest->deliverables()->create([
        'file_path' => $filePath,
        'file_name' => 'private-results.pdf',
    ]);

    $this->actingAs($requester)
        ->get(route('request.deliverable', [$serviceRequest, $deliverable]))
        ->assertOk()
        ->assertDownload('private-results.pdf');

    $this->actingAs($otherUser)
        ->get(route('request.deliverable', [$serviceRequest, $deliverable]))
        ->assertForbidden();
});

test('Data Analysis requests require one or more valid analysis selections', function () {
    $this->from(route('request.index'))
        ->post(route('request.store'), [
            'requester_name' => 'Taylor Requester',
            'office_address' => 'Cordillera Administrative Region',
            'contact_number' => '09171234567',
            'email' => 'taylor@example.com',
            'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
            'analysis_types' => ['Not a valid analysis'],
            'subject' => 'Invalid analysis request',
            'description' => 'Please analyze this information.',
            'date_needed' => now()->addDays(3)->toDateString(),
        ])
        ->assertRedirect(route('request.index'))
        ->assertSessionHasErrors(['analysis_types.0']);

    expect(ServiceRequest::query()->count())->toBe(0);
});

test('Data Analysis incoming requests are visible only to signed-in DSU staff', function () {
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    $otherSectionId = DB::table('sections')->insertGetId(['name' => 'Support Services Unit']);
    $dsuRequest = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'analysis_types' => ['Descriptive Analysis'],
        'target_section_id' => $dsuId,
    ]);

    $dsuUser = new User;
    $dsuUser->setAttribute('id', 11);
    $dsuUser->setAttribute('first_name', 'DSU');
    $dsuUser->setAttribute('last_name', 'Staff');
    $dsuUser->setAttribute('email', 'dsu@example.com');
    $dsuUser->setAttribute('section_id', $dsuId);
    $dsuUser->setAttribute('role', 'Employee');
    $dsuUser->setAttribute('is_approved', false);
    $dsuUser->setAttribute('email_verified_at', now());
    $dsuUser->exists = true;

    $this->actingAs($dsuUser);
    $dsuResponse = app(\App\Http\Controllers\ServiceRequestController::class)->index(request());

    expect($dsuResponse->getData()['incomingRequests']->getCollection()->pluck('id')->all())->toBe([$dsuRequest->id]);

    $nonDsuUser = new User;
    $nonDsuUser->setAttribute('id', 12);
    $nonDsuUser->setAttribute('first_name', 'Other');
    $nonDsuUser->setAttribute('last_name', 'Staff');
    $nonDsuUser->setAttribute('email', 'other@example.com');
    $nonDsuUser->setAttribute('section_id', $otherSectionId);
    $nonDsuUser->setAttribute('role', 'Employee');
    $nonDsuUser->setAttribute('is_approved', false);
    $nonDsuUser->setAttribute('email_verified_at', now());
    $nonDsuUser->exists = true;

    $this->actingAs($nonDsuUser);
    $nonDsuResponse = app(\App\Http\Controllers\ServiceRequestController::class)->index(request());

    expect($nonDsuResponse->getData()['incomingRequests'])->toBeEmpty()
        ->and($nonDsuResponse->getData()['tab'])->toBe('my-active')
        ->and($nonDsuResponse->getData()['canReceiveRequests'])->toBeFalse();

    $this->get(route('request.index', ['tab' => 'incoming']))
        ->assertOk()
        ->assertDontSeeText('Incoming Requests')
        ->assertSeeText('Active Requests');
});

test('DSU staff can receive, claim, and archive section-routed requests', function () {
    Notification::fake();
    $sectionId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    DB::table('users')->insert([
        ['id' => 1, 'first_name' => 'Section', 'last_name' => 'Staff', 'email' => 'staff@example.com', 'section_id' => $sectionId, 'role' => 'Employee', 'is_approved' => true, 'email_verified_at' => now()],
    ]);
    $staff = User::query()->findOrFail(1);
    $serviceRequest = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_OTHERS,
        'target_section_id' => $sectionId,
        'status' => ServiceRequest::STATUS_RECEIVED,
    ]);

    $this->actingAs($staff)
        ->get(route('request.index', ['tab' => 'incoming']))
        ->assertOk()
        ->assertSeeText('Incoming Requests')
        ->assertDontSeeText('New Request')
        ->assertDontSeeText('Active Requests')
        ->assertDontSeeText('Finished Requests')
        ->assertSeeText('My Tasks')
        ->assertSeeText('Archive')
        ->assertViewHas('incomingRequests', fn ($requests): bool => $requests->contains('id', $serviceRequest->id));

    $this->post(route('request.claim', $serviceRequest))
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->get(route('request.index', ['tab' => 'claimed']))
        ->assertOk()
        ->assertViewHas('claimedRequests', fn ($requests): bool => $requests->contains('id', $serviceRequest->id));

    $this->patch(route('request.update-status', $serviceRequest), [
        'status' => ServiceRequest::STATUS_COMPLETED,
    ])->assertRedirect();

    $this->get(route('request.index', ['tab' => 'archive']))
        ->assertOk()
        ->assertViewHas('archivedRequests', fn ($requests): bool => $requests->contains('id', $serviceRequest->id))
        ->assertDontSeeText('Archive request');
});

test('admin completed requests appear in the archive without a requester archive action', function () {
    DB::table('users')->insert([
        'id' => 1,
        'first_name' => 'Site',
        'last_name' => 'Admin',
        'email' => 'admin@example.com',
        'role' => 'Admin',
        'is_approved' => true,
        'email_verified_at' => now(),
    ]);
    $admin = User::query()->findOrFail(1);
    ServiceRequest::factory()->create([
        'requester_user_id' => $admin->id,
        'subject' => 'Admin finished request',
        'status' => ServiceRequest::STATUS_COMPLETED,
    ]);

    $this->actingAs($admin)
        ->get(route('request.index', ['tab' => 'archive']))
        ->assertOk()
        ->assertSeeText('Admin finished request')
        ->assertDontSeeText('Finished Requests')
        ->assertDontSeeText('Archive request');
});

test('only signed-in DSU staff can download Data Analysis attachments', function () {
    Storage::fake('local');
    $dsuId = DB::table('sections')->insertGetId(['name' => 'Database and Statistical Unit']);
    $otherSectionId = DB::table('sections')->insertGetId(['name' => 'Support Services Unit']);
    $attachmentPath = 'service-requests/analysis.pdf';
    Storage::disk('local')->put($attachmentPath, 'private analysis document');
    $serviceRequest = ServiceRequest::factory()->create([
        'service_type' => ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS,
        'analysis_types' => ['Descriptive Analysis'],
        'target_section_id' => $dsuId,
        'attachment_path' => $attachmentPath,
        'attachment_name' => 'analysis.pdf',
    ]);

    $dsuUser = new User;
    $dsuUser->setAttribute('first_name', 'DSU');
    $dsuUser->setAttribute('last_name', 'Staff');
    $dsuUser->setAttribute('email', 'dsu@example.com');
    $dsuUser->setAttribute('section_id', $dsuId);
    $dsuUser->setAttribute('is_approved', true);
    $dsuUser->setAttribute('email_verified_at', now());
    $this->actingAs($dsuUser);

    expect(app(\App\Http\Controllers\ServiceRequestController::class)->downloadAttachment($serviceRequest)->getStatusCode())->toBe(200);

    $nonDsuUser = new User;
    $nonDsuUser->setAttribute('first_name', 'Other');
    $nonDsuUser->setAttribute('last_name', 'Staff');
    $nonDsuUser->setAttribute('email', 'other@example.com');
    $nonDsuUser->setAttribute('section_id', $otherSectionId);
    $nonDsuUser->setAttribute('is_approved', true);
    $nonDsuUser->setAttribute('email_verified_at', now());
    $this->actingAs($nonDsuUser);

    expect(fn () => app(\App\Http\Controllers\ServiceRequestController::class)->downloadAttachment($serviceRequest))
        ->toThrow(HttpException::class);
});

test('a request cannot be submitted with a date needed in the past', function () {
    $this->from(route('request.index'))
        ->post(route('request.store'), [
            'requester_name' => 'Taylor Requester',
            'office_address' => 'Cordillera Administrative Region',
            'contact_number' => '09171234567',
            'email' => 'taylor@example.com',
            'service_type' => ServiceRequest::SERVICE_TYPE_OTHERS,
            'other_service_type' => 'Data report',
            'subject' => 'Request for assistance',
            'description' => 'Please provide assistance with this request.',
            'date_needed' => now()->subDay()->toDateString(),
        ])
        ->assertRedirect(route('request.index'))
        ->assertSessionHasErrors('date_needed');

    expect(ServiceRequest::query()->count())->toBe(0);
});
