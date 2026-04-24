@extends('layouts.app')

@section('title', 'Portfolio | LuxeBrand — Elevating Your Ecommerce Experience')
@section('meta_description', 'Discover LuxeBrand — premium ecommerce solutions, product design, and digital marketing services crafted for modern businesses.')

@section('content')

    {{-- Hero / Banner Section --}}
    @include('components.hero')

    {{-- About Company Section --}}
    @include('components.about')

    {{-- Services Section --}}
    @include('components.services', ['services' => $services])

    {{-- Portfolio / Showcase Section --}}
    @include('components.showcase', ['portfolioItems' => $portfolioItems])

    {{-- Call-to-Action Section --}}
    @include('components.cta')

@endsection
