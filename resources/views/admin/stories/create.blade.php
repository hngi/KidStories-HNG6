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
 <!---------------------------------------------------------------------------------------------------TITLE-------------------------------------------------------------------------------->                           
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }} *</label>
                                    <input style="width:500px;" type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>                            
<!---------------------------------------------------------------------------------------------------STORY----------------------------------------------------->                           
                            
                            <div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Story') }} *</label>
                                    <textarea style="height:200px" type="text" name="body" id="input-body" class="form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Story') }}" value="{{old('body') }}" required>
                                    {{old('body') }}
                                    </textarea>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif

                            </div>
<!---------------------------------------------------------------------------------------------------AUTHOR------------------------------------------------------------->
                            <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Author') }} *</label>
                                    <input style="width:500px;" type="text" name="author" id="input-author" class="form-control form-control-alternative{{ $errors->has('author') ? ' is-invalid' : '' }}" placeholder="{{ __('Author') }}" value="{{ old('author') }}" required>

                                    @if ($errors->has('author'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('author') }}</strong>
                                        </span>
                                    @endif
                            </div>
 <!---------------------------------------------------------------------------------------------------Category------------------------------------------------------------->                         
                            <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                               <label class="form-control-label" for="input-title">{{ __('Category') }} *</label>                                                                                                    
                                   <br>
                                    <input type="checkbox" name="category_id" value="Poem"> Poem
                                    <br>
                                    <br>
                                    <input type="checkbox" name="category_id" value="Fiction"> Fiction
                                    <br>
                                    <br>
                                    <input type="checkbox" name="category_id" value="Moral"> Moral
                                <br>                                      
                            </div>                           
<!---------------------------------------------------------------------------------------------------AGE------------------------------------------------------------->
                            <div class="form-group{{ $errors->has('age') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Age') }} *</label>
                                    <input style="width:500px;" type="text" name="age" id="input-author" class="form-control form-control-alternative{{ $errors->has('age') ? ' is-invalid' : '' }}" placeholder="{{ __('age') }}" value="{{ old('age') }}" required>
                                    @if ($errors->has('age'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('age') }}</strong>
                                        </span>
                                    @endif
                            </div> 
<!---------------------------------------------------------------------------------------------------DURATION------------------------------------------------------------->

                            <div class="form-group{{ $errors->has('story_duration') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-story_duration">{{ __('Story Duration') }}</label>
                                    
                                    <input style="width:500px;" type="text" name="story_duration" id="input-story_duration" class="form-control form-control-alternative{{ $errors->has('story_duration') ? ' is-invalid' : '' }}" placeholder="{{ __('story_duration') }}" value="{{ old('story_duration') }}">
                                    @if ($errors->has('story_duration'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('story_duration') }}</strong>
                                        </span>
                                    @endif
                            </div>
<!---------------------------------------------------------------------------------------------------PRMIUM------------------------------------------------------------->                                                   
                            <div class="form-group{{ $errors->has('is_premium') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-is_premium">{{ __('Subscription') }}</label><br>                                    
                                    <input type="radio" name="is_premium" value="Premium"> Premium<br>
                                    <input type="radio" name="is_premium" value="Regular"> Regular<br>                                    
                                @if ($errors->has('is_premium'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('is_premium') }}</strong>
                                    </span>
                                @endif
                            </div>
<!---------------------------------------------------------------------------------------------------PHOTO------------------------------------------------------------->                            
                            <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-photo">{{ __('Photo') }} <i>(Optional)</i></label>
                                    <input style="width:500px;" type="file" name="photo" id="input-photo" class="form-control form-control-alternative{{ $errors->has('photo') ? ' is-invalid' : '' }}" placeholder="{{ __('Photo') }}" value="{{ old('photo') }}">

                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                            </div>
<!---------------------------------------------------------------------------------------------------created at ------------------------------------------------------------->
                            <div class="form-group{{ $errors->has('created_at') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-created_at">{{ __('Created at') }}</label>                                    
                                    <input style="width:300px;" name="created_at" id="input-created_at" class="form-control form-control-alternative{{ $errors->has('created_at') ? ' is-invalid' : '' }}" placeholder="{{ __('created_at') }}" value="<?php echo date(DATE_RFC822); ?>">
                            </div>
<!---------------------------------------------------------------------------------------------------User ------------------------------------------------------------->
                            <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-user_id">{{ __('User ID') }}</label>                                    
                                    <input type="text" style="width:300px;" name="user_id" id="input-user_id" class="form-control form-control-alternative{{ $errors->has('user_id') ? ' is-invalid' : '' }}" placeholder="{{ __('user_id') }}" value="{{ Auth::guard('admin')->user()->name}} " readonly>
                            </div>
<!---------------------------------------------------------------------------------------------------FOOT------------------------------------------------------------->
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