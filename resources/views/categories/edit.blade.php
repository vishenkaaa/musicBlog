@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
