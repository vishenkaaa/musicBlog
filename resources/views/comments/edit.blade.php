@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Comment</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="comment" class="form-label">Your Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="5">{{ $comment->comment }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
