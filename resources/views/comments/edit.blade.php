@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="comment">Your Comment</label>
            <textarea name="comment" id="comment">{{ $comment->comment }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
