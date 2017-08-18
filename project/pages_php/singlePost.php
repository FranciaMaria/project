<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../css/blog.css" />
</head>
<body>
	<header>
		<p>Vivify<strong>blog</strong></p>
		<nav>
			<a href="home.php">HOME</a>
			<a href="about.php">ABOUT</a>
			<a href="contact.php">CONTACT</a>
			<a href="user.php">ADMIN</a>
			<a href="logout.php">LOGOUT</a>
		</nav>
	</header>
	<main>

	  <?php 
	  		session_start();

	  		//include("db.php");
	  		//include("blogic.php");
	  		include("Post.php");
	  		getConnection();


	  		$userComment = new Post();

	  		$isUserLogin = $userComment->isUserLoggedIn();


	  		//var_dump($_SESSION['current_user']['id']);

	  		//$sessionUserId = $_SESSION['current_user']['id'];


	  		if (isset($_GET['post_id']))  {

                $postId = $_GET['post_id'];
	  			
	  			$posts = fetchUserById($postId); 

	  			$comments = fetchCommentsByPostId($postId);

	  			$sessionUserId = $_SESSION['current_user']['id'];


	  			foreach($posts as $post) { 

	  				$userId = $post['created_by']; 

	  				$postID = $post['id'];

	  				 ?>

	  				

		<div class="content">
			<h2><a href="singlePost.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h2>
			<h4><?php echo($post['category']) ?></h4>
			<p><?php echo($post['created_at'] .' by ' .  $post['name']) ?></p>
			<p><?php echo($post['content']) ?></p>
		</div>

		
		<?php //if($userId !== $sessionUserId) { ?>

		<?php 

			if($isUserLogin) { 

			

			$validation = $userComment->validationOfComments($userId, $sessionUserId); ?>

			

		
		<div class="container">
		<?php if($validation) { 


			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$userComment->addNewComment($postID);
			}
			?>			
			<h4>Add new comment</h4>
			<form method="post">
				<div style="padding-top: 0px; padding-bottom: 10px;">
				<label for="content" name="content">Comment content</label><br>
				<textarea type="text" name="content" rows="8" cols="115"></textarea><br>
				<button type="submit" style="background-color: #069; color: white; border-color: #036; border-radius: 6px; padding: 5px 10px;">Add</button>
			</form>
			<?php } }?>
		</div>
		
			

			
			<h2>Comments</h2>
		
			<?php foreach($comments as $comment) { ?>
		
			<div class="content-1">

				<hr>
				<p><?php echo($comment['created_at']." by ".$comment['name'])?></p>
				<p><?php echo($comment['content'])?></p>
				<hr>
				</div>
		
		
		<?php }	//exit();}

		}
			} ?>
	</main>
	<footer>
		<p>Copyright &copy; 2017.</p>
		<nav>
			<a href="home.php">Home</a>
			<a href="about.php">About</a>
			<a href="contact.php">Contact</a>
			<a href="">Admin</a>
			<a href="logout.php">Logout</a>
		</nav>
	</footer>	
</body>
</html>