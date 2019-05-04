@extends('layouts.app')
@section('custom_css')
    <link href="{{ asset('css/singlestory.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" 
        crossorigin="anonymous">
@endsection
@section('content')
    <div class="banner">
        <img class="banner-image" 
            src="https://res.cloudinary.com/solape/image/upload/v1556431411/Screen_Shot_2019-04-28_at_7.03.06_AM.png" alt="banner">
    </div>
    <div id="main">
    </div>
    <h1>{{ucfirst($story->title)}}</h1>
    <div class="sections">
        <h2>What is Lorem Ipsum?</h2>
        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>

    <div class=image>
        <img src="{{$story->image_url}}">
        <p>{{$story->body}}</p>
    </div>
    <div class="tags">
        <div> 
            @foreach ($story->tags as $tag)
                <button type="submit" id="submit"> {{$tag->name}} </button>
            @endforeach
        </div>
        <div> 
            @if ($story->reaction === 'dislike')
            <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" name="fav-like" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
            <i class="fas fa-thumbs-down fav-icon fav-red" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;" ></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
            @elseif ($story->reaction == 'like')
            <i class="fas fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
            <i class="fas fa-thumbs-down fav-icon " id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;" ></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
            @else
            <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
            <i class="fas fa-thumbs-down fav-icon" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;" ></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
            @endif
        </div>
    </div>
    <hr>
    <h2 class="h20"> Stories You Might Like </h2>
    <div id="stories">
        @foreach ($similarStories as $similarStory)
            <div class="stories-p">
                <div> 
                    <img src="{{$similarStory->image_url}}" class="img">
                </div>
                <div>
                    <h2> {{$similarStory->title}}</h2>
                    <p>  {{str_limit($similarStory->body,80)}} 
                        <br><span> <a href="/show-story/{{$similarStory->id}}">Read More... </a> </span> 
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    {{-- </div> --}}
 {{-- </div> --}}
 {{-- <div id="stories">
    <div class="stories-p">
        <div> 
            <img src="https://res.cloudinary.com/solape/image/upload/v1556534093/Myth.svg" class="img">
        </div>
        <div>
            <h2> The Legend of the Dragon that Fell From the Sky</h2>
            <p>  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. <br><span> <a href="#">Read More... </a> </span>  </p>
        </div>
    </div>
</div> --}}
</div>
@endsection
