@extends('layouts.app')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/MultiFileUpload.css')}}">
@endsection

@section('content')
    <!-- Header goes here -->
    <div class="page-wrapper">
        <div class="auto-container">
            <section class="add-story">
                <form action="/create-story" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
                     <div class="form-input">
                        <label for="category">Category</label>
                        <select name="category_id" id="categor" class="form-control form-control-lg" required>
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-input title-input">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" required>
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
                        <label for="cover">Cover Image</label>
                        {{-- <input type="file" name="photo" id="cover"> --}}

                        <p id="for_ad_image" class="valError text-danger small"></p>
                        <div class="file-upload-previews"></div>
                        <div class="file-upload">
                            <input type="file" name="photo" 
                                class="file-upload-input with-preview" 
                                title="Click to add files" 
                                maxlength="1" accept="jpg|jpeg|png|gif" 
                                onchange="checkFile(this)" id="img">
                            <span style="color:#000">CLICK OR DRAG IMAGES HERE</span>
                            <input type="hidden" id="imgCount" value="1"/>
                            <input type="hidden" id="previousImages" 
                                    name="previousImages" value="1">
                        </div>
                    </div>
                    <div class="form-input">
                        <label for="category">Tags</label>
                        <select name="tags[]" id="tags" 
                            class="form-control form-control-lg" multiple required>
                            <option value=""></option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
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
@section('js')
    <script type="text/javascript" src="{{asset('js/jQuery.MultiFile.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/select2_init.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/MultiFileUpload.js')}}"></script>
@endsection