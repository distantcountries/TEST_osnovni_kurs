<div class="col-sm-8 blog-main">
    <?php
        $sql = "SELECT id, title, body, author, created_at FROM posts ORDER BY created_at DESC";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $posts = $statement->fetchAll();
    ?>

    <?php
        foreach ($posts as $post) {
    ?>
        <div class="blog-post">
            <a href="single-post.php?post_id=<?php echo($post['id']) ?>"><h2 class="blog-post-title"><?php echo($post['title']) ?></h2></a>
            <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <a href="#"><?php echo($post['author']) ?></a></p>

            <p><?php echo($post['body']) ?></p>
        </div><!-- /.blog-post -->

    <?php
        }
    ?>

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>

</div><!-- /.blog-main -->