@extends('layouts.app')
@section('custom_css')
<link href="{{ asset('css/storieslisting.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/singlestory.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
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
        <div class="subContent col-md-10 col-lg-8 mx-auto text-center">

            <div class="subcontent-icon" style="margin-bottom:20px;">

                @if ($story->favorite == true)
                <a> <i class="far fa-bookmark bookmark-blue stBookmark" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                @else
                <a> <i class="far fa-bookmark stBookmark" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                @endif

                <br>

            </div> <!-- Bookmark story ends -->

            <!-- Stories -->
            <div>
                <img class="stories" src="{{$story->image_url ?? '/images/placeholder.png'}}">
            </div>
            <p>{!! $story->body !!} </p>
        </div>

        <h1 class="end"> THE END </h1>

        <!-- Story section ends -->

        <!-- Tags -->
        <div class="tags">
            <div>
                <div>
                    @foreach ($story->tags as $tag)
                    <button class="" type="submit" id="submit"> {{$tag->name}} </button>
                    @endforeach
                    <hr>
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
        <div style="background: #f5f5f5;">
            <hr>
            <!-- comment -->
            <div class="comments-section col-md-10 mx-auto pb-2">
                <!-- add your comment -->
                <div class="leave-comment p-2">
                    <div class="d-flex p-2 leave-comment__block">
                        <img class="leave-comment__user-img" src="/images/profile/imgIcon.png" alt="your profile picture">
                        <p class="my-auto mx-1 leave-comment__placeholder">Leave a Comment...</p>
                    </div>
                    <div class="leave-comment__add-my-comment">
                        <!-- this is just to ensure that quill elements stays on theire  own   -->
                        <div id="add-my-comment"></div>
                    </div> 
                </div>

                <!-- i think we should have if comment(s) then show this comments here  -->
                <div class="comments-block my-2">
                    <h3 class="text-center">Comments</h3>
                    <div class="comments">
                        <div class="comment py-2 px-3">
                            <img src="/images/profile/imgIcon.png" alt="image of user Seyekemi Sojirin" class="comment__user-img">
                            <p class="comment__user-name my-auto">Seyekemi Sojirin</p>
                            <p class="comment__post-date my-auto">
                                <span class="comment__post-date__date">Aug 12, 2019</span>
                                <span class="comment__post-date__time">10:20 PM</span>
                            </p>
                            <p class="comment__textContent py-1">
                                i just wanted to test how this comment of a thing really works with the feature.i just wanted to test how this comment of a thing really works with the feature. i just wanted to test how this comment of a thing really works with the feature.
                            </p>
                        </div>
                        <div class="comment py-2 px-3">
                            <img src="/images/profile/imgIcon.png" alt="image of user Seyekemi Sojirin" class="comment__user-img">
                            <p class="comment__user-name my-auto">Seyekemi Sojirin</p>
                            <p class="comment__post-date my-auto">
                                <span class="comment__post-date__date">Aug 12, 2019</span>
                                <span class="comment__post-date__time">10:20 PM</span>
                            </p>
                            <p class="comment__textContent py-2 text-justify">
                                i just wanted to test how this comment of a thing really works with the feature.i just wanted to test how this comment of a thing really works with the feature. i just wanted to test how this comment of a thing really works with the feature.
                            </p>
                        </div>
                        <div class="comment py-2 px-3">
                            <img src="/images/profile/imgIcon.png" alt="image of user Seyekemi Sojirin" class="comment__user-img">
                            <p class="comment__user-name my-auto">Seyekemi Sojirin</p>
                            <p class="comment__post-date my-auto">
                                <span class="comment__post-date__date">Aug 12, 2019</span>
                                <span class="comment__post-date__time">10:20 PM</span>
                            </p>
                            <p class="comment__textContent py-1">
                                i just wanted to test how this comment of a thing really works with the feature.i just wanted to test how this comment of a thing really works with the feature. i just wanted to test how this comment of a thing really works with the feature.
                            </p>
                        </div>
                    </div>
                </div>
            </div>       
        </div>

        <!-- Tags ends -->
        <div class="mt-2">
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
                                    <a href="{{route('story.show',$similarStory->slug)}}">
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
<!-- some scripts  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="/js/singleStory.js"></script>
@endsection