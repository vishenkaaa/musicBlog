@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Posts List</h1>

        <div id="selected-user" class="mb-3">
            <strong>Selected User:</strong> 
            <span id="selected-user-name">
                @if($selected_user_id)
                    {{ $users->find($selected_user_id)->name }} {{ $users->find($selected_user_id)->surname }}
                @else
                    No user selected
                @endif
            </span>
        </div>

        <div class="form-group mb-3">
            <select id="global_user_id" class="form-control" required onchange="updatePosts()">
                <option value="" disabled selected>Select a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3" id="create-post-btn">Create New Post</a>

        @if($posts->count())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Content</th>
                        <th>Actions</th>
                        <th>Likes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><img src="{{ asset('storage/' . $post->image) }}" width="100" alt="Image"></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->user->surname}} {{$post->user->name }}</td>
                            <td>{{ Str::limit($post->body, 50) }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                            <td>
                                <span>{{ $post->likes->count() }} Likes</span>
                                @if($post->likes->where('user_id', $selected_user_id)->count())
                                    <form action="{{ route('posts.unlike', $post->id) }}" method="POST" class="like-form" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="user_id" value="{{ $selected_user_id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Unlike</button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.like', $post->id) }}" method="POST" class="like-form" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $selected_user_id }}">
                                        <button type="submit" class="btn btn-sm btn-success">Like</button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td colspan="8">
                                <h5>Comments:</h5>
                                @if($post->comments->count())
                                    <ul>
                                        @foreach($post->comments as $comment)
                                            <li>
                                                <strong>{{ $post->user->surname}} {{$post->user->name }}</strong>: {{ $comment->comment }}
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No comments</p>
                                @endif

                                <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="user_id" value="{{ $selected_user_id }}">
                                    
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Your comment:</label>
                                        <textarea name="comment" id="comment" class="form-control" required>{{ old('comment') }}</textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No posts available</p>
        @endif
    </div>

    <script>
        function updatePosts() {
            var userId = document.getElementById('global_user_id').value;
            var selectedUserName = document.querySelector(`#global_user_id option[value="${userId}"]`).text;
        
            document.getElementById('selected-user-name').textContent = selectedUserName;
            window.location.href = `/posts?selected_user_id=${userId}`;
        }
    </script>

@endsection
