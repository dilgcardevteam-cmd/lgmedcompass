<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Apply to all responses including errors
        $this->addSecurityHeaders($response, $request);

        return $response;
    }

    protected function addSecurityHeaders(Response $response, Request $request): void
    {
        // Determine environment-specific settings
        $isLocal = app()->environment('local');
        $appUrl = config('app.url', 'http://lgmed-compass.test');

        // Build CSP based on environment
        $csp = $this->buildCSP($isLocal, $appUrl);

        // Set headers on ALL responses (including static files)
        $response->headers->set('Content-Security-Policy', $csp);

        // Only set HSTS if using HTTPS (or for local dev)
        if ($request->secure() || $isLocal) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Only set Permissions-Policy for non-asset responses
        if (! $this->isAssetRequest($request)) {
            $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        }

        // Force remove sensitive headers
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
    }

    protected function buildCSP(bool $isLocal, string $appUrl): string
    {
        $csp = [];

        // ===== DEFAULT-SRC =====
        $csp[] = "default-src 'self'";

        // ===== SCRIPT-SRC =====
        $scriptSrc = [
            "'self'",
            'cdn.jsdelivr.net',
            'cdnjs.cloudflare.com',  // Added for Font Awesome JS
            "'unsafe-inline'",
            "'unsafe-eval'",
        ];

        if ($isLocal) {
            $scriptSrc[] = 'http://localhost:5173';
            $scriptSrc[] = 'ws://localhost:5173';

            $scriptSrc[] = 'http://localhost:5175';
            $scriptSrc[] = 'ws://localhost:5175';
        }

        $csp[] = 'script-src '.implode(' ', $scriptSrc);

        // ===== STYLE-SRC =====
        $styleSrc = [
            "'self'",
            'cdn.jsdelivr.net',
            'cdnjs.cloudflare.com',     // Font Awesome CSS
            'fonts.bunny.net',
            'fonts.googleapis.com',
            'fonts.gstatic.com',
            "'unsafe-inline'",
        ];

        if ($isLocal) {
            $styleSrc[] = 'http://localhost:5173';
            $styleSrc[] = 'http://localhost:5175';
        }

        $csp[] = 'style-src '.implode(' ', $styleSrc);

        // ===== FONT-SRC =====
        $fontSrc = [
            "'self'",
            'cdn.jsdelivr.net',
            'cdnjs.cloudflare.com',     // Font Awesome fonts
            'fonts.bunny.net',
            'fonts.gstatic.com',
            'data:',
        ];

        if ($isLocal) {
            $fontSrc[] = 'http://localhost:5173';
            $fontSrc[] = 'http://localhost:5175';
        }

        $csp[] = 'font-src '.implode(' ', $fontSrc);

        // ===== IMG-SRC =====
        $imgSrc = [
            "'self'",
            'data:',
            'https:',
            'blob:',
            'upload.wikimedia.org',
            'image2url.com',
            'i.ibb.co',
            'cdn-icons-png.flaticon.com',
        ];

        $csp[] = 'img-src '.implode(' ', $imgSrc);

        // ===== CONNECT-SRC =====
        $connectSrc = [
            "'self'",
            'cdn.jsdelivr.net',
            'cdnjs.cloudflare.com',     // Added
        ];

        $connectSrc[] = parse_url($appUrl, PHP_URL_HOST) ?: 'lgmed-compass.test';

        if ($isLocal) {
            $connectSrc[] = 'http://localhost:5173';
            $connectSrc[] = 'ws://localhost:5173';

            $connectSrc[] = 'http://localhost:5175';
            $connectSrc[] = 'ws://localhost:5175';
        }

        $csp[] = 'connect-src '.implode(' ', $connectSrc);

        // ===== FRAME-ANCESTORS =====
        $csp[] = "frame-ancestors 'self'";

        // ===== FORM-ACTION =====
        $csp[] = "form-action 'self'";

        // ===== FRAME-SRC =====
        $csp[] = "frame-src 'self'";

        // ===== MEDIA-SRC =====
        $csp[] = "media-src 'self'";

        // ===== OBJECT-SRC =====
        $csp[] = "object-src 'none'";

        // ===== MANIFEST-SRC =====
        $csp[] = "manifest-src 'self'";

        // ===== WORKER-SRC =====
        $csp[] = "worker-src 'self' blob:";

        // ===== BASE-URI =====
        $csp[] = "base-uri 'self'";

        // ===== UPGRADE-INSECURE-REQUESTS (Production only) =====
        if (! $isLocal) {
            $csp[] = 'upgrade-insecure-requests';
        }

        // ===== REPORT-URI (Production only) =====
        if (! $isLocal) {
            $csp[] = 'report-uri /csp-violation-report-endpoint';
        }

        return implode('; ', array_filter($csp));
    }

    protected function isAssetRequest(Request $request): bool
    {
        $path = $request->path();

        $assetPatterns = [
            '*.css',
            '*.js',
            '*.png',
            '*.jpg',
            '*.jpeg',
            '*.gif',
            '*.svg',
            '*.ico',
            '*.woff',
            '*.woff2',
            '*.ttf',
            '*.eot',
            'build/assets/*',
            'images/*',
        ];

        foreach ($assetPatterns as $pattern) {
            if (fnmatch($pattern, $path)) {
                return true;
            }
        }

        return false;
    }
}
