@extends('layouts.app')

@section('content')
<div class="favourites">
        <!-- Header with BG Image -->
        <div class="favourites_header d-flex justify-content-center align-items-center">
            <h1 class="text-white">Favourites Stories</h1>
        </div>
        <div class="container mt-3">
            <!-- Breadcrumb -->
            <div class="links">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
            <!-- Stories List [Start] -->
            
            <div class="stories py-5">
                <h6 class="font-weight-bold">Sort by: Date Added</h6>
                <div class="row">
                    @foreach($bookmarks as $bookmark)
                    <div class="col-md-3">
                        <div class="card story_card mt-4">
                            <img src="{{ $bookmark->image_url }}" class="card-img-top" alt="{{$bookmark->image_name}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$bookmark->title}}</h5>
                                <p class="card-text mb-1">by <span class="author">{{$bookmark->author}}</span></p>
                                <hr>
                                <p class="card-text">For ages {{$bookmark->age}} years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <button onclick="react(event);"><i class="fa fa-thumbs-up mr-2 liked" data-story-id="{{ $bookmark->id }}"></i></button><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                    <i class="fa fa-thumbs-down mr-2" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                </div>
                                <div class="bookmark">
                                    <i class="fa fa-bookmark"></i>
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
