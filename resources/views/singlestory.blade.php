@extends('layouts.app')
@section('custom_css')
<link href="{{ asset('css/storieslisting.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/singlestory.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
@section('content')

<div class="p-0 col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb arr-right ">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
            <li class="breadcrumb-item titlecase active"><a href="{{route('story.show',$story->slug)}}"> {{$story->title}} </a></li>
        </ol>
    </nav>
</div>
<div class="content">
    <!-- Content begins -->

    <span class="content1 topic">
        <h1 class="titlecase"> {{$story->title}} </h1>
        <h3 class="titlecase"> By: {{$story->author}} </h3>
    </span>


    <!-- Story section -->
    <div class="content1">

        <!-- Bookmark story -->
        <div class="subContent">

            <div class="subcontent-icon" style="margin-buttom:20px;">

                @if ($story->favorite == true)
                <a> <i class="far fa-bookmark bookmark-blue stBookmark" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                @else
                <a> <i class="far fa-bookmark stBookmark" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                @endif

                <br>

            </div> <!-- Bookmark story ends -->

            <!-- Stories -->
            <img class="stories" src="{{$story->image_url ?? '/images/placeholder.png'}}">
            {!!$story->body!!}
        </div>

        <h1 class="end"> THE END </h1>

        <!-- Story section ends -->

        <!-- Tags -->
        <div class="tags">
            <div>
                <div style="float:left;">
                    @foreach ($story->tags as $tag)
                    <button class="" type="submit" id="submit"> {{$tag->name}} </button>
                    @endforeach
                </div>
                <div style="float:right;">
                    @if ($story->reaction == 'dislike')
                    <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                    <i class="fa fa-thumbs-down fav-icon fav-red" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                    @elseif ($story->reaction == 'like')
                    <i class="fa fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                    <i class="fa fa-thumbs-down fav-icon " id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                    @else
                    <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                    <i class="fa fa-thumbs-down fav-icon" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                    @endif
                </div>
            </div>

        </div>

        <!-- Tags ends -->
        <hr>
        <h1> Stories You Might Like </h1>
        <!-- Cards section -->
        <div class="stories">
            <div class="row">
                @foreach ($similarStories as $similarStory)
                <div class="col-md-3">
                    <div class="card story_card mt-4">
                        @if($similarStory->is_premium)
                        <span class="badge badge-primary premium-badge">PREMIUM</span>
                        @endif
                        <img src="{{$similarStory->image_url ?? '/images/placeholder.png'}}" class="card-img-top cards" alt="story image">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size:1rem">
                                <a href="{{route('story.show',$story->slug)}}">
                                    {{str_limit($similarStory->title,22)}}
                                </a>
                            </h5>
                            <p class="card-text mb-1">by
                                <span class="author">
                                    {{$similarStory->author}}
                                </span>
                            </p>
                            <hr>
                            <p class="card-text">For kids {{$similarStory->age}} years</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="reactions">
                                <a class="like" href="#">
                                    <i class="fa fa-thumbs-up mr-2"></i>
                                    <small class="mr-3"> {{$similarStory->likes}} </small>
                                </a>
                                <a class="dislike" href="#">
                                    <i class="fa fa-thumbs-down mr-2"></i>
                                    <small> {{$similarStory->dislikes}} </small>
                                </a>
                            </div>
                            <div class="bookmark">
                                <a>
                                    <i class="fa fa-bookmark"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- App Section -->
<section class="main-banner">
    <div class="container2">
        <div class="row c">
            <!--Image Column-->
            <div class="col-lg-4 col-md-12 col-sm-12 pcab">
                <img src="/images/resources/bottom2.jpg" alt="" />
            </div>

            <!--Content Column-->
            <div class="content-column col-lg-8 pcad col-md-12 col-sm-12">
                <div class="applink">
                    <h4>Get up close with your child</h4>
                    <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                    </div>
                    <div class="buttons-box">
                        <!-- <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/apple.png" alt="" /></a> -->
                        <a href="https://github.com/hnginternship5/kidstories-android/blob/production/Bedtimestory/app/debug/app-debug.apk" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/playstore.png" alt="" /></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- App sections ends -->
@endsection