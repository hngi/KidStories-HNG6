@extends('layouts.app')

@section('custom_css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}">
@endsection

@section('content')
    <!-- Header goes here -->


    <!-- Showcase -->
    <section class="top-container">
        <header class="showcase">
            <h1> Categories </h1>
        </header>
    </section>
        <!-- Navigation --> 
        <nav class="min-nav">
            <ul>
                <li><a href="#"> Home </a></li>
                <i class="fas fa-chevron-right"></i>
                <li><a class="current" href="categories.html"> Categories </a></li>
            </ul>
        </nav>   

    <!-- Story Categories -->
    <span >
        <h1 class="container span"> All Story Categories </h1>
    </span>    

    <div class="wrapper">     
        <div class="item"><a href="#"> <img src="images/categories/Myth.jpg"> <div class="info"> Myths </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/fairytales.JPG"> <div class="info"> Fairytales </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/animals.jpeg"> <div class="info"> Animals </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/fearful2.png"> <div class="info"> Fearful </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/fables.jpeg"> <div class="info"> Fables </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/history.png"> <div class="info"> History </div> </a></div>         
    </div>

    <!-- Poem Categories-->
    <span >
            <h1 class="container span"> Poems </h1>
        </span>    
    
    <div class="wrapper">     
        <div class="item"><a href="#"> <img src="images/categories/Myth.jpg"> <div class="info"> Animal Poem </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/fairytales.JPG"> <div class="info"> Adventure </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/animals.jpeg"> <div class="info"> Lullaby </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/fearful2.png"> <div class="info"> Fearful </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/fables.jpeg"> <div class="info"> Fables </div> </a></div>
        <div class="item"><a href="#"> <img src="images/categories/history.png"> <div class="info"> History </div> </a></div>         
    </div>

    <!-- Footer goes here -->

@endsection
