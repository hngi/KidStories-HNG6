@extends('admin.layouts.app', ['title' => __('Manage Stories')])

@section('content')
    @include('admin.stories.partials.header', ['title' => __('Add Story')])   
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
                        <form method="post" action="{{ route('admin.stories.store') }}"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Story information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group {{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Category') }} </label>
                                    <select name="category_id" 
                                        class="form-control form-control-alternative">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}"
                                                 {{$category->id == old('category_id')?'selected':''}}>
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
                                    <input  type="text" name="title" 
                                        class="form-control form-control-alternative" required
                                        value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>         
                                <div class="form-group {{ $errors->has('photo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Story Image') }} </label>
                                    <input  type="file" name="photo" 
                                        class="form-control form-control-alternative">
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>                   
                                <div class="form-group {{ $errors->has('body') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Content') }} *</label>
                                    <textarea style="height:200px" type="text" class="form-control form-control-alternative" name="body" required>{{old('body')}}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('age') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Age') }} *</label>
                                    <input  type="text" name="age"
                                        class="form-control form-control-alternative"  required 
                                        value="{{old('age')}}" placeholder="Example: 1-3">
                                    @if ($errors->has('age'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('age') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('author') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Author') }} </label>
                                    <input  type="text" name="author"
                                        class="form-control form-control-alternative" 
                                        value="{{old('author')}}">
                                    @if ($errors->has('author'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('author') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('is_premium') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-is_premium">{{ __('Subscription') }}</label><br> 
                                        <label>                                   
                                            <input type="radio" name="is_premium" value="1" {{old('is_premium')==1?'checked':''}}> Premium
                                        </label> <br>
                                        <label>
                                            <input type="radio" name="is_premium" value="0"
                                            {{old('is_premium')==='0'?'checked':''}}> Regular<br>
                                        </label>   

                                        @if ($errors->has('is_premium'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('is_premium') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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