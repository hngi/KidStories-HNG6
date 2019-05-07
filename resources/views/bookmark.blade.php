@extends('layouts.app')

@section('custom_css')
<link href="{{ asset('css/storieslisting.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

@endsection

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
            @forelse ($bookmarks as $bookmark)
                    <div class="col-lg-4 col-xs-12" id = "bookmark-div-{{$bookmark->id}}">
                    <div class="card col-lg-12 col-md-10 p-0 story-card mb-4 premium-badge-holder">
                                @if($bookmark->is_premium)
                                    <span class="badge badge-primary premium-badge">PREMIUM</span>
                                @endif

                                @if($bookmark->image_url )
                                <a href="{{route('story.show',$bookmark->slug)}}"><img src="{{ $bookmark->image_url }}" /></a>
                                @else
                                <a href="{{route('story.show',$bookmark->slug)}}"><img src="/images/placeholder.png" /></a>
                                @endif

                                <div class="card-body story-card-body">
                                    <h5 class="card-title"><a href="{{route('story.show',$bookmark->slug)}}">{{$bookmark->title}}</a></h5>
                                    <p class="card-text">By <a href="{{route('author.stories', $bookmark->author)}}">{{$bookmark->author}}</a></p>
                                    <hr style="margin:0 -5px;">
                                    <p>For Kids {{ $bookmark->age_from .' to '. $bookmark->age_to }} years</p>
                                    <hr style="margin:0 -17px;">
                                    <div class="d-flex justify-content-between align-items-center card-">
                                        <div class="btn-group">
                                            @if ($bookmark->reaction == 'dislike')
                                            <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                            <i class="fas fa-thumbs-down fav-icon fav-red" id="fav-dislike-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                            @elseif ($bookmark->reaction == 'like')
                                            <i class="fas fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                            <i class="fas fa-thumbs-down fav-icon " id="fav-dislike-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                            @else
                                            <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}"></i><small class="mr-3" id="likes-count-{{ $bookmark->id }}">{{$bookmark->likes_count}}</small>
                                            <i class="fas fa-thumbs-down fav-icon" id="fav-dislike-{{ $bookmark->id }}" onclick="react(event);" data-story-id="{{ $bookmark->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $bookmark->id }}">{{$bookmark->dislikes_count}}</small>
                                            @endif
                                        </div>
                                        <span class="verticalLine">
                                            <a> <i class="far fa-bookmark bookmark-blue" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-{{ $bookmark->id }}" data-story-id="{{ $bookmark->id }}" data-fav-id="{{ $bookmark->id }}"></i> </a>
                                            
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="font-size:24px; margin-top: 20px; font-weight: 200; text-align: center;">Oops! No stories found.</p>
                    @endforelse
            </div>
        </div>
    </div>
    <!-- Stories List [End] -->
</div>
@endsection
