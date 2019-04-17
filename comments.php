
<!-- button for hidding comments -->
	<input id="mybutton" type="button" class="btn btn-default" onclick="hideShowComments(), changeButtonText()" value="Hide comments"></input>

	<!-- /.comments -->
		<div class="comments" id="comments">
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