@extends('admin.layouts.app', ['title' => __('Manage Stories')])

@section('content')
@include('admin.stories.partials.header', ['title' => __('Edit Story')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Manage Stories') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.stories.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.stories.partials.flash')
                    <form method="post" action="{{ route('admin.stories.update',$story->slug) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <h6 class="heading-small text-muted mb-4">{{ __('Story information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="form-group {{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Category') }} </label>
                                <select name="category_id" class="form-control form-control-alternative">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == old('category_id')?'selected':
                                                    $category->id == $story->category_id?'selected':''}}>
                                        {{$category->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Title') }} *</label>
                                <input type="text" name="title" class="form-control form-control-alternative" required value="{{old('title')?:$story->title}}">
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('photo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Story Image') }} </label>
                                <p id="for_ad_image" class="valError text-danger small"></p>
                                @if ($story->image_url)
                                <div class="file-upload-previews">
                                    <div class="MultiFile-label">
                                        <a class="MultiFile-remove" href="#" id="removeAdImg" data-item-id="{{$story->id}}" data-img-name="{{$story->image_url}}">x</a>
                                        <span>
                                            <span class="MultiFile-label" title="File selected: {{$story->image_url}}.jpg">
                                                {{-- <span class="MultiFile-title">{{$story->image_url}}</span> --}}
                                            <img class="MultiFile-preview" style="max-height:100px; max-width:100px;" src="{{$story->image_url}}">
                                        </span>
                                        </span>
                                        <input type="hidden" name="previousImage" value="{{$story->image_url}}" />
                                    </div>
                                </div>
                                @endif

                                <div class="file-upload" style="display:{{$story->image_url?'none':'block'}}">
                                    <input type="file" name="photo" class="file-upload-input with-preview" title="Click to add files" maxlength="1" accept="jpg|jpeg|png|gif" onchange="checkFile(this)" id="img">
                                    <span style="color:#000">CLICK OR DRAG IMAGES HERE</span>
                                    <input type="hidden" id="imgCount" value="1" />
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('tags') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Tags') }} </label>
                                <select name="tags[]" id="tags" multiple required class="form-control form-control-alternative">
                                    <option value=""></option>
                                    @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" {{in_array($tag->id,$story->tags->pluck('id')->all())?'selected':''}}>
                                        {{$tag->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tags'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('body') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Content') }} *</label>
                                <textarea style="height:200px" type="text" class="description form-control form-control-alternative" name="body" required>
                                {{old('body')?:$story->body}}
                                </textarea>
                                @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('age') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Age') }} *</label>
                                <input type="text" name="age" class="form-control form-control-alternative" required value="{{old('age')?:$story->age}}">
                                @if ($errors->has('age'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('author') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Author') }} </label>
                                <input type="text" name="author" class="form-control form-control-alternative" value="{{old('author')?:$story->author}}">
                                @if ($errors->has('author'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('author') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('is_premium') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-is_premium">{{ __('Subscription') }}</label><br>
                                <input type="radio" name="is_premium" value="1" {{old('is_premium')==1?'checked':
                                                $story->is_premium == 1?'checked':''}}> Premium<br>
                                <input type="radio" name="is_premium" value="0" {{old('is_premium')==='0'?'checked':
                                                $story->is_premium == 0?'checked':''}}> Regular<br>
                                @if ($errors->has('is_premium'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_premium') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footers.auth')
</div>
@endsection
@push('js')
<link rel="stylesheet" type="text/css" href="{{asset('css/MultiFileUpload.css')}}">
<script type="text/javascript" src="{{asset('js/jQuery.MultiFile.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/MultiFileUpload.js')}}"></script>
<script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
<script type="text/javascript" src="{{asset('js/select2_init.js')}}"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea.description',

    });
</script>
@endpush