@extends('layouts.app')

@section('custom_css')
<link href="{{ asset('css/storieslisting.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style>
    div#category-drop {
        transform: none !important;
    }

    div#category-drop {
        transform: none !important;
        /* margin: 10px auto; */
    }

    .col-md-3.col-lg-3.catcs {
        margin-left: auto;
    }

    h3,
    h4.draft-title {
        text-align: center;
    }

    div.catcs {
        /* This centers form */
        margin-left: 0;
    }

    p#createStory {
        margin: auto;
        width: 250px
    }

    .adjust-padding {
        padding: 2rem 0 0 0;
    }

    .applink {
        margin: 5px 10px;
    }

    .draft .card {
        margin: 10px auto;
        display: flex;
        flex-wrap: wrap;
    }

    .draft .card,
    .card-body {
        display: flex;
        flex-wrap: wrap;
    }

    .draft .card .card-body * {
        /*     font-size: 17px; */
        width: 100%;
        max-width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    /* div#draft-items {
        transition: height 5s linear;
    } */

    @media screen and (min-width: 551px) {
        .adjust-padding {
            padding: 2rem 0 0 1rem;
        }
    }

    @media screen and (min-width: 750px) {
        .adjust-padding {
            padding: 2rem 0 0 5rem;
        }

        h3,
        h4.draft-title {
            text-align: left;
        }

        p#createStory {
            margin-left: 0;
        }
    }
</style>

@endsection

@section('content')
<div class="p-0 col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb arr-right ">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Stories</a></li>
        </ol>
    </nav>
</div>

