@extends('layouts.app')

@section('other_head_title')
Phenomenal Categories of Kids Stories
@endsection

@section('custom_css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}">
@endsection

@section('content')

    <div class="content">
        <!-- Showcase -->
        <section class="top-container">
            <header class="showcase">
                <h1 class="text-white"> Categories </h1>
            </header>
        </section>

        <!-- Navigation --> 
        <nav class="min-nav">
            <ul>
                <li><a href="{{ route('homepage') }}"> Home </a></li>
                <i class="fa fa-chevron-right"></i>
                <li><a class="current" href="{{ route('categories.index') }}"> Categories </a></li>
            </ul>
        </nav>   

        <!-- Story Categories -->
        <span >
            <h1 class="container1 span"> All Categories </h1>
        </span>    

        <div class="wrapper">     
            @foreach ($categories as $category)

                <div class="item">
                    <a href="{{ route('categories.stories', $category->id) }}">
                        @if($category->image_url )
                        <img class="category" src="{{ $category->image_url }}">
                        @else
                        <img class="category" src="/favicon/android-icon-512x512.png">
                        @endif
                        <div class="info"> {{ $category->name }} </div> 
                    </a>
                </div>

            @endforeach     
        </div>
    </div>

    <section class="main-banner">
        <div class="container2">
            <div class="row c">

                <!--Image Column-->
                <div class="col-lg-4 col-md-12 col-sm-12 pcab">
                    <img src="{{ asset('images/resources/bottom.jpg') }}" alt=""  />
                </div>

                
                <!--Content Column-->
                <div class="content-column col-lg-8 pcad col-md-12 col-sm-12">
                    <div class="applink">
                        <h4>Get up close with your child</h4>
                        <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                        </div>
                        <div class="buttons-box">
                            <!-- <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="images/icons/apple.png" alt="" /></a> -->
                            <a href="https://play.google.com/store/apps/details?id=com.project.android_kidstories" class="theme-btn slideInRight"><img src="{{ asset('images/icons/playstore.png') }}" alt="" /></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>   

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

@endsection