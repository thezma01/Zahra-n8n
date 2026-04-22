@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">{{ __('auth.reset_password') }}</h2>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update', ['locale' => app()->getLocale()]) }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        @if (isset($email))
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        @elseif (isset($phone_number))
            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700">{{ __('Phone Number') }}</label>
                <input id="phone_number" type="text" name="phone_number" value="{{ $phone_number ?? old('phone_number') }}" required autocomplete="tel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                @error('phone_number')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('auth.password_confirmation') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('auth.reset_password') }}
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
