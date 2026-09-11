<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof Response && ! $request->is('_debugbar/*')) {
            $response->headers->set('Content-Security-Policy', $this->policy());
        }

        return $response;
    }

    protected function policy(): string
    {
        $viteDev = [];

        if (Vite::isRunningHot()) {
            $viteDev = ['http://localhost:5173', 'https://localhost:5173', 'http://127.0.0.1:5173'];
        }

        return implode('; ', [
            "default-src 'self'",
            'script-src '.implode(' ', ['\'self\'', '\'unsafe-eval\'', ...$viteDev]),
            'style-src '.implode(' ', ['\'self\'', '\'unsafe-inline\'', 'https://fonts.googleapis.com', 'https://fonts.bunny.net', ...$viteDev]),
            'font-src '.implode(' ', ['\'self\'', 'https://fonts.gstatic.com', 'https://fonts.bunny.net']),
            "img-src 'self' data: blob:",
            'connect-src '.implode(' ', ['\'self\'', ...$viteDev]),
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
        ]);
    }
}