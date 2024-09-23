@extends('layouts.app')

@section('content')
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
