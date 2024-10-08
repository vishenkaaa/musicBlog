<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('likes', 'comments', 'category', 'user')->get();
        $users = User::all();

        $selected_user_id = $request->input('selected_user_id', $users->first()->id ?? null);

        return view('posts.index', compact('posts', 'users', 'selected_user_id'));
    }

    public function create()
    {
        $users = User::all(); 
        $categories = Category::all(); 

        return view('posts.create', compact('users', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imagePath,
            'user_id' => $request->user_id,
            //'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->update($request->only(['title', 'body', 'category_id']));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
