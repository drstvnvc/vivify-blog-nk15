<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\CommentRequest;
use App\Mail\CommentReceived;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{

    public function store(Post $post, CommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $comment = $post->comments()->create($data);

        Mail::to($post->user)->send(
            new CommentReceived($comment)
        );

        return back();
    }
}
