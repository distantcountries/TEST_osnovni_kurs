<?php
    include("db.php");

    $id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];

    $sqlDelete = "DELETE FROM comments WHERE id = $id;";
    $statementDelete = $connection->prepare($sqlDelete);
    $statementDelete->execute();

    header("Location: http://localhost:8080/single-post.php?post_id=$post_id");
?>



