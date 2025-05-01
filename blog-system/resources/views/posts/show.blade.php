@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="card mb-4">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top post-image" alt="{{ $post->title }}">
        @endif
        <div class="card-body">
            <h1 class="card-title">{{ $post->title }}</h1>
            <p class="card-text text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
            <div class="card-text mb-4">{!! nl2br(e($post->content)) !!}</div>
            
            @can('update', $post)
                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Comments ({{ $post->comments->count() }})</div>
        <div class="card-body">
            @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3" placeholder="Write a comment..."></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
            @else
            <div class="alert alert-info">Please <a href="{{ route('login') }}">login</a> to post a comment.</div>
            @endauth

            @forelse($post->comments as $comment)
                <div class="comment-box">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $comment->user->name }}</strong>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0 mt-2">{{ $comment->content }}</p>
                    
                    @can('delete', $comment)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @endcan
                </div>
            @empty
                <div class="alert alert-info">No comments yet.</div>
            @endforelse
        </div>
    </div>
@endsection