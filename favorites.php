<?php include 'partials/header.php'; ?>

    <link rel="stylesheet" href="favourites_page/favourites.css">


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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
            <!-- Stories List [Start] -->
            <div class="stories py-5">
                <h6 class="font-weight-bold">Sort by: Date Added</h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card story_card mt-4">
                            <img src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg" class="card-img-top" alt="story image">
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">by <span class="author">Peter Tarka</span></p>
                                <hr>
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <i class="fa fa-thumbs-up mr-2 liked"></i><small class="mr-3">627</small>
                                    <i class="fa fa-thumbs-down mr-2"></i><small>3255</small>
                                </div>
                                <div class="bookmark">
                                    <i class="fa fa-bookmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card story_card mt-4">
                            <img src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg" class="card-img-top" alt="story image">
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">by <span class="author">Peter Tarka</span></p>
                                <hr>
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <i class="fa fa-thumbs-up mr-2 liked"></i><small class="mr-3">627</small>
                                    <i class="fa fa-thumbs-down mr-2"></i><small>3255</small>
                                </div>
                                <div class="bookmark">
                                    <i class="fa fa-bookmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card story_card mt-4">
                            <img src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg" class="card-img-top" alt="story image">
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">by <span class="author">Peter Tarka</span></p>
                                <hr>
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <i class="fa fa-thumbs-up mr-2 liked"></i><small class="mr-3">627</small>
                                    <i class="fa fa-thumbs-down mr-2"></i><small>3255</small>
                                </div>
                                <div class="bookmark">
                                    <i class="fa fa-bookmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card story_card mt-4">
                            <img src="https://res.cloudinary.com/mrphemi/image/upload/v1547072399/sample.jpg" class="card-img-top" alt="story image">
                            <div class="card-body">
                                <h5 class="card-title">Tales of Snow White</h5>
                                <p class="card-text mb-1">by <span class="author">Peter Tarka</span></p>
                                <hr>
                                <p class="card-text">For kids 3-5 years</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="reactions">
                                    <i class="fa fa-thumbs-up mr-2 liked"></i><small class="mr-3">627</small>
                                    <i class="fa fa-thumbs-down mr-2"></i><small>3255</small>
                                </div>
                                <div class="bookmark">
                                    <i class="fa fa-bookmark"></i>
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


<script src="tjs/script.js"></script>

</body>
</html>