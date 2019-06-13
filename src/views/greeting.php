<section class="jumbotron-container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $_SESSION['username'] ?>'s journal</h1>
                <p class="lead">Thank you for using our website for your personal Journal, enter a title and some
                    content to create your next post</p>
                    <a href="logout.php" class="btn btn-lg btn-light">Logout</a>
            </div>
            <hr class="my-4">
            <form method="POST" action="?action=add">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="title-grp">Set Title</span>
                </div>
                <input name="title" type="text" class="form-control" aria-label="Default"
                    aria-describedby="title-grp">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Content</span>
                </div>
                <textarea name="content" class="form-control" aria-label="With textarea"></textarea>
            </div>
            
            <div class="btn-div">
                <input class="btn btn-lg btn-light" id="submit-log" type="submit" value="SUBMIT" />
            </div>
            </form>
            <div class="card-container">


            <script>
                $data.forEach(function(data) {
                   "<div class='card'>" + data + "</div>";
                });


            </script>

                <?php
   
 
    foreach ($data as $posts) {
        ?>
                    <div class="card">
                        <div class="card-body">
                            
                            <h2><?= $posts['title'] ?></h2>
                            <p><?= $posts['content'] ?></p>
                            <p><?= $posts['createdAt'] ?></p>
                        </div>
                        
                    </div>
                    <?php
                    }
                    ?>
                    </div>

</section>