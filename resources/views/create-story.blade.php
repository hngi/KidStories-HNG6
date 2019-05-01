@extends('layouts.app')

@section('custom_css')
<link rel="stylesheet" type="text/css" href="css/favourites.css">
@endsection

@section('content')
    <!-- Header goes here -->


    <div class="page-wrapper">
            <!-- Header with BG Image -->
            <div class="favourites_header d-flex justify-content-center align-items-center">
                <h1 class="text-white">Add New Story</h1>
            </div>

        <div class="auto-container">

            <section class="add-story">
                <form action="/create-story" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
                    <div class="top-form">
                        <div class="form-group col-md-6 title-input">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="photo">Cover Image</label>
                            <input type="file" name="photo" id="photo">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Age</label>
                            <input type="text" name="age" id="age">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="author">Author</label>
                            <input type="text" name="author" id="author">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="story_duration">Story Duration</label>
                            <input type="text" name="story_duration" id="story_duration">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control form-control-lg">
                                <option value=""></option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="content">Body</label>
                        <textarea placeholder="And the fish happened to grow wings..." name="body" id="body" cols="50" rows="10"></textarea>
                    </div>
                    <div class="buttons col-md-12">
                        <button class="btn discard">Discard</button>
                        <button class="btn save">Save</button>
                    </div>
                </form>
            </section>
        </div>

        
    </div>
    <!--End pagewrapper-->


    <!-- Footer goes here -->
    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

@endsection
