@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} {{ $user->surname }} - {{ $user->email }}
                <a href="{{ route('users.edit', $user->id) }}">Edit</a> | 
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('users.create') }}">Create New User</a>
@endsection
