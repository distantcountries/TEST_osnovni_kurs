<!-- button for hidding comments -->
<input id="mybutton" type="button" class="btn btn-default" onclick="hideShowComments(), changeButtonText()" value="Hide comments"></input>

<!-- /.comments -->
	<div class="comments" id="comments">
	<h5>COMMENTS:</h5>

	<?php
		$sqlComments =
			"SELECT comments.id, comments.author, comments.text FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.post_id = {$_GET['post_id']}";

		$statement = $connection->prepare($sqlComments);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$comments = $statement->fetchAll();
	?>

	<?php
		echo '<ul>';
		foreach ($comments as $comment) {
	?>



		<!-- delete comment button -->
		<form name="deleteCommentForm" class="delete_button "method="post" action="delete-comment.php">
			<input type="hidden" value="<?php echo $_GET['post_id']; ?>" name="post_id"/>
			<input type="hidden" value="<?php echo $comment['id']; ?>" name="comment_id"/>
			<input type="submit" name="button" value="X" class="btn btn-light js-comment-delete-button"></input>
	    </form>

		<script>
			// document.getElementById('submitDelete').addEventListener("click", function(event){
			// 	event.preventDefault();
			// 	if (window.confirm("Do you really want to delete this post?")) { 
			// 		document.deleteCommentForm.submit();
			// 	}
			// });
		</script>



		<?php
			echo '<li>' . '<strong>' . $comment['author'] . '</strong>' . ': ' . $comment['text'] . '</li>';   
			echo '<hr>';
		}
			echo '</ul>';    
	?>
</div><!-- /.comments -->


<script>

function hideShowComments() {
	var x = document.getElementById("comments");
	if (x.style.display === "none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}

function changeButtonText() {
	var elem = document.getElementById("mybutton");
	if (elem.value=="Hide comments") elem.value = "Show comments";
	else elem.value = "Hide comments";
}
	
</script>