<div class="auto-container adjust-padding">
    <div class="mb-5">
        <h3>My Stories</h3>
        @if ($stories->count())
        <p id="createStory" style="font-size:24px; margin-top: 20px; font-weight: 200; text-align: center;">
            <a href="{{ route('story.create') }}" class="btn btn-block" style="margin-top: 10px;">
                Create New Story
            </a>
        </p>
        @endif
    </div>
    <div class="col-md-12 d-flex cold p-0 ">
        <div class="col-md-7 col-lg-9 p-0">
            <div class="d-flex flex-column col-md-12  p-0">
                <div class="d-flex flex-row flex-wrap">
                    @forelse ($stories as $story)
                    <div class="col-lg-4 ">
                        <div class="card col-lg-12 p-0 story-card mb-4 premium-badge-holder">
                            @if($story->is_premium)
                            <span class="badge badge-primary premium-badge">PREMIUM</span>
                            @endif

                            @if($story->image_url )
                            <img src="{{ $story->image_url }}" />
                            @else
                            <img src="/images/placeholder.png" />
                            @endif

                            <div class="card-body story-card-body">
                                <h5 style="max-width: 300px;" class="card-title"><a href="{{route('story.show',$story->slug)}}">{{$story->title}}</a></h5>

                                <p class="card-text">By <a href="{{route('author.stories', $story->author)}}">{{$story->author}}</p>


                                <hr style="margin:0 -5px;">
                                <div style="display: flex; width: 20px flex-direction: row;
	                            justify-content: space-between; margin-bottom: 5px;">

                                    <p>For Kids {{ $story->age_from .' to '. $story->age_to }} years</p>
                                    <a href="{{route('story.edit', $story->slug)}}"><i class="fas fa-pen" style="padding: 5px 4px;"></i></a>
                                    <a id="deletePost" href="{{route('story.delete', $story->slug)}}" class="fas fa-trash-alt" style="padding: 5px 4px;color:red;"></a>
                                </div>
                                <hr style="margin:0 -20px;">
                                <div class="d-flex justify-content-between align-items-center card-">
                                    <div class="btn-group">
                                        @if ($story->reaction == 'dislike')
                                        <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                                        <i class="fas fa-thumbs-down fav-icon fav-red" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                                        @elseif ($story->reaction == 'like')
                                        <i class="fas fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                                        <i class="fas fa-thumbs-down fav-icon " id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                                        @else
                                        <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}"></i><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small>
                                        <i class="fas fa-thumbs-down fav-icon" id="fav-dislike-{{ $story->id }}" onclick="react(event);" data-story-id="{{ $story->id }}" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small>
                                        @endif
                                    </div>
                                    <span class="verticalLine">
                                        @if ($story->favorite == true)
                                        <a> <i class="far fa-bookmark bookmark-blue" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                                        @else
                                        <a> <i class="far fa-bookmark" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-{{ $story->id }}" data-story-id="{{ $story->id }}"></i> </a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="font-size:24px; margin-top: 20px; font-weight: 200; text-align: center;">
                        Oops! You don't have any story yet.
                        <a href="{{ route('story.create') }}" class="btn btn-block" style="margin-top: 10px;">
                            Create New Story
                        </a>
                    </p>
                    @endforelse
                </div>

                <div style="margin-top: 40px;">
                    {{ $stories->appends($_GET)->links() }}
                </div>
            </div>
            <!-- Show drafts if any  -->
            <div class="d-flex flex-column col-md-12  p-0">
                <h4 class="draft-title">My Drafts</h4>
                <div id="draft-items" class="d-flex flex-row flex-wrap"></div>
            </div>
        </div>
        <hr>
        <div class="col-md-5 col-lg-3  catcs">
            <div class="d-flex flex-row col-md-12  ">
                <div class="col-md-12 categories" id="category-drop">
                    <p>Search My Stories</p>
                    {{-- @foreach ($categories as $category)
                        <a href="{{ route('categories.stories', $category->id) }}">{{ $category->name }}</a><br>
                    @endforeach--}}

                    <hr style="width:10%;">
                    <div class="searchContainer">
                        <i class="fa fa-search searchIcon"></i>
                        <form action="{{ url()->current() }}">
                            <input class="searchBox" type="search" style="height:30px; width: 100%;" name="search" placeholder="Search..." value="{{ request()->query('search') }}" minlength="2" autocomplete="off">
                        </form>
                    </div>
                    <hr style="width:10%;">
                    <p>Sort By</p>
                    <div class="card" style="width: 100%;">
                        <form action="{{ url()->current() }}" method="GET">
                            <input type="hidden" name="search" value="{{ request()->query('search') }}">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <small style="display: block;">Max Age:</small>
                                    <select class="form-control form-control-sm" name="minAge">
                                        <option value="">Any age</option>
                                        @for ($i = 0; $i < 18; $i++) <option value="{{ $i }}" {{ !is_null(request()->query('minAge')) && request()->query('minAge') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                    </select>
                                    <small style="margin-top: 8px;display: block;">Min Age:</small>
                                    <select class="form-control form-control-sm" name="maxAge" style="margin-bottom: 8px;">
                                        <option value="">Any age</option>
                                        @for ($i = 1; $i < 18; $i++) <option value="{{ $i }}" {{ !is_null(request()->query('minAge')) && request()->query('maxAge') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                    </select>
                                </li>
                                <li class="list-group-item">
                                    <small>Category</small>
                                    <select class="form-control form-control-sm" name="category" style="margin-bottom: 8px;">
                                        <option value="">All Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ !is_null(request()->query('category')) && request()->query('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                {{-- <li class="list-group-item"><a href="{{ url()->current(). '?search=' . request()->query('search') . '&sort=latest' }}" style="color:inherit;">Most Recent </a><i class="fas fa-tint icon-right"></i></li> --}}

                                <li class="list-group-item">
                                    <button type="submit" class="form-control form-control-sm btn-primary">Sort</button>
                                </li>
                            </ul>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- App Section -->
<section class="main-banner">
    <div class="container2">
        <div class="row c">

            <!--Image Column-->
            <div class="col-lg-4 col-md-12 col-sm-12 pcab">
                <img src="{{ asset('images/resources/bottom.jpg') }}" alt="" />
            </div>


            <!--Content Column-->
            <div class="content-column col-lg-8 pcad col-md-12 col-sm-12">
                <div class="applink">
                    <h4>Get up close with your child</h4>
                    <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                    </div>
                    <div class="buttons-box">
                        <!--    <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('images/icons/apple.png') }}" alt="" /></a> -->
                        <a href="https://github.com/hnginternship5/kidstories-android/blob/production/Bedtimestory/app/debug/app-debug.apk" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('images/icons/playstore.png') }}" alt="" /></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End App Section -->
<!-- Footer goes here -->
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>
@endsection
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).on('click', '#deletePost', function(e) {

        e.preventDefault();
        if (confirm('Are you sure you want to delete this story?')) {
            window.location = e.target.href;
        }

    });


    // document.getElementById('deletePost').addEventListener('click', function($event) {
    //     $event.preventDefault();

    // });

    console.log("in0");
    const noDraft = () => {
        const p = document.createElement('p');
        p.setAttribute('style', 'font-size:24px; margin-top: 20px; font-weight: 200; text-align: center;')
        p.innerHTML = "You don't have any draft."
        return p;
    }

    const getLocalStorageData = function() {
        //gets me the data cached
        if (localStorage.kidStore) {
            // kidStore:{
            //     drafts: [
            //         {
            //             id,
            //             selectedCategory,
            //             postTitle,
            //             postAge,
            //             postAuthor,
            //             postContent,
            //             imgSrc,
            //             tags
            //         }
            //     ]
            // }
            const modelObj = JSON.parse(localStorage.getItem('kidStore'));
            console.log('modelObj', modelObj);
            return modelObj;
        } else {
            console.log("Nooothing");
            return null;
        }
    }

    const getDrafts = () => {
        //This function is used to get the draft Array
        // For now, we use the data in localStorage 

        const data = getLocalStorageData();
        return data;
    }

    const populateWithDraft = () => {
        const draftsData = getDrafts();
        const draftDiv = document.getElementById('draft-items');
        draftDiv.innerHTML = ''; //Clear everything draftDiv

        // if no draftsData, I will get Error and it will go to else statement
        if (draftsData && draftsData.drafts && draftsData.drafts.length > 0) {
            const frag = document.createDocumentFragment();
            let drafts = draftsData.drafts;

            //Let's sort by date first
            drafts = drafts.sort((a, b) =>
                new Date(b.lastModified) - new Date(a.lastModified)
            );

            drafts.forEach(draft => {
                // <div class="col-lg-4">
                //     <div class="card">
                //         <div class="card-body">
                //             <h5 class="card-title">Card title</h5>
                //             <h6 class="card-subtitle mb-2 text-muted">Last Modified: 15-Oct-2019</h6>
                //             <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                //             <a class="card-link Author">Author</a>
                //             <a href="#" class="card-link">edit</a>
                //         </div>
                //     </div>
                // </div>

                //Required Div
                const divCol = document.createElement('div');
                const divCard = document.createElement('div');
                const divCardBody = document.createElement('div');

                //Add classes to Divs
                divCol.classList.add('col-lg-4', 'draft');
                divCard.classList.add('card');
                divCardBody.classList.add('card-body');

                //make other elements
                const h5 = document.createElement('h5');
                const h6 = document.createElement('h6');
                const pContent = document.createElement('p');
                const pAuthor = document.createElement('p');
                const pEdit = document.createElement('p');
                const aAuthor = document.createElement('a');
                const aEdit = document.createElement('a');

                //Adding element Classes
                h5.classList.add('card-title');
                h6.classList.add('card-subtitle', 'mb-2', 'text-muted');
                pContent.classList.add('card-text');
                aAuthor.classList.add('card-link');
                aEdit.classList.add('card-link');

                //drafts: [
                //         {
                //             id,
                //             selectedCategory,
                //             postTitle,
                //             postAge,
                //             postAuthor,
                //             postContent,
                //             imgSrc,
                //             tags,
                //             lastModified
                //         }
                //     ]

                //Add for Post Title
                if (draft.postTitle) {
                    h5.innerHTML = draft.postTitle;
                } else {
                    h5.innerHTML = `Draft ${draft.id}`;
                }

                //Add for Post Date
                if (draft.lastModified) {
                    const date = new Date(draft.lastModified);
                    const dateStr = `${date}`;

                    // console.log('dateStr', dateStr);
                    // console.log('dateStrGMT', dateStr.indexOf('GMT'));
                    // const ind = dateStr.indexOf('GMT');
                    // console.log('moiDate', dateStr.substring(0,ind));

                    //So, I don't want to show GMT etc
                    const ind = dateStr.indexOf('GMT'); //Get indexOf GMT
                    let dateFormat = dateStr.substring(0, ind); //Gives the dat format we want
                    dateFormat = dateFormat.trim(); //Remove beginning and end whitespace

                    h6.innerHTML = `<strong>Last Modified on</strong> ${dateFormat}`;
                } else {
                    h6.innerHTML = `No Date`;
                }

                //Add for Post Excerpt
                if (draft.postContent) {
                    const txt = draft.postContent;
                    //If it's greater than 94, get the first 94 characters
                    const exc = (txt.length > 94) ? txt.substring(0, 94) : txt;
                    pContent.innerHTML = `${txt}...`;
                } else {
                    pContent.innerHTML = `No Excerpt`;
                }

                //Add for Post Author
                if (draft.postAuthor) {
                    aAuthor.innerHTML = draft.postAuthor;
                    //Add Author link
                    aAuthor.href = "";
                } else {
                    aAuthor.innerHTML = `No Author`;
                }
                aAuthor.tabIndex = -1;

                //Add for Edit Post
                aEdit.innerHTML = "Click Here to Edit";
                //Add Post link
                aEdit.href = `/stories/create#?draft_id=${draft.id}`;
                aEdit.tabIndex = -1;

                pAuthor.append(aAuthor);
                pEdit.append(aEdit);


                //Append to divCardBody in order
                divCardBody.append(h5);
                divCardBody.append(h6);
                divCardBody.append(pContent);
                divCardBody.append(pAuthor);
                divCardBody.append(pEdit);

                //Append divCardBody to divCard
                divCard.append(divCardBody);

                //Append divCard to divCol
                divCol.append(divCard);

                // Append to Fragment
                frag.append(divCol);
            });
            //Append Frag to the Big Div
            draftDiv.append(frag);
        } else {
            const para = noDraft();
            draftDiv.append(para);
        }

    }

    window.onload = () => {
        populateWithDraft()
    };
</script>