@extends('layouts.app')
@section('custom_css')
<link href="{{ asset('css/singlestory.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
@section('content')
<div class="content">
    <!-- Showcase -->
    <section class="top-container">
        <header class="showcase">
            <h1 class="text-white">  </h1>
        </header>
    </section>
    <!-- Begin -->
    <span class="content1 topic">
        <h1 >{{$story->title}}</h1>
    </span>
    <br>
    <div class="content1">
        <div class="">
            <img class="pull-left dragon" style="width:40%" src="{{$story->image_url}}">              
            <h2> What Is Lorem Ipsum </h2>
            <p>
                {{$story->body}}
            <img class="pull-right dragon2" src="https://res.cloudinary.com/solape/image/upload/v1556481719/dragon.svg">
            "Very popular during the Renaissance. The first line of..."
            Looked up one of the most obscure Latin words,
            consectetur, from a Lorem Ipsum passage, and going through the cities of
            the world in classical literature,
            very popular in the Renaissance.
            "Very popular during the Renaissance. The first line of..."
            Looked up one of the most obscure Latin words,
            consectetur, from a Lorem Ipsum passage, and going through the cities of
            the world in classical literature,
            very popular in the Renaissance.
           
            "Very popular during the Renaissance. The first line of..."
            Looked up one of the most obscure Latin words,
            consectetur, from a Lorem Ipsum passage, and going through the cities of
            the world in classical literature,
            very popular in the Renaissance.
            "Very popular during the Renaissance. The first line of..."
            Looked up one of the most obscure Latin words,
            consectetur, from a Lorem Ipsum passage, and going through the cities of
            the world in classical literature,
            very popular in the Renaissance.
        
            The first line of Lorem Ipsum, "Lorem Ipsum dolor sit
            </p>
        </div>
        <h1 class="end">THE END</h1>
        <div class="tags">
            <div>
                @foreach ($story->tags as $tag)
                    <button class="" type="submit" id="submit"> {{$tag->name}} </button>
                @endforeach
                <i class="fa fa-thumbs-down likes"><span> {{$story->likes}} </span></i>
                <i class="fa fa-thumbs-up likes"><span> {{$story->dislikes}} </span></i>
            </div>
        </div>
        <hr>
        <h2 class="h2-stories"> Stories You Might Like </h2>
        <section id="story">
            @foreach ($similarStories as $similarStory)
                <div>
                    <img class="pull-left stories" style="width:9%"
                        src="{{$similarStory->image_url}}" class="img">
                    <h2>{{$similarStory->title}}</h2>
                    <p>
                        {{str_limit($similarStory->body,150)}}
                        <br>
                        <span>
                            <a href="/show-story/{{$similarStory->id}}"> Read More... </a>
                        </span>
                    </p>
                </div>
            @endforeach
        </section>                                
    </div>
</div>
@endsection
