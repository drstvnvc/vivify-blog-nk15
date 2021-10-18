<?php

namespace App\Http\Controllers;

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
        $comment = $post->comments()->create($data);

        Mail::to($post->user)->send(
            new CommentReceived(
                auth()->user(),
                $comment,
            )
        );

        return back();
    }
}
