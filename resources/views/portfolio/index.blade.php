@extends('layouts.app')

@section('title', 'Lumière Studio — Portfolio')
@section('meta_description', 'Discover Lumière Studio — premium ecommerce design, branding, and development solutions.')

@section('content')
    @include('components.hero')
    @include('components.about')
    @include('components.services', ['services' => $services])
    @include('components.showcase',  ['portfolioItems' => $portfolioItems])
    @include('components.cta')
@endsection
