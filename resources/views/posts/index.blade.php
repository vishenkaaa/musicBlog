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
                        <th>Контент</th> 
                        <th>Дії</th>
                        <th>Лайки</th>
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
                            <td>{{ Str::limit($post->body, 100) }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Редагувати</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </td>
                            <td>
                                <span>{{ $post->likes->count() }} Лайків</span>
                                
                                    @if($post->likes()->where('user_id', auth()->id())->exists())
                                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Unlike</button>
                                        </form>
                                    @else
                                        <form action="{{route('posts.unlike', $post->id)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Like</button>
                                        </form>
                                    @endif
                                
                            </td>
                        </tr>

                        <tr>
                            <td colspan="7">
                                <h5>Коментарі:</h5>
                                @if($post->comments->count())
                                    <ul>
                                        @foreach($post->comments as $comment)
                                            <li>
                                                <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Редагувати</a>
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Немає коментарів.</p>
                                @endif
                                
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="mb-3">
                                        <label for="comment">Ваш коментар:</label>
                                        <textarea name="comment" id="comment" class="form-control">{{ old('comment') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Додати коментар</button>
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
