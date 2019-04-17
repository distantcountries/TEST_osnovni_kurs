<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>Latest posts</h4>

        <div class="aside_titles">
            <?php
                $sql = "SELECT id, title FROM posts ORDER BY created_at DESC LIMIT 5";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $posts = $statement->fetchAll();
            ?>

            <?php
                foreach ($posts as $post) {
            ?>

            <div class="aside_links">
                <a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a>
            </div><!-- /.blog-post -->

            <?php
                }
            ?>

        </div><!-- /.blog-main -->
    </div>
</aside><!-- /.blog-sidebar -->

