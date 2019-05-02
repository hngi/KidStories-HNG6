@extends('layouts.app')

@section('custom_css')
<link rel="stylesheet" type="text/css" href="css/categories.css">
@endsection

@section('content')
    <!-- Header goes here -->


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
                <h1 class="container1 span"> All Story Categories </h1>
            </span>    

            <div class="wrapper">     
                @foreach ($categories as $category)

                    <div class="item"><a href="#"> <img class="category" src="{{ $category->image_url }}"> <div class="info"> {{ $category->name }} </div> </a></div>

                @endforeach     
            </div>

            <!-- Poem Categories-->
            {{-- <span >
                    <h1 class="container1 span"> Poems </h1>
            </span>    
            
            <div class="wrapper">     
                <div class="item"><a href="#"> <img class="category" src="images/categories/Myth.jpg"> <div class="info"> Animal Poem </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="images/categories/fairytales.JPG"> <div class="info"> Adventure </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="images/categories/animals.jpeg"> <div class="info"> Lullaby </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="images/categories/fearful2.png"> <div class="info"> Fearful </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="images/categories/fables.jpeg"> <div class="info"> Fables </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="images/categories/history.png"> <div class="info"> History </div> </a></div>         
            </div>  --}}   
    </div>

    <!-- App Section -->
    <section class="main-banner">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Image Column-->
                <div class=" col-lg-4 col-md-12 col-sm-12">
                    <img src="images/resources/gp23.png" alt="" />
                </div>

                
                <!--Content Column-->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h4>Get up close with your child</h4>
                        <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                        </div>
                    <div class="buttons-box">
                <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="images/icons/apple.png" alt="" /></a>
                <a href="#" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="images/icons/playstore.png" alt="" /></a>
            </div>
                    </div>
                </div>

            </div>
        </div>
    </section> 

    <!-- Footer goes here -->
    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

@endsection
