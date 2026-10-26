<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

// Handle build assets with security headers
Route::get('build/assets/{path}', function ($path) {
    // Security: Prevent directory traversal
    if (str_contains($path, '..')) {
        abort(403);
    }

    $fullPath = public_path('build/assets/'.$path);

    if (! File::exists($fullPath)) {
        abort(404);
    }

    // Determine MIME type
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'svg' => 'image/svg+xml',
    ];

    $mimeType = $mimeTypes[$extension] ?? mime_content_type($fullPath);

    $response = Response::make(File::get($fullPath), 200, [
        'Content-Type' => $mimeType,
    ]);

    // Add security headers
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
    $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
    $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
    $response->headers->remove('X-Powered-By');

    // Cache for 1 year (static assets have hashed names)
    $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
    $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');

    return $response;
})->where('path', '.*');

// Handle images with security headers
Route::get('images/{path}', function ($path) {
    // Security: Prevent directory traversal
    if (str_contains($path, '..')) {
        abort(403);
    }

    $fullPath = public_path('images/'.$path);

    if (! File::exists($fullPath)) {
        abort(404);
    }

    $response = Response::file($fullPath);

    // Add security headers
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
    $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
    $response->headers->remove('X-Powered-By');

    // Cache images for 1 week
    $response->headers->set('Cache-Control', 'public, max-age=604800');

    return $response;
})->where('path', '.*');

// Handle favicon
Route::get('favicon.ico', function () {
    $fullPath = public_path('favicon.ico');

    if (! File::exists($fullPath)) {
        abort(404);
    }

    $response = Response::file($fullPath);
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Cache-Control', 'public, max-age=31536000');

    return $response;
});

// Handle robots.txt
Route::get('robots.txt', function () {
    $fullPath = public_path('robots.txt');

    if (! File::exists($fullPath)) {
        abort(404);
    }

    $response = Response::file($fullPath);
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Cache-Control', 'public, max-age=86400');

    return $response;
});
