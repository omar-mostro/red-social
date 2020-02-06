<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentLikesController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->likes()->create([
           'user_id'=> auth()->id()
        ]);

        return [
            'likes_count' => $comment->likesCount()
        ];
    }

    public function destroy(Comment $comment)
    {
        $comment->likes()->where([
            'user_id' => auth()->id()
        ])->delete();

        return [
            'likes_count' => $comment->likesCount()
        ];
    }
}
