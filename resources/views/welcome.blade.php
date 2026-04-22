<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Welcome to Laravel!</h1>
                </div>

                <div class="mt-8 flex justify-center">
                    <p class="text-gray-500 dark:text-gray-400">
                        This is the default welcome page.
                    </p>
                </div>

                <div class="mt-4 flex justify-center text-center">
                    <a href="{{ route('password.choose.method', ['locale' => app()->getLocale()]) }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-4">
                        {{ __('auth.reset_password', [], app()->getLocale()) }}
                    </a>
                    @php
                        $currentLocale = app()->getLocale();
                        $targetLocale = ($currentLocale === 'en') ? 'ur' : 'en';
                        $languageSwitcherUrl = url('/' . $targetLocale . request()->getPathInfo());
                    @endphp
                    <a href="{{ $languageSwitcherUrl }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        {{ ($currentLocale === 'en') ? 'اردو' : 'English' }}
                    </a>
                </div>

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm sm:text-start">
                        &nbsp;
                    </div>

                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
