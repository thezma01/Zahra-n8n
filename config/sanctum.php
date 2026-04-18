<?php

return [
    'stateful' => false,
    'expiration' => null,
    'middleware' => [
        // \Laravel\Sanctum\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    ],
];
