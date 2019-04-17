
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




	    		<!-- Form validation-->
				<?php
		            
		            $authorErr = $bodyErr = $titleErr = $created_atErr = "";
		            $author = $body = $title = $created_at = "";

		            if ($_SERVER["REQUEST_METHOD"] == "POST") {

		            	if (empty($_POST["author"])) {
		                    $authorErr = "Name is required";
		                } else {
		                    $author = test_input($_POST["author"]);
		                }

		                if (empty($_POST["title"])) {
		                    $titleErr = "Title is required";
		                } else {
		                    $title = test_input($_POST["title"]);
		                }

		                if (empty($_POST["body"])) {
		                    $bodyErr = "Post text is required";
		                } else {
		                    $body = test_input($_POST["body"]);
		                }

		                if (empty($_POST["created_at"])) {
		                    $created_atErr = "Date is required";
		                } else {
		                    $created_at = test_input($_POST["created_at"]);
		                }


		            }

		            function test_input($data) {
		                $data = trim($data);
		                $data = stripslashes($data);
		                $data = htmlspecialchars($data);
		                return $data;
		            }
		        ?>




				<!-- Write new body-->
				<div class="new_post_form" >
					<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--action="posts.php"  -->

						<span class="error"><?php echo $authorErr;?></span>
						<input name="author" type="text" placeholder="Your name..." id="new_body_user" value="<?php echo $author;?>"/> 

						<span class="error"><?php echo $titleErr;?></span>
						<input name="title" type="text" placeholder="Your post title..." id="new_body_user" value="<?php echo $title;?>"/> 

						<span class="error"><?php echo $bodyErr;?></span>
						<textarea name="body" rows="4" cols="50" placeholder="Your post text..."><?php echo $body;?></textarea> 

						<span class="error"><?php echo $bodyErr;?></span>
						<input type="date" name="created_at" id="new_body_user">


						<input type="hidden" value="$_GET['post_id']" name="id"/>

						<input type="submit" name="submit" value="Submit" class="btn btn-default"></input>
					</form>
				</div> <!-- /.Write new body-->





</main><!-- /.container -->

<?php include 'footer.php' ?>
</body>
</html>