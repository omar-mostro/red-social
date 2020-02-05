<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusCommentsController extends Controller
{
    public function store(Request $request, Status $status)
    {

        $this->validate($request, [
           'body' => 'required'
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'status_id' => $status->id,
            'body' => $request->get('body'),
        ]);

        return CommentResource::make($comment);
    }
}
