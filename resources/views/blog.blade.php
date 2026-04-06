@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Blog</div>
                    <div class="card-body">
                        @foreach($blogs as $blog)
                            <div class="blog-card">
                                <h2>{{ $blog->title }}</h2>
                                <p>{{ $blog->content }}</p>
                                <a href="{{ route('blog.show', $blog->id) }}">Read More</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection