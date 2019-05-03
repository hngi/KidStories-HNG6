<?php include 'partials/header.php'; ?>

    <link rel="stylesheet" href="favourites_page/favourites.css">
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    />
<body>
<div class="page-wrapper">

    <!-- Main Navigation-->
        <?php include 'partials/navbar.php'; ?>
    <!--End Main Navigation -->

    <div class="favourites">
        <!-- Header with BG Image -->
        <div class="favourites_header d-flex justify-content-center align-items-center">
            <h1 class="text-white">Favourites Stories</h1>
        </div>
        <div class="container mt-3">
            <!-- Breadcrumb -->
                <div class="links">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item align-self-center">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Library
                            </li>
                        </ol>
                    </nav>
                </div>
            <!-- Stories List [Start] -->
            <div class="stories py-5">
                <h6 class="font-weight-bold">Sort by: Date Added</h6>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card story_card mt-4">
                            <img
                                src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg"
                                class="card-img-top"
                                alt="story image"
                            />
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">
                                    by <span class="author">Peter Tarka</span>
                                </p>
                                <hr />
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <a class="like" href="#">
                                        <i class="fas fa-thumbs-up mr-2"></i>
                                        <small class="mr-3">627</small>
                                    </a>
                                    <a class="dislike" href="#">
                                        <i class="fas fa-thumbs-down mr-2"></i>
                                        <small>3255</small>
                                    </a>
                                </div>
                                <div class="bookmark">
                                    <a href="#">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card story_card mt-4">
                            <img
                                src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg"
                                class="card-img-top"
                                alt="story image"
                            />
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">
                                    by <span class="author">Peter Tarka</span>
                                </p>
                                <hr />
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <a class="like" href="#">
                                        <i class="fas fa-thumbs-up mr-2"></i>
                                        <small class="mr-3">627</small>
                                    </a>
                                    <a class="dislike" href="#">
                                        <i class="fas fa-thumbs-down mr-2"></i>
                                        <small>3255</small>
                                    </a>
                                </div>
                                <div class="bookmark">
                                    <a href="#">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card story_card mt-4">
                            <img
                                src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg"
                                class="card-img-top"
                                alt="story image"
                            />
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">
                                    by <span class="author">Peter Tarka</span>
                                </p>
                                <hr />
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <a class="like" href="#">
                                        <i class="fas fa-thumbs-up mr-2"></i>
                                        <small class="mr-3">627</small>
                                    </a>
                                    <a class="dislike" href="#">
                                        <i class="fas fa-thumbs-down mr-2"></i>
                                        <small>3255</small>
                                    </a>
                                </div>
                                <div class="bookmark">
                                    <a href="#">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card story_card mt-4">
                            <img
                                src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg"
                                class="card-img-top"
                                alt="story image"
                            />
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">
                                    by <span class="author">Peter Tarka</span>
                                </p>
                                <hr />
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <a class="like" href="#">
                                        <i class="fas fa-thumbs-up mr-2"></i>
                                        <small class="mr-3">627</small>
                                    </a>
                                    <a class="dislike" href="#">
                                        <i class="fas fa-thumbs-down mr-2"></i>
                                        <small>3255</small>
                                    </a>
                                </div>
                                <div class="bookmark">
                                    <a href="#">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stories List [End] -->
    </div>
</div>
<!--End pagewrapper-->

<?php include 'partials/footer.php'; ?>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="tjs/script.js"></script>
<script src="./favourites_page/favourites.js"></script>

</body>
</html>