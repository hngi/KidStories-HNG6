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
            <li class="breadcrumb-item titlecase active"><a href="{{route('story.show',$story->id)}}"> {{$story->title}} </a></li>
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
                <div class="subcontent-icon">
                    <a>
                        <i class="fa fa-bookmark stBookmark"></i>
                    </a>
                </div> <!-- Bookmark story ends -->

                <!-- Stories -->
                <img class="stories" src="{{$story->image_url}}" >             
                <p>{{$story->body}} </p>
            </div>

            <h1 class="end"> THE END </h1>
            <!-- Story section ends -->

            <!-- Tags -->
            <div class="tags">
                <div>
                    @foreach ($story->tags as $tag)
                        <button class="" type="submit" id="submit"> {{$tag->name}} </button>
                     @endforeach
                    <i class="fa fa-thumbs-down thumbs"><span> {{$story->likes}} </span></i>
                    <i class="fa fa-thumbs-up thumbs"><span> {{$story->dislikes}} </span></i>
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
                                <img src="{{$similarStory->image_url}}" 
                                    class="card-img-top cards" alt="story image">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size:1rem">
                                        {{str_limit($similarStory->title,22)}}
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
                <div class="col-lg-4 col-md-12 col-sm-12 ">
                    <img src="/images/resources/bottom2.jpg" alt=""  />
                </div>

                <!--Content Column-->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="applink">
                        <h4>Get up close with your child</h4>
                        <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                        </div>
                        <div class="buttons-box">
                            <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/apple.png" alt="" /></a>
                            <a href="#" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/playstore.png" alt="" /></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> 
    <!-- App sections ends -->
@endsection
