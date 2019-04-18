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

    <style>
        .error {color: #FF0000;}
    </style>
</head>

<body>

<?php include 'header.php' ?>

<main role="main" class="container">

    <div class="row">       

      	<div class="col-sm-8 blog-main">

      		
      		<!-- /.single-post -->
			    <?php
			        $sql = "SELECT id, title, body, author, created_at FROM posts WHERE posts.id = {$_GET['post_id']}";
			        $statement = $connection->prepare($sql);
			        $statement->execute();
			        $statement->setFetchMode(PDO::FETCH_ASSOC);
			        $singlePost = $statement->fetchAll();
			    ?>


			    <?php
	       			foreach ($singlePost as $post) {
	    		?>


	    		<!-- delete post button -->
	      		<form name="deletePostForm" class="delete_button "method="post" action="delete-post.php">
				  <input type="hidden" value="<?php echo $_GET['post_id']; ?>" name="id"/>
				  <input id="submitDelete" type="button" name="button" value="Delete this post" class="btn btn-primary"></input>
	      		</form>

				<script>
					document.getElementById('submitDelete').addEventListener("click", function(event){
						event.preventDefault();
						if (window.confirm("Do you really want to delete this post?")) { 
							document.deletePostForm.submit();
						}
					});
				</script>



		            <div class="blog-post">
		                <h2 class="blog-post-title"><?php echo($post['title']) ?></h2>
		                <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <a href="#"><?php echo($post['author']) ?></a></p>

		                <p><?php echo($post['body']) ?></p>
		            </div><!-- /.blog-post -->

	    		<?php
	        		}
	    		?>


	    		<!-- Form validation-->
				<?php
		            
		            $authorErr = $commentErr = "";
		            $comment = $author = "";

		            if ($_SERVER["REQUEST_METHOD"] == "POST") {

		            	if (empty($_POST["author"])) {
		                    $authorErr = "Name is required";
		                } else {
		                    $author = test_input($_POST["author"]);
		                }

		                if (empty($_POST["comment"])) {
		                    $commentErr = "Comment is required";
		                } else {
		                    $comment = test_input($_POST["comment"]);
		                }
		                }

		            function test_input($data) {
		                $data = trim($data);
		                $data = stripslashes($data);
		                $data = htmlspecialchars($data);
		                return $data;
		            }
		        ?>


				<!-- Write new comment-->
				<?php
					$requiredError = '';
					if ($_SERVER["REQUEST_METHOD"] === 'GET' && !empty($_GET['error']) && $_GET['error'] === 'required') {
						$requiredError = 'All fields required';
					}
				?>
				
				<div class="new_comment_form" >
					
					<form method="post" action="create-comments.php">
						<?php if (!empty($requiredError)) {?>
							<span class="alert alert-danger"><?php echo $requiredError;?></span>
						<?php } ?>
						<input name="author" type="text" placeholder="Your name..." id="new_comment_user" value="<?php echo $author;?>"/> 

						<span class="error"><?php echo $commentErr;?></span>
						<textarea name="comment" rows="4" cols="50" placeholder="Your comment..."><?php echo $comment;?></textarea> 

						<input type="hidden" value="<?php echo $_GET['post_id']; ?>" name="id"/>

						<input type="submit" name="submit" value="Submit" class="btn btn-default"></input>
					</form>
				</div> <!-- /.Write new comment-->

				
				
				<?php include 'comments.php' ?>

		</div><!-- /.blog-main -->

        <?php include 'sidebar.php' ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include 'footer.php' ?>


</body>
</html>