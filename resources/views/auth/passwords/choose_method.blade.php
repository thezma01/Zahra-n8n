@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">{{ __('auth.choose_reset_method') }}</h2>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.choose.method.post', ['locale' => app()->getLocale()]) }}">
        @csrf

        <div class="mb-4">
            <button type="submit" name="method" value="email" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('auth.reset_via_email') }}
            </button>
        </div>

        <div>
            <button type="submit" name="method" value="sms" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('auth.reset_via_sms') }}
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        @php
            $currentLocale = app()->getLocale();
            $targetLocale = ($currentLocale === 'en') ? 'ur' : 'en';
            $currentRoute = Route::current();
            $routeParams = $currentRoute ? $currentRoute->parameters() : [];
            $routeParams['locale'] = $targetLocale;
            $languageSwitcherUrl = route($currentRoute->getName(), $routeParams);
        @endphp
        <a href="{{ $languageSwitcherUrl }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
            {{ ($currentLocale === 'en') ? 'اردو' : 'English' }}
        </a>
    </div>
@endsection
