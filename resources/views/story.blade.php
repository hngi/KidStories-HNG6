@extends('layouts.app')

@section('content')
<div class="sp-container">


    <!-- Story section begins here -->
    <section id="sp-story">
        <div class="sp-story">

            <h1 class="sp-story-title">{{$story->title}}</h1>
            <h2 class="sp-story-subheader">What is Lorem Ipsum?</h2>
            <p class="sp-story-cont">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's
                De Finibus Bonorum et Malorum for use in a type specimen book.
            </p>
            <img class="sp-story-imgx" src="{{$story->image_url}}">
            <p class="sp-story-cont">{{$story->body}}</p>
            <div class="sp-story-footer">


                <div class="sp-tag-container">
                    <ul class="sp-tags">
                        <li class="sp-tag"><a href="">History</a></li>
                        <li class="sp-tag"><a href="">History</a></li>
                        <li class="sp-tag"><a href="">History</a></li>
                        <li class="sp-tag"><a href="">History</a></li>
                        <li class="sp-tag"><a href="">History</a></li>
                    </ul>
                </div>

                <div class="sp-interactions">
                    <ul class="sp-int-btns">
                        <li class="sp-int-btn"><small class="mr-3" id="likes-count-{{ $story->id }}">{{$story->likes_count}}</small><i class="fa fa-thumbs-up mr-2 liked fav-icon" id="fav-like" onclick="react(event);" data-story-id="{{ $story->id }}"></i></li>
                        <li class="sp-int-btn"><small id="dislikes-count-{{ $story->id }}">{{$story->dislikes_count}}</small><i class="fa fa-thumbs-down mr-2 fav-icon" id="fav-dislike" onclick="react(event);" data-story-id="{{ $story->id }}"></i></li>
                        <li class="sp-int-btn"><i class="fa fa-bookmark-o"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- story section ends here -->

    <hr>
    <!-- Section stories you may like starts here -->
    <section id="sp-related">
        <div class="sp-related">
            <h2 class="sp-rs-header">Stories You Might Like</h2>
            <div class="sp-rs">
                <img class="sp-rsx-img" src="https://res.cloudinary.com/solape/image/upload/v1556534093/Myth.svg">
                <!-- <img src="img.jpg" class="sp-rsx-img"> -->
                <div class="sp-rs-cont">
                    <h2 class="sp-rs-title">The Legend Of The Dragon That Fell From The Sky</h2>
                    <p class="sp-rs-body">Lorem Ipsum is dummy text which has no meaning however looks very similar to real text. A quick and simplified answer is that Lorem Ipsum refers to text that the DTP (Desktop Publishing) industry use as replacement text when the
                        real text is not available. ... Lorem Ipsum is dummy text which has no meaning however looks very similar to real text.</p>
                </div>
            </div>


        </div>
    </section>
    <!-- Section stories you may like ends here -->

</div>
@endsection
