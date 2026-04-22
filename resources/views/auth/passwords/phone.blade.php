@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">{{ __('auth.reset_password') }}</h2>
    <p class="text-gray-600 text-center mb-6">{{ __('auth.enter_phone_for_reset') }}</p>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.phone.send', ['locale' => app()->getLocale()]) }}">
        @csrf

        <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700">{{ __('Phone Number') }}</label>
            <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="tel" autofocus class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('phone_number')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('auth.send_password_reset_code') }}
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
