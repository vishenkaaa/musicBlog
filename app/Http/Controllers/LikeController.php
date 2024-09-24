<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        if (!$post->likes()->where('user_id', auth()->id())->exists()) {
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
        }

        return redirect()->back();
    }
}

