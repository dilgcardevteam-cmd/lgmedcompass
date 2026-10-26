<?php

use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentWorkflowController;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\PpaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionFileController;
use App\Http\Controllers\SectionFilePPAController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (no authentication required)
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('welcome'))->name('welcome');
Route::get('/organization', fn () => view('organization'))->name('organization');
Route::get('/reports-landing', fn () => view('reports-landing'))->name('reports.landing');
Route::get('/developers', fn () => view('developers'))->name('developers');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Landing pages for divisions (public)
Route::prefix('landingpage')->name('landingpage.')->group(function () {
    Route::get('/lgrpcs', fn () => view('landingpage.lp-lgrpcs'))->name('lgrpcs');
    Route::get('/lgpmras', fn () => view('landingpage.lp-lgpmras'))->name('lgpmras');
    Route::get('/lgpopscm', fn () => view('landingpage.lp-lgpopscm'))->name('lgpopscm');
    Route::get('/ssu', fn () => view('landingpage.lp-ssu'))->name('ssu');
    Route::get('/dsu', fn () => view('landingpage.lp-dsu'))->name('dsu');
});

/*
|--------------------------------------------------------------------------
| APPROVAL FLOW (pre-authentication)
|--------------------------------------------------------------------------
*/
Route::get('/pending-approval', fn () => view('auth.pending-approval'))->name('pending.approval');
Route::get('/check-approval-status', [ApprovalController::class, 'checkStatus'])->name('check.approval.status');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (auth + verified + approved)
|   - Added 'tech_inspector.readonly' middleware globally to block write methods
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'approved', 'tech_inspector.readonly'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | STATIC RESOURCE PAGES (accessible to all authenticated users)
    |--------------------------------------------------------------------------
    */
    Route::prefix('resources')->name('resources.')->group(function () {
        $categories = [
            ['name' => 'Division Chief', 'slug' => 'chief'],
            ['name' => 'Assistant Division Chief', 'slug' => 'assistant-chief'],
            ['name' => 'LG Relations & Policy Compliance Section', 'slug' => 'lgrpcs'],
            ['name' => 'LG Performance Management, Recognition, and Awards Section', 'slug' => 'lgpmras'],
            ['name' => 'LG Peace, Order & Public Safety Compliance Monitoring', 'slug' => 'lgpopscm'],
            ['name' => 'Support Services Unit', 'slug' => 'ssu'],
            ['name' => 'Database & Statistical Unit', 'slug' => 'dsu'],
            ['name' => 'QMS', 'slug' => 'qms'],
        ];

        foreach ($categories as $category) {
            $slug = $category['slug'];
            Route::get("/$slug", fn () => view("resources.rd-$slug"))->name("rd-$slug");
        }
    });

    /*
    |--------------------------------------------------------------------------
    | RESOURCE API (folders, files, uploads) – write actions blocked by middleware
    |--------------------------------------------------------------------------
    */
    Route::prefix('resource')->group(function () {
        Route::get('/folders/{categorySlug}/{folderId?}', [ResourceController::class, 'folders'])->name('resource.folders');
        Route::post('/folder', [ResourceController::class, 'createFolder'])->name('resource.folder.create');
        Route::delete('/folder/{id}', [ResourceController::class, 'deleteFolder'])->name('resource.folder.delete');
        Route::post('/upload', [ResourceController::class, 'uploadFile'])->name('resource.upload');
        Route::post('/link', [ResourceController::class, 'addLink'])->name('resource.link.store');
        Route::delete('/file/{id}', [ResourceController::class, 'deleteFile'])->name('resource.file.delete');
        Route::put('/folder/{id}', [ResourceController::class, 'renameFolder'])->name('resource.folder.rename');
        Route::put('/file/{id}', [ResourceController::class, 'renameFile'])->name('resource.file.rename');
        Route::get('/file/view/{id}', [ResourceController::class, 'viewFile'])->name('resource.file.view');
    });

    Route::get('/resources/{categorySlug}/{folderId?}', [ResourceController::class, 'showCategory'])->name('resources.category');

    Route::middleware(['auth'])->group(function () {
        // PPA routes
        Route::prefix('ppa')->name('ppa.')->group(function () {
            Route::get('/folders/{section}/{parentId?}', [PpaController::class, 'folders'])->name('folders');
            Route::post('/folder', [PpaController::class, 'createFolder'])->name('folder.create');
            Route::post('/upload', [PpaController::class, 'uploadFile'])->name('upload');
            Route::post('/link', [PpaController::class, 'addLink'])->name('link.store');
            Route::put('/folder/{id}', [PpaController::class, 'renameFolder'])->name('folder.rename');
            Route::put('/file/{id}', [PpaController::class, 'renameFile'])->name('file.rename');
            Route::delete('/file/{id}', [PpaController::class, 'deleteFile'])->name('file.delete');
            Route::delete('/folder/{id}', [PpaController::class, 'deleteFolder'])->name('folder.delete');
            Route::get('/view/{id}', [PpaController::class, 'viewFile'])->name('file.view');

            Route::get('/folders-list/{divisionId}', [PpaController::class, 'getFoldersByDivision']);
            Route::put('/move/{type}/{id}', [PpaController::class, 'moveItem']);

            Route::get('/{section}/{parentId?}', [PpaController::class, 'showSection'])->name('section');
            Route::get('/', [PpaController::class, 'index'])->name('index');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | PROTECTED RESOURCE VIEWS
    |--------------------------------------------------------------------------
    */
    Route::get('/resources', fn () => view('resources'))->name('resources.index');
    Route::get('/resources/{section}', [SectionFileController::class, 'index'])->name('resources.section');
    Route::get('/resources/{section}/folder/{id}', [SectionFileController::class, 'openFolder'])->name('resources.folder');

    Route::prefix('resourcesppa')->group(function () {
        Route::get('/{section}', [SectionFilePPAController::class, 'index'])->name('resourcesppa.section');
        Route::get('/{section}/folder/{id}', [SectionFilePPAController::class, 'openFolder'])->name('resourcesppa.folder');
    });

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */
    Route::get('/notification/{id}', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        if ($notification->type === 'App\Notifications\DocumentAssignedNotification') {
            return redirect()->route('documents.my-tasks');
        }

        return redirect($notification->data['url'] ?? route('documents.index'));
    })->name('notification.redirect');

    Route::get('/notifications/read/{id}', function ($id) {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();

        return back();
    })->name('notifications.read');

    Route::get('/notification/{id}/details', [DocumentController::class, 'getNotificationDetails'])->name('notification.details');
    Route::post('/notifications/clear', [DocumentController::class, 'clearNotifications'])->name('notifications.clear');
    Route::post('/notifications/{id}/mark-as-read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    })->name('notifications.mark-as-read');
    Route::post('/notifications/{id}/mark-as-read', [DocumentWorkflowController::class, 'markAsRead'])->name('notifications.mark-as-readprocess');
    Route::get('/documents/assigned-count', function () {
        $count = Document::where('assigned_to_id', auth()->id())->count();

        return response()->json(['count' => $count]);
    })->middleware('auth');
    Route::get('/calendar/today-events', [App\Http\Controllers\CalendarController::class, 'todayEvents'])
        ->middleware(['auth'])
        ->name('calendar.today-events');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | EMPLOYEE ACCESS
    |--------------------------------------------------------------------------
    */
    Route::middleware('Employee')->group(function () {

        // Document Management
        Route::resource('documents', DocumentController::class);
        Route::delete('/documents/bulk-delete', [DocumentController::class, 'bulkDestroy'])->name('documents.bulkDestroy');
        Route::get('/documents/live-search', [DocumentController::class, 'liveSearch'])->name('documents.liveSearch');
        Route::post('/document/{document}/sync-sheet', [DocumentController::class, 'syncSheet'])->name('documents.sync-sheet');
        Route::patch('/documents/{document}/status', [DocumentController::class, 'updateStatus'])->name('documents.updateStatus');
        Route::post('/documents/{document}/connect-sheet', [DocumentController::class, 'connectSheet'])->name('documents.connect-sheet');
        Route::patch('/document/{document}/archive', [DocumentController::class, 'archive'])->name('documents.archive');
        Route::get('/archive', [DocumentController::class, 'archiveIndex'])->name('documents.archiveIndex');
        Route::patch('/documents/{id}/restore', [DocumentController::class, 'restore'])->name('documents.restore');
        Route::delete('/documents/{id}/force-delete', [DocumentController::class, 'destroyPermanent'])->middleware('Admin')->name('documents.forceDelete');
        Route::post('/documents/{document}/complete-schedule', [DocumentController::class, 'completeSchedule'])
            ->name('documents.completeSchedule');
        Route::post('/documents/{id}/advance', [DocumentController::class, 'advancePeriod'])->name('documents.advance');
        Route::get('/documents/download/{filename}', [DocumentController::class, 'download'])->name('documents.download');

        // API Routes for Holiday Checking
        Route::get('/api/holidays/check', [DocumentController::class, 'checkHoliday'])->name('api.holidays.check');

        // Document Workflow
        Route::get('/my-tasks', [DocumentWorkflowController::class, 'myTasks'])->name('documents.my-tasks');
        Route::get('/my-uploads', [DocumentWorkflowController::class, 'myUploads'])->name('documents.my-uploads');
        Route::get('/document-process/check-updates', [DocumentWorkflowController::class, 'checkUpdates'])->name('documents.workflow.check-updates');
        Route::get('/document-process/assigned-count', [DocumentWorkflowController::class, 'assignedCount'])->name('documents.workflow.assigned-count');
        Route::post('/documents/quick-store', [DocumentWorkflowController::class, 'quickStore'])->name('documents.quick-store');
        Route::get('/document-process/download/{path}', [DocumentWorkflowController::class, 'downloadFile'])
            ->name('documents.workflow.download')
            ->where('path', '.*');
        Route::post('/document-process/{document_process}/workflow', [DocumentWorkflowController::class, 'workflowAction'])->name('documents.workflow');
        Route::put('/documents/{documentProcess}', [DocumentWorkflowController::class, 'update'])->name('workflow.documents.update');
        Route::delete('/documents-process/{id}', [DocumentWorkflowController::class, 'destroy'])
            ->name('workflow.documents.destroy');
        Route::delete('/documents-process/{id}/force-delete', [DocumentWorkflowController::class, 'forceDelete'])->name('documentsProcess.forceDelete');
        Route::post('/documents-process/{id}/restore', [DocumentWorkflowController::class, 'restore'])->name('documentsProcess.restore');
        Route::post('/documents/{id}/mark-delete', [DocumentWorkflowController::class, 'markDelete'])->name('documents.markDelete');
        Route::get('/my-tasks-archive', [DocumentWorkflowController::class, 'archivePage'])->name('documents.archivePage');
        Route::get('/documents-process/{documentProcess}/assignable-users/{action}', [DocumentWorkflowController::class, 'getAssignableUsers']);

        // Calendar
        Route::get('/calendar', [CalendarController::class, 'page'])->name('calendar.index');
        Route::get('/calendar/events', [CalendarController::class, 'index'])->name('calendar.events.index');
        Route::post('/calendar/events', [CalendarController::class, 'store'])->name('calendar.events.store');
        Route::get('/calendar/events/{event}', [CalendarController::class, 'show'])->name('calendar.events.show');
        Route::put('/calendar/events/{event}', [CalendarController::class, 'update'])->name('calendar.events.update');
        Route::delete('/calendar/events/{event}', [CalendarController::class, 'destroy'])->name('calendar.events.destroy');
        Route::get('/calendar/upcoming', [CalendarController::class, 'upcoming'])->name('calendar.upcoming');

        // Drive System
        Route::prefix('drive')->group(function () {
            Route::get('/folders/{division}/{parent?}', [DriveController::class, 'folders'])->name('drive.folders');
            Route::post('/folder', [DriveController::class, 'createFolder'])->name('drive.folder.create');
            Route::post('/upload', [DriveController::class, 'uploadFile'])->name('drive.upload');
            Route::post('/link', [DriveController::class, 'addLink'])->name('drive.link.store');
            Route::delete('/file/{id}', [DriveController::class, 'deleteFile'])->name('drive.file.delete');
            Route::delete('/folder/{id}', [DriveController::class, 'deleteFolder'])->name('drive.folder.delete');
        });

        Route::get('/google-sheet', [DocumentController::class, 'sheetData'])->name('google.sheet');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN READ-ONLY VIEWS
    |--------------------------------------------------------------------------
    */
    Route::get('/account-management', [AccountManagementController::class, 'index'])
        ->name('account-management.index')
        ->middleware('can:viewAny,App\Models\User');

    /*
    |--------------------------------------------------------------------------
    | ADMIN WRITE ACTIONS
    |--------------------------------------------------------------------------
    */
    Route::middleware('Admin')->group(function () {
        Route::patch('/users/{user}/approve', [AccountManagementController::class, 'approve'])->name('users.approve');
        Route::patch('/users/{user}/decline', [AccountManagementController::class, 'decline'])->name('users.decline');
        Route::patch('/account-management/{user}/update-section', [AccountManagementController::class, 'updateSection']);
        Route::patch('/account-management/{user}/role', [AccountManagementController::class, 'updateRole']);
        Route::delete('/account-management/{user}', [AccountManagementController::class, 'destroy'])
            ->name('account-management.destroy');

        Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
        Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
    });
});

// Reports generate route
Route::get('/reports/generate', [DocumentController::class, 'generateReport'])
    ->middleware(['auth', 'verified', 'approved'])
    ->name('reports.generate');

/*
|--------------------------------------------------------------------------
| STATIC ASSET ROUTES WITH SECURITY HEADERS
| Must be BEFORE auth.php to avoid conflicts
|--------------------------------------------------------------------------
*/

// Handle build assets (CSS, JS, fonts)
Route::get('build/assets/{path}', function ($path) {
    if (str_contains($path, '..')) {
        abort(403);
    }

    $fullPath = public_path('build/assets/'.$path);

    if (! File::exists($fullPath)) {
        abort(404);
    }

    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'svg' => 'image/svg+xml',
    ];

    $extension = pathinfo($path, PATHINFO_EXTENSION);
    $mimeType = $mimeTypes[$extension] ?? mime_content_type($fullPath);

    return response()->file($fullPath, [
        'Content-Type' => $mimeType,
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'SAMEORIGIN',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*');

// Handle images
Route::get('images/{path}', function ($path) {
    if (str_contains($path, '..')) {
        abort(403);
    }

    $fullPath = public_path('images/'.$path);

    if (! File::exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'SAMEORIGIN',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Cache-Control' => 'public, max-age=604800',
    ]);
})->where('path', '.*');

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
