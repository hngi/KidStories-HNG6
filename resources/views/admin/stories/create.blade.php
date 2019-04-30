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
                                <a href="{{ route('stories.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        <form method="post" action="{{ route('stories.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Story information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }} *</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                 <div class="form-group{{ $errors->has('image_url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image_url">{{ __('upload Image') }}</label>
                                    <input type="file" name="image_url" id="input-image_url" class="form-control form-control-alternative{{ $errors->has('image_url') ? ' is-invalid' : '' }}" placeholder="{{ __('image_url') }}" value="{{ old('image_url') }}">

                                    @if ($errors->has('image_url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_url') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('image_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="inimage_nameput-image_name">{{ __('Image Name') }} *</label>
                                    <input type="text" name="image_name" id="input-image_name" class="form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('image_name') }}" value="{{ old('image_name') }}" required>

                                    @if ($errors->has('image_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                 <div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Story') }} *</label>
                                    <textarea style="height:200px" type="text" name="body" id="input-body" class="form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="" value="{{('body') }}" required>
                                    </textarea>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Author') }} *</label>
                                    <input type="text" name="author" id="input-author" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Author') }}" value="{{ old('author') }}" required>

                                    @if ($errors->has('author'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('author') }}</strong>
                                        </span>
                                    @endif

                               </div>
                          
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Category') }} *</label>
                                        <br>
                                    <input type="checkbox" name="category_id" value="categories A">categories A
                                        <br>
                                    <input type="checkbox" name="category_id" value="categories B">categories B
                                        <br>
                                    <input type="checkbox" name="category_id" value="categories C">categories C

                                   @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif            

                                </div>                           

                            <div class="form-group{{ $errors->has('age') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-age">{{ __('Age') }} *</label>
                                 <br>
                                 <input type="checkbox" name="age" value="2-3">2-3
                                 <br>
                                 <input type="checkbox" name="age" value="3-5">3-5
                                 <br>
                                 <input type="checkbox" name="age" value="5-10">5-10

                                 @if ($errors->has('age'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('age') }}</strong>
                                        </span>
                                    @endif

                            </div> 


                            <div class="form-group{{ $errors->has('story_duration') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-story_duration">{{ __('Story Duration') }}</label>
                                    <input type="text" name="story_duration" id="input-story_duration" class="form-control form-control-alternative{{ $errors->has('story_duration') ? ' is-invalid' : '' }}" placeholder="{{ __('story_duration') }}" value="{{ old('story_duration') }}">

                                    @if ($errors->has('story_duration'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('story_duration') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-user_id">{{ __('User ID') }}</label>
                                    <input type="text" name="user_id" id="input-user_id" class="form-control form-control-alternative{{ $errors->has('user_id') ? ' is-invalid' : '' }}" placeholder="{{ __('user_id') }}" value="{{ old('user_id') }}">

                                    @if ($errors->has('user_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-created_at">{{ __('User ID') }}</label>
                                    <input type="text" name="created_at" id="input-user_id" class="form-control form-control-alternative{{ $errors->has('created_at') ? ' is-invalid' : '' }}" placeholder="{{ __('created_at') }}" value="{{ old('created_at') }}">

                                    @if ($errors->has('created_at'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('created_at') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('is_premium') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-is_premium">{{ __('Premium') }}</label>
                                    <select name="is_premium">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option> 
                                    </select>
                                @if ($errors->has('is_premium'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('is_premium') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-user_id">{{ __('Date') }}</label>
                                    <input type="date" name="user_id" id="input-user_id" class="form-control form-control-alternative{{ $errors->has('user_idn') ? ' is-invalid' : '' }}" placeholder="{{ __('user_id') }}" value="{{ old('Story Duration') }}">

                                    @if ($errors->has('user_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                            </div>

                                {{-- <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="" required>
                                </div> --}}

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