<?php include 'partials/header.php'; ?>

    <link rel="stylesheet" href="favourites_page/favourites.css">


<body>
<div class="page-wrapper">

    <!-- Main Navigation-->
        <?php include 'partials/navbar.php'; ?>
    <!--End Main Navigation -->
        <!-- Header with BG Image -->
        font-size: 20px;
    margin-left: 15px
    <div class="auto-container">

        <section class="add-story">
            <form action="">
                <div class="top-form">
                    <div class="form-input title-input">
                        <label for="title">Title</label>
                        <input type="text" name="" id="title">
                    </div>
                    <div class="form-input">
                        <label for="cover">Cover Image</label>
                        <input type="file" name="" id="cover">
                    </div>
                    <div class="form-input">
                        <label for="cover">Age Range</label>
                        <input type="number" name="" id="cover">
                    </div>
                    <div class="form-input">
                        <label for="cover">Arthur</label>
                        <input type="text" name="" id="cover">
                    </div>
                    <div class="form-input">
                        <label for="cover">Story Duration</label>
                        <input type="number" name="" id="cover">
                    </div>
                    <div class="form-input">
                        <label for="cover">Category</label>
                        <input type="text" name="" id="cover">
                    </div>
                </div>
                <div class="form-input">
                    <label for="content">Content</label>
                    <textarea placeholder="And the fish happened to grow wings..." name="" id="content" cols="50" rows="10"></textarea>
               </div>
               <div class="buttons">
                   <button class="btn save">Post</button>
               </div>
            </form>
        </section>
    </div>

    
</div>
<!--End pagewrapper-->

<?php include 'partials/footer.php'; ?>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<script src="tjs/script.js"></script>

</body>
</html>