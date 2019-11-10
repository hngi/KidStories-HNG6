@extends('layouts.app')

@section('other_head_title')
About
@endsection

@section('other_head_description')
Ensuring awesome quality Kids Stories is part of our core values. Find out more.
@endsection

@section('custom_css')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')

<div class="bannerx">
    <div class="banner__content">
        <h1 class="faq-text">About Us</h1>
    </div> 
</div>

<div class="auto-container m-b-60">
    <p>Kid Stories is an amazing, interactive and educational app for kids’ bedtime stories and moral lessons.
    This app is created for parents and their children in order to learn, read and enjoy famous stories.</p>
    <p>Stories are available in different age categories and genre, the app is embedded with different story kinds such as:</p>
    <ul class="d-flex flex flex-wrap col-lg-10 mx-auto p-1">
        <li class="flex flex-wrap col-sm-2 px-2 text-center">
            <img src="/images/icons/swing.png" alt="" class="story-cat-img">
            <p class="story-cat-img">Moral Stories</p>   
        </li>
        <li class="flex flex-wrap col-sm-2 px-2 text-center">
            <img src="/images/icons/fantasy.png" alt="" class="story-cat-img">
            <p class="story-cat-img">Fable</p>   
        </li>
        <li class="flex flex-wrap col-sm-2 px-2 text-center">
            <img src="/images/icons/african.png" alt="" class="story-cat-img">
            <p class="story-cat-img">African Bedtime Stories</p>   
        </li>
        <li class="flex flex-wrap col-sm-2 px-2 text-center">
            <img src="/images/icons/helmet.png" alt="" class="story-cat-img">
            <p class="story-cat-img">Folklore</p>   
        </li>
        <li class="flex flex-wrap col-sm-2 px-2 text-center">
            <img src="/images/icons/fairy_tales.png" alt="" class="story-cat-img">
            <p class="story-cat-img">Fairytale</p>   
        </li>
        <li class="flex flex-wrap col-sm-2 px-2 text-center">
            <img src="/images/icons/teddy-bear.png" alt="" class="story-cat-img">
            <p class="story-cat-img">Bulah</p>   
        </li>
    </ul>

    <p>Kids are also welcome to share their own stories and moral lessons for others to learn from them.</p>
    <p>
        Kid stories app was designed for primary grade children to learn to read in an interactive and engaging way anytime and anywhere with an array of different stories to help improve their English reading skills in a fun way. Kids can ignite their creativity by writing their own stories.
        Kid stories come with a reading tutor that can read stories to children
        Kid stories app is free with no ads and no subscription necessary, We are always adding new content to keep children engaged learning is fun with kid stories. <a href="https://play.google.com/store/apps/details?id=com.project.android_kidstories">Download kid stories</a> to inspire your children to become better readers
    </p>

</div>



<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
