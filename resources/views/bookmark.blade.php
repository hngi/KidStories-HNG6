@extends('layouts.app')

@section('content')
<div class="favourites">
    <!-- Header with BG Image -->
    <div class="favourites_header d-flex justify-content-center align-items-center">
        <h1 class="text-white">Favorites</h1>
    </div>
    <div class="container mt-3">
        <!-- Breadcrumb -->
        <div class="links">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Favorites</li>
                </ol>
            </nav>
        </div>
        <!-- Stories List [Start] -->

        <div class="stories py-5">
            <h6 class="font-weight-bold">Sort by: Date Added</h6>
            <div class="row">
                @foreach($bookmarks as $bookmark)
                <div class="col-md-3" id="bookmark-div-{{ $bookmark->id }}">
                    <div class="card favorite_story_card mt-4">
                        <img src="{{ $bookmark->image_url }}" class="card-img-top" alt="{{$bookmark->image_name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$bookmark->title}}</h5>
                            <p class="card-text mb-1">by <span class="author">{{$bookmark->author}}</span></p>
                            <hr>
                            <p class="card-text">For ages {{$bookmark->age_from}} - {{$bookmark->age_to}} years</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="reactions">
                                @if ($bookmark->reaction == 'dislike')
                                <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                <i class="fa fa-thumbs-down fav-icon fav-red" id="fav-dislike-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                @elseif ($bookmark->reaction == 'like')
                                <i class="fa fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                <i class="fa fa-thumbs-down fav-icon " id="fav-dislike-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                @else
                                <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                <i class="fa fa-thumbs-down fav-icon" id="fav-dislike-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                @endif
                            </div>
                            <div class="bookmark">
                                <a> <i class="fa fa-bookmark fav-icon bookmark-blue" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-{{ $bookmark->id }}" data-story-id="{{ $bookmark->id }}" data-fav-id = "{{ $bookmark->id }}"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Stories List [End] -->
</div>
@endsection
