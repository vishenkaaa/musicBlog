<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            //'user_id' => auth()->id(), 
            'post_id' => $request->post_id,
        ]);

        return redirect()->back();
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment->update($request->only('comment'));

        return redirect()->route('posts.show', $comment->post_id);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
