<!-- resources/views/posts/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редагувати пост</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Назва</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Контент</label>
                <textarea class="form-control" id="body" name="body" rows="5">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Зображення</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" width="150" class="mt-3" alt="Image">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Категорія</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Оновити пост</button>
        </form>
    </div>
@endsection
