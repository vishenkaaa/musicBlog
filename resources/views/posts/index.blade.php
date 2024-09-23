@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список постів</h1>

        <a href="{{ route('posts.create') }}" class="btn btn-primary">Додати пост</a>

        @if($posts->count())
            <table class="table mt-3 table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Зображення</th>
                        <th>Назва</th>
                        <th>Категорія</th>
                        <th>Автор</th>
                        <th>Контент</th> <!-- Додано -->
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><img src="{{ asset('storage/' . $post->image) }}" width="100" alt="Image"></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ Str::limit($post->body, 100) }}</td> <!-- Відображення частини контенту -->
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Редагувати</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </td>
                            <td>
                                @if(Auth::check())
                                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                        @csrf
                                        <button type="submit">{{ $post->likes()->where('user_id', auth()->id())->exists() ? 'Unlike' : 'Like' }}</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div>
                                        <label for="comment">Ваш коментар</label>
                                        <textarea name="comment" id="comment">{{ old('comment') }}</textarea>
                                    </div>
                                    <button type="submit">Додати коментар</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <p>Немає постів.</p>
        @endif
    </div>
@endsection
