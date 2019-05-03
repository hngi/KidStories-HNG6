@extends('layouts.app')

@section('custom_css')

@endsection

@section('content')
    <!-- Header goes here -->


    <div class="page-wrapper">

        <div class="auto-container">

            <section class="add-story">
                <form action="/create-story" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}

                    <div class="top-form">
                        <div class="form-input title-input">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" required>
                        </div>
                        <div class="form-input">
                            <label for="cover">Cover Image</label>
                            <input type="file" name="photo" id="cover">
                        </div>
                        <div class="form-input">
                            <label for="age">Age</label>
                            <input type="text" name="age" id="age" required placeholder="eg 1-4">
                        </div>
                        <div class="form-input">
                            <label for="author">Author</label>
                            <input type="text" name="author" id="author" required>
                        </div>
                        <div class="form-input">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control form-control-lg" required>
                                <option value=""></option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-input">
                        <label for="content">Content</label>
                        <textarea placeholder="And the fish happened to grow wings..." name="body" id="content" cols="50" rows="10" required></textarea>
                    </div>
                    <div class="buttons">
                        <button class="btn save">Post</button>
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
