<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>

<?php include 'header.php' ?>

<main role="main" class="container">

    <div class="row">       

      	<div class="col-sm-8 blog-main">
      		
      		<!-- /.single-post -->
			    <?php
			    	// if (isset($_GET['post_id'])) {

			        $sql = "SELECT id, title, body, author, created_at FROM posts WHERE posts.id = {$_GET['post_id']}";
			        $statement = $connection->prepare($sql);
			        $statement->execute();
			        $statement->setFetchMode(PDO::FETCH_ASSOC);
			        $singlePost = $statement->fetchAll();
			    ?>

			    <?php
	       			foreach ($singlePost as $post) {
	    		?>

		            <div class="blog-post">
		                <h2 class="blog-post-title"><?php echo($post['title']) ?></h2>
		                <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <a href="#"><?php echo($post['author']) ?></a></p>

		                <p><?php echo($post['body']) ?></p>
		            </div><!-- /.blog-post -->

	    		<?php
	        		}
	    		?>

	    	<!-- /.comments -->
				<div class="comments">
				    <h5>COMMENTS:</h5>

				    <?php
				        $sqlComments =
				            "SELECT comments.author, comments.text FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.post_id = {$_GET['post_id']}";

				        $statement = $connection->prepare($sqlComments);
				        $statement->execute();
				        $statement->setFetchMode(PDO::FETCH_ASSOC);
				        $comments = $statement->fetchAll();
				    ?>

				    <?php
					    echo '<ul>';
					       	foreach ($comments as $comment) {
	                       		echo '<li>' . '<strong>' . $comment['author'] . '</strong>' . ': ' . $comment['text'] . '</li>';                     		
	               				echo '<hr>';
	                        }
	                    echo '</ul>';    
				    ?>
				            
				</div><!-- /.comments -->
		        
		</div><!-- /.blog-main -->

        <?php include 'sidebar.php' ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include 'footer.php' ?>
</body>
</html>