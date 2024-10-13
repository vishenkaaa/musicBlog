@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Category</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create new category</a>

    @if($categories->count())
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @include('includes.modal_confirm_delete')
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('/categories/{{ $category->id }}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No category available</p>
    @endif
</div>
@endsection
