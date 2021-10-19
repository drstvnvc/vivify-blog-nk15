<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        // info('Post controller index method');
        DB::listen(function ($query) {
            info($query->sql);
        });

        // $posts = Post::published()->get();
        $posts = Post::published()->paginate(15);


        // $users = User::with(['posts' => function ($qb) {
        //     $qb->where('is_published', true);
        // }])
        //     ->where('email', 'like', '%@%')->get();
        // echo $users;


        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        DB::listen(function ($query) {
            info($query->sql);
        });
        if (!$post->is_published) {
            throw new ModelNotFoundException;
        }

        $post->load(['comments.user' => function ($qb) {
            $qb->select(['users.id', 'users.name']);
        }]);

        // $post = Post::with('comments')->findOrFail($post);

        // info($post);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(CreatePostRequest $request)
    {
        // $post = new Post;
        // $post->title = $request->get('title');
        // $post->body = $request->get('body');
        // $post->is_published = $request->get('is_published', false);

        // $post->save();

        $data = $request->validated();

        // $newPost = Post::create($data);

        $newPost = auth()->user()->posts()->create($data);

        $newPost->tags()->attach($data['tags']); // mozemo koristiti sync umjesto attach
        // $newPost = Post::create([
        //     'title' => $request->get('title'),
        //     'body' => $request->get('body'),
        //     'is_published' => $request->get('is_published'),
        //     'user_id' => auth()->user()->id,
        // ]);

        return redirect(route('post', ['post' => $newPost]));
    }

    public function getAuthorsPosts(User $author)
    {
        $posts = $author->posts()->where('is_published', true)->paginate(15);

        return view('posts.index', compact('posts'));
    }
}
