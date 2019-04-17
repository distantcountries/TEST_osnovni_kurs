<?php
	include 'db.php';

	$id = $_POST['id'];
    if(!empty($_POST['author']) && !empty($_POST['comment'])){
    	$author = $_POST['author'];
    	$comment = $_POST['comment'];

    	$sql = "INSERT INTO comments (author, text, post_id) VALUES ('$_POST[author]', '$_POST[comment]', $_POST[id]);";

    	$statement = $connection->prepare($sql);
		$statement->execute();

		header("Location: http://localhost:8080/single-post.php?post_id=$id");
	} else {
		header("Location: http://localhost:8080/single-post.php?post_id=$id&error=required");
	}

?>