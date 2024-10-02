<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        //if (!$post->likes()->where('user_id', auth()->id())->exists()) {
            Like::create([
                //'user_id' => auth()->id(),
                'user_id' => $request->user_id,
                'post_id' => $post->id,
            ]);
        //}

        return redirect()->back();
    }

    public function destroy(Request $request, Post $post)
    {
        $like = $post->likes()->where('user_id', $request->user_id)->first();

        if ($like) {
            $like->delete();
        }

        return redirect()->back();
    }

}

