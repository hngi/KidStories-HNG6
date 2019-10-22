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
            @include('admin.stories.partials.flash')
            <form action="{{ route('story.update', $story->slug) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                {{ csrf_field()}}
                <div class="form-input">
                    <label for="category">Category:</label>
                    <select name="category_id" id="category" class="form-control" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{$category->id == $story->category_id?'selected':''}}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-input title-input" style="margin-top: 20px;">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" required value="{{$story->title}}">
                </div>
                <div class="form-input" style="margin-top: 20px;">
                    <label for="age">Age:</label>
                    <input type="text" class="form-control" name="age" id="age" required placeholder="eg 1-4" value="{{$story->age_from.'-'.$story->age_to}}">
                </div>
                <div class="form-input" style="margin-top: 20px;">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" name="author" id="author" required value="{{$story->author}}">
                </div>
                <div class="form-input" style="margin-top: 20px;">
                    <label for="cover">Cover Image:</label>
                    <p id="for_ad_image" class="valError text-danger small"></p>
                    <div class="file-upload-previews"></div>
                    <div class="file-upload">
                        <input type="file" name="photo" class="file-upload-input with-preview" title="Click to add files" maxlength="1" accept="jpg|jpeg|png|gif" onchange="checkFile(this)" id="img">
                        <span style="color:#000">CLICK OR DRAG IMAGES HERE</span>
                        <input type="hidden" id="imgCount" value="1" />
                        <input type="hidden" id="previousImages" name="previousImages" value="1">
                    </div>
                </div>
                <div class="form-input" style="margin-top: 20px;">
                    <label for="category">Tags:</label>


                    <select name="tags[]" id="tags" class="form-control" multiple required>
                        <option value=""></option>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id,$story->tags->pluck('id')->toArray()??[]) ?'selected':''}}>
                            {{ $tag->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-input" style="margin-top: 20px;">
                    <label for="content">Content:</label>
                    <textarea class="description" placeholder="And the fish happened to grow wings..." name="body" id="content" cols="50" rows="10" required>{!!$story->body!!}</textarea>
                </div>
                <input type="hidden" value="0" name="is_premium" />
                <input type="hidden" value="{{$story->id}}" name="id" />
                <div class="buttons">
                    <button class="btn save">Update</button>
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
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea.description',
        width: 900,
        height: 300
    });
</script>
@endsection