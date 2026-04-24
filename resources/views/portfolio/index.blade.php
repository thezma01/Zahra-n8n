@extends('layouts.app')

@section('title', 'Lumière Co. – Company Portfolio')
@section('meta_description', 'Discover Lumière Co. – Elevating your ecommerce experience with premium design, development, and digital marketing solutions.')

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
