@extends('layouts.app')

@section('other_head_title')
Create New Story
@endsection

@section('other_head_description')
Create bedtime stories, fairy tales, poems and short stories for kids.
@endsection

@section('custom_css')
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/MultiFileUpload.css')}}">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    span.select2-selection.select2-selection--multiple {
        padding-left: 13px;
    }

    span.select2-selection.select2-selection--multiple ul li.select2-selection__choice {
        background: #718CFB;
        border-radius: 4px;
        padding-left: 9px;
        padding-right: 9px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    span.select2-selection.select2-selection--multiple ul li.select2-selection__choice,
    span.select2-selection.select2-selection--multiple ul li.select2-selection__choice span {
        color: #fff;
        font-family: 'Lato', sans-serif;
        font-style: normal;
        font-size: 16px;
    }

    #content {
        height: 357px;
    }

    div.form-input {
        margin: 10px auto;
    }

    section form {
        margin: auto;
    }

    .form-input label {
        color: #333333;
        font-family: 'Lato', sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 20px;
        letter-spacing: -0.5px;
    }
</style>
@endsection

@section('content')
<!-- Header goes here -->
<div class="page-wrapper">
    <div class="auto-container">
        <section class="add-story">
            @include('admin.stories.partials.flash')
            <form action="{{ route('story.store') }}" method="post" enctype="multipart/form-data" class="d-flex flex-row flex-wrap">
                {{ csrf_field()}}
                <div class="form-input col-lg-6">
                    <label for="category">Category:</label>
                    <select name="category_id" id="category" class="form-control" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{$category->id == old('category_id')?'selected':''}}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-input title-input col-lg-6">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" required value="{{old('title')}}">
                </div>
                <div class="form-input col-lg-6">
                    <label for="age">Age:</label>
                    <input type="text" pattern="([0-9]-[0-9])" class="form-control" name="age" id="age" required placeholder="eg 1-4" value="{{old('age')}}">
                </div>
                <div class="form-input  col-lg-6">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" name="author" id="author" required value="{{old('author')}}">
                </div>
                <div class="form-input col-lg-6">
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
                <div class="form-input  col-lg-6">
                    <label for="category">Tags:</label>
                    <select name="tags[]" id="tags" class="form-control" multiple required>
                        <option value=""></option>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id,old('tags')??[]) ?'selected':''}}>
                            {{ $tag->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-input  col-lg-12" style="margin-top: 20px;">
                    <label for="content">Content:</label>
                    <!-- <div name="body" id="content"></div> -->
                    <textarea class="form-control" placeholder="And the fish happened to grow wings..." name="body" id="content" cols="50" rows="10" required>
                        </textarea>
                </div>
                <input type="hidden" value="0" name="is_premium" />
                <div class="buttons  col-lg-12">
                    <button class="btn save">Post</button>
                </div>
            </form>
        </section>
    </div>
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
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    //the jQuery $ code. This will make life easy for me. No more array and stuff
    const q$ = (selector, container) => {
        return (container || document).querySelector(selector);
    }

    //FOr the quill toolbar
    var quill = new Quill('#content', {
        modules: {
            toolbar: [
                [{
                    header: [1, 2, false]
                }, 'blockquote', 'code-block'],
                ['bold', 'italic', 'underline'],
                [{
                    'script': 'super'
                }, {
                    'script': 'sub'
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, {
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                ['link', {
                    'align': []
                }],
            ]
        },
        placeholder: 'And the fish happened to grow wings...',
        theme: 'snow' // or 'bubble'
    });

    function showQuillaContents() {
        var delta = quill.getContents();
        console.log('delta', delta);
        return delta;
    }

    function setQuillaContents(content) {
        quill.setContents(content);
    }

    function entryValues() {
        const draftEntries = {};
        //Just cos of Closure, I declare my variable here again
        const selCategory = q$('select#category');
        const inpTitle = q$('input#title');
        const inpAge = q$('input#age');
        const inpAuthor = q$('input#author');
        const inpImg = q$('span.MultiFile-label img.MultiFile-preview');
        const inpContent = q$('div#content');
        const inpTag = q$('ul.select2-selection__rendered');

        // console.log('Dem', selCategory, inpTitle, inpAge, inpAuthor, inpImg, inpContent, inpTag);

        //Get the following parament for our object but first check if they exist
        if (selCategory) {
            draftEntries.selectedCategory = selCategory.value;
        }

        if (inpTitle) {
            draftEntries.postTitle = inpTitle.value;
        }

        if (inpTitle) {
            draftEntries.postTitle = inpTitle.value;
        }

        const inpContentLen = showQuillaContents();
        const inpContentLenArr = inpContentLen.ops;
        console.log('inpContentLen', inpContentLen);
        console.log('inpContentLenArr', inpContentLenArr);

        if (inpContentLenArr.length > 0) {
            draftEntries.postContent = inpContentLenArr;
        }

        if (inpAuthor) {
            draftEntries.postAuthor = inpAuthor.value;
        }

        if (inpContent) {
            draftEntries.postContent = inpContent.value.trim();
        }

        if (inpImg) {
            draftEntries.imgSrc = inpImg.src;
        }

        if (inpTag && inpTag.children.length > 1) {
            // This is add tags into an array
            // also rememeber that the last child is for search and should be include 
            let arrTag = [];
            const tagChildren = inpTag.children;
            const tagLen = tagChildren.length - 1; //to ensure we skip the search
            for (let i = 0; i < tagLen; i++) {
                const element = tagChildren[i].innerText.substring(1); //Substring to miss the 'x'
                arrTag.push(element);
            }
            draftEntries.tags = arrTag;
        }
        //Last Modified Time
        draftEntries.lastModified = Date.now();

        console.log(draftEntries);
        return draftEntries;
    }

    const getLocalStorageData = function() {
        //gets me the data cached
        if (localStorage.kidStore) {
            const modelObj = JSON.parse(localStorage.getItem('kidStore'));
            console.log('modelObj', modelObj);
            return modelObj;
        } else {
            console.log("Nooothing");
            return null;
        }
    }

    //Save back into LocalStorage
    const saveDataToLocal = (dataObj) => {
        //Clear all old data
        localStorage.clear()

        console.log('model', dataObj);
        const obj = JSON.stringify(dataObj);
        console.log('obj', obj);
        localStorage.setItem('kidStore', obj);
        console.log('Moved in', localStorage);
    }

    const updateDraft = (draftId) => {
        // I think we expect something like
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

        //Create object of draft
        const currentDraft = entryValues();
        console.log('currentDraft', currentDraft);

        //Check if we have some on localstroage
        const localData = getLocalStorageData();
        console.log('localData up', localData);
        if (localData && localData.drafts) {
            //Find the draft (object) and return draft 
            let thisDraft = localData.drafts.find(draft => {
                console.log('draft.id', draft.id, 'draftId', draftId)
                return draft.id == draftId
            });
            console.log('thisDraft', thisDraft);
            // if draft exist, update
            if (thisDraft) {
                for (const key in currentDraft) {
                    if (currentDraft[key]) {
                        thisDraft[key] = currentDraft[key];
                    }
                }
                //Save update to local
                saveDataToLocal(localData);
            }
        }
    }

    const setDraftId = () => {
        //This function is used to set ID
        //But for now I'm using Date.now change every split second
        return Date.now();
    }

    const getDraftId = (url) => {
        let id = 'draft_id';
        if (!url)
            url = window.location.href;
        id = id.replace(/[\[\]]/g, '\\$&');
        const regex = new RegExp(`[?&]${id}(=([^&#]*)|&|#|$)`),
            //eg http://127.0.0.1:8000/stories/create?draft_id=2 returns 2
            results = regex.exec(url);
        if (!results || !results[2])
            return null;
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    const addListeners = (id) => {
        // so they get the id of the post 
        //Just cos of Closure, I declare my variable here again
        //I don't think IIFE will ork since we have to determine postId first
        const selCategory = q$('select#category');
        const inpTitle = q$('input#title');
        const inpAge = q$('input#age');
        const inpAuthor = q$('input#author');
        const inpImg = q$('input.file-upload-input.with-preview.MultiFile-applied');
        // const inpContent = q$('textarea#content');
        const inpTag = q$('span.select2-selection.select2-selection--multiple');

        inpTag.addEventListener('keydown', (event) => {
            if (event.key == 'Enter') {
                // console.log('dd');
                updateDraft(id);
            }
        });
        selCategory.addEventListener('change', () => updateDraft(id));
        inpTitle.addEventListener('keyup', () => updateDraft(id));
        inpAge.addEventListener('keyup', () => updateDraft(id));
        inpAuthor.addEventListener('keyup', () => updateDraft(id));
        // inpContent.addEventListener('keyup',()=>updateDraft(id));
        inpImg.addEventListener('change', () => updateDraft(id));
        quill.on('text-change', () => updateDraft(id))
    }

    const populatePostFromDraft = (thePostId) => {
        //Populate passed on the id
        //Check if we have some on localstroage
        const localData = getLocalStorageData();
        console.log('localData up', localData);
        if (localData && localData.drafts) {
            //Find the draft (object) and return draft 
            let thisDraftP = localData.drafts.find(draft => {
                return draft.id == thePostId;
            });
            console.log('thisDraftP', thisDraftP);
            // if draft exist, update
            if (thisDraftP) {
                const selCategory = q$('select#category');
                const inpTitle = q$('input#title');
                const inpAge = q$('input#age');
                const inpAuthor = q$('input#author');
                const inpImg = q$('span.MultiFile-label img.MultiFile-preview');
                const inpContent = q$('div#content');
                const inpTag = q$('ul.select2-selection__rendered');

                //Make select
                if (thisDraftP.selectedCategory && selCategory) {
                    // select where value
                }

                //Make title
                if (thisDraftP.postTitle && inpTitle) {
                    // select where title
                    inpTitle.value = thisDraftP.postTitle;
                }

                //Make Age
                if (thisDraftP.postAge && inpAge) {
                    // select where Age
                    inpAge.value = thisDraftP.postAge;
                }

                //Make title
                if (thisDraftP.postTitle && inpTitle) {
                    // select where title
                    inpTitle.value = thisDraftP.postTitle;
                }

                //Make Content
                if (thisDraftP.postContent && inpContent) {
                    // select where Content
                    // inpContent.value = thisDraftP.postContent;
                    setQuillaContents(thisDraftP.postContent);
                }

                //Make Auhor
                if (thisDraftP.postAuthor && inpAuthor) {
                    // select where Author
                    inpAuthor.value = thisDraftP.postAuthor;
                }

                //Make Content
                if (thisDraftP.postContent && inpContent) {
                    // select where Content
                    inpContent.value = thisDraftP.postContent;
                }

                //Make tags
                if (thisDraftP.tags && inpTag) {
                    // select where tags
                    // <li class="select2-selection__choice" title="dhdhdh" data-select2-id="24"><span class="select2-selection__choice__remove" role="presentation">×</span>dhdhdh</li>

                    //Remember it => arrTag i.e an array of tag :)
                    const arrTag = thisDraftP.tags;
                    const frag = document.createDocumentFragment();
                    arrTag.forEach(tag => {
                        const li = document.createElement('li');
                        li.innerHTML = `<span class="select2-selection__choice__remove" role="presentation">×</span>${tag}`;
                        li.title = "tag";
                        li.classList.add('select2-selection__choice');

                        frag.append(li);
                    });

                    inpTag.prepend(frag);
                }
            }
        }
    }

    window.onload = () => {
        // look for ID or else set an ID

        let postId;
        const checkDraftId = getDraftId();
        console.log(checkDraftId);
        if (checkDraftId) {
            postId = checkDraftId;
            populatePostFromDraft(postId);
        } else {
            //Assign an ID
            postId = setDraftId();
            let localData = getLocalStorageData();
            if (localData) {
                if (localData.drafts) {
                    localData.drafts.push({
                        'id': postId
                    });
                }
            } else {
                localData = {};
                localData.drafts = [];
                localData.drafts.push({
                    'id': postId
                });
            }
            console.log('localData', localData);
            saveDataToLocal(localData);
            const url = window.location.href;
            document.location.hash = `?draft_id=${postId}`;
        }
        console.log('postId', postId);
        //Add them listeners
        addListeners(postId);
    };
</script>
<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea.description',
    });
</script> -->
@endsection