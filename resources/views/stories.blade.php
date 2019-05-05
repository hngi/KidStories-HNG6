@extends('layouts.app')

@section('custom_css')
<link href="{{ asset('css/storieslisting.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

@endsection

@section('content')
<div class="p-0 col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb arr-right ">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
            <li class="breadcrumb-item titlecase active"><a href="#">Stories</a></li>
        </ol>
    </nav>
</div>

<div class="auto-container browse-adjust-padding mt-5">
    <div class="col-md-12 d-flex flex-row p-0 ">
        <div class="col-md-9 p-0">
            <div class="d-flex flex-column col-md-12  p-0">
                @if ($stories && count($stories) > 0)
                <div class="d-flex row flex-wrap justify-content-between">
                    @foreach ($stories as $story)
                    <div class="col-lg-4 ">
                    <div class="card col-lg-12 p-0 story-card mb-4 premium-badge-holder">
                        @if($story->is_premium)
                        <span class="badge badge-primary premium-badge">PREMIUM</span>
                        @endif
                        @if($story->image_url )
                        <img src="{{$story->image_url}}" />
                        @else
                        <img src="/images/placeholder.png" />
                        @endif
                        <div class="card-body story-card-body">
                            <h5 class="card-title"><a href="/show-story/{{$story->id}}">{{$story->title}}</a></h5>
                            <p class="card-text">By <a href="#">{{$story->author}}</a></p>
                            <hr style="margin:0 -5px;">
                            <p>For Kids {{ $story->age_from .' to '. $story->age_to }} years</p>
                            <hr style="margin:0 -20px;">
                            <div class="d-flex justify-content-between align-items-center card-">
                                <div class="btn-group">
                                    @if ($story->reaction == 'dislike')
                                    <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                                    <i class="fas fa-thumbs-down fav-icon fav-red" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                                    @elseif ($story->reaction == 'like')
                                    <i class="fas fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                                    <i class="fas fa-thumbs-down fav-icon " id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                                    @else
                                    <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                                    <i class="fas fa-thumbs-down fav-icon" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                                    @endif
                                </div>
                                <span class="verticalLine">
                                    @if ($story->favorite == true)
                                    <a> <i class="far fa-bookmark bookmark-blue" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                                    @else
                                    <a> <i class="far fa-bookmark" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                    @endforeach
                </div>
                {{$stories->links()}}
                @else
                <p class="empty-response">{{$message}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex flex-row col-md-12  ">
                
                <div class="col-md-12" id="category-drop">
                    <h6>POPULAR CATEGORIES</h6><br>
                    <a href="/categories/1">Fantasy</a><br>
                    <a href="/categories/4">Jokes</a><br>
                    <a href="/categories/2">Bedtime Stories</a><br>
                    <a href="/categories/3">Morning Stories</a>

                    <hr style="width:10%;">
                    <div class="searchContainer">
                        <i class="fa fa-search searchIcon"></i>
                        {!!Form::open(['route'=>['stories.search'],'method'=>'GET'])!!}
                        <input class="searchBox" type="search" style="height:30px; width: 100%;" name="search" placeholder="Search...">
                        {{ Form::close() }}
                        {{-- --}}
                    </div>
                    <hr style="width:10%;">
                    <p>Sort By</p>
                    <div class="card" style="width: 15rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="/categories/1/stories/sort/age" style="color:inherit;">Age </a> <i class="fas fa-graduation-cap icon-right"></i></li>
                            {{-- <li class="list-group-item">Duration <i class="fas fa-tools icon-right"></i></li>  --}}
                            <li class="list-group-item"><a href="/categories/2/stories/sort/recent" style="color:inherit;">Most Recent </a><i class="fas fa-tint icon-right"></i></li>
                        </ul>
                    </div>
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
            <div class="col-lg-4 col-md-12 col-sm-12 ">
                <img src="../images/resources/bottom.jpg" alt="" />
            </div>


            <!--Content Column-->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="applink">
                    <h4>Get up close with your child</h4>
                    <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                    </div>
                    <div class="buttons-box">
                        <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="../images/icons/apple.png" alt="" /></a>
                        <a href="#" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="../images/icons/playstore.png" alt="" /></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End App Section -->
<!-- Footer goes here -->
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>
@endsection
