<?php

use Illuminate\Http\Request;

// ===== ADD SECURITY HEADERS TO ALL RESPONSES =====
// This runs before Laravel, catching static file responses too
$appUrl = 'http://lgmed-compass.test';

// Don't add CSP here (middleware handles that)
// But add basic security headers for ALL responses
header_remove('X-Powered-By');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
