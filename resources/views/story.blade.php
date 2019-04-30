@extends('layouts.app')

@section('content')
<div class="container-fluid text-center">

    @foreach($stories as $story)
    <div class="jumbotro">
        <div>by
            <strong>{{ $story->author  }}</strong>
            on
            <small>{{ $story->created_at }}</small>
        </div>

        <div>
            <p>{{ $story->body }}</p>
        </div>

        <div class="row">
            <button onclick="react(event);" class="like" data-story-id="{{ $story->id }}">Like</button>
            <span id="likes-count-{{ $story->id }}">{{ $story->likes_count }}</span>
        </div>

        <div>

            <button onclick="react(event);" class="dislike" data-story-id="{{ $story->id }}">Unlike</button>
            <span id="dislikes-count-{{ $story->id }}">{{ $story->dislikes_count }}</span>
        </div>

    </div>
    @endforeach
</div>
@endsection
