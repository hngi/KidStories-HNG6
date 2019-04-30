<?php include 'partials/header.php'; ?>

<link rel="stylesheet" type="text/css" href="categories/css/grid.css">

<body>
<div class="page-wrapper">
    
    <!-- Main Navigation-->
        <?php include 'partials/navbar.php'; ?>
    <!--End Main Navigation -->


    <div class="content">
        <!-- Showcase -->
        <section class="top-container">
                    <header class="showcase">
                        <h1 class="text-white"> Categories </h1>
                    </header>
        </section>

            <!-- Navigation --> 
            <nav class="min-nav">
                <ul>
                    <li><a href="#"> Home </a></li>
                    <i class="fa fa-chevron-right"></i>
                    <li><a class="current" href="#"> Categories </a></li>
                </ul>
            </nav>   

            <!-- Story Categories -->
            <span >
                <h1 class="container1 span"> All Story Categories </h1>
            </span>    

            <div class="wrapper">     
                <div class="item"><a href="#"> <img class="category" src="categories/img/Myth.jpg"> <div class="info"> Myths </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/fairytales.JPG"> <div class="info"> Fairytales </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/animals.jpeg"> <div class="info"> Animals </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/fearful2.png"> <div class="info"> Fearful </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/fables.jpeg"> <div class="info"> Fables </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/history.png"> <div class="info"> History </div> </a></div>         
            </div>

            <!-- Poem Categories-->
            <span >
                    <h1 class="container1 span"> Poems </h1>
            </span>    
            
            <div class="wrapper">     
                <div class="item"><a href="#"> <img class="category" src="categories/img/Myth.jpg"> <div class="info"> Animal Poem </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/fairytales.JPG"> <div class="info"> Adventure </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/animals.jpeg"> <div class="info"> Lullaby </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/fearful2.png"> <div class="info"> Fearful </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/fables.jpeg"> <div class="info"> Fables </div> </a></div>
                <div class="item"><a href="#"> <img class="category" src="categories/img/history.png"> <div class="info"> History </div> </a></div>         
            </div>    
    </div>
</div>

<!-- Footer goes here -->
<?php include 'partials/footer.php'; ?>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>


<script src="tjs/paroller.js"></script>
<script src="tjs/script.js"></script>

</body>
</html>