@extends('layouts.app')

@section('title', $post->title)

@section('content')
<h2>
    {{ $post->title }}
</h2>
<h3>{{ $post->user->name }}</h3>
<hr />

<div>
    @foreach($post->tags as $tag)
    <span style="
                padding: 5px;
                border-radius: 15px;
                background-color:{{$tag->hex_color}}
                ">
        {{$tag->name}}
    </span>
    @endforeach
</div>

<hr />
<p>
    {{ $post->body }}
</p>

<h5>Comments</h5>
@forelse($post->comments as $comment)
<div>
    <div>{{$comment->user->name}}</div>
    <blockquote>{{ $comment->body }}</blockquote>
    <small>{{$comment->created_at}}</small>
</div>
<hr />
@empty
<span>No comments</span>
@endforelse

<form class="mt-3" action="{{ route('createComment', ['post' => $post->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="body">Add comment:</label>
        <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection