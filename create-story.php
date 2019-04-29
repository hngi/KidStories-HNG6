<!DOCTYPE html>
<html lang="en">
<?php include 'partials/header.php';?>
<body>
    <div class="container">
        <main class="banner">
            <h1>Add New Story</h1>
        </main>
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
                </div>
                <div class="form-input">
                    <label for="content">Content</label>
                    <textarea placeholder="And the fish happened to grow wings..." name="" id="content" cols="50" rows="10"></textarea>
               </div>
               <div class="buttons">
                   <button class="btn discard">Discard</button>
                   <button class="btn save">Save</button>
               </div>
            </form>
        </section>
    </div>
    <?php include 'partials/footer.php';?>
</body>
</html>