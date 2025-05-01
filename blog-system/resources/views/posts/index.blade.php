@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Posts</h1>
        @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
        @endauth
    </div>

    @forelse($posts as $post)
        <div class="card mb-4">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top post-image" alt="{{ $post->title }}">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More →</a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No posts found.</div>
    @endforelse

    {{ $posts->links() }}
@endsection