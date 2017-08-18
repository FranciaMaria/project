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
			<a href="">ADMIN</a>
			<a href="logout.php">LOGOUT</a>
		</nav>
	</header>
	  <main>
	  <?php 
	  		session_start();
	  		include("Post.php");
	  		//getConnection();

	  		$posts = new Post();
	  		$isUserLogin = $posts->isUserLoggedIn();

	  		if($isUserLogin) { 

			$sessionUserId = $_SESSION['current_user']['id'];

			$postByUser = $posts->fetchPostByUser();

			$userId = $postByUser['created_by'];

			$validation = $posts->validationOfComments($userId, $sessionUserId); 

			if($validation) { 

	  		$posts->addNewPost();
	  		$postByUser = $posts->fetchPostByUser();

	  		$allPosts = $posts->allPostByUser();

	  		//var_dump($postByUser);

	  		//var_dump($_SESSION['current_user']['id']); ?>

		<table>
  			<tr>
    			<th>Name</th>
    			<th>Options</th> 
  			</tr>
  			<?php foreach ($allPosts as $post) { ?>
  			<tr>
    			<td><a href="singlePost.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></td>
    			<td><a href="edit.php?post_id=<?php echo($post['id']) ?>"> Edit </a>
    			<a href="delete.php?post_id=<?php echo($post['id']) ?>">Delete</a></td>
  			</tr>
  			<?php

  	// 		if(!checkRequestMethod()) {
   //      		$postId = $_GET['post_id'];
        
   //      		$post = new Post();        
   //      		$post->deletePost($postId);
   //      		header('Location: user.php');
   //      		// var_dump($post);    }
			// } else {
   //  		header('Location: user.php');
			// }

  			} ?>
		</table>
		
		<div class="container">
			<h1>Add new post</h1>
		<form method="post">
			<label for="title" name="title">Post title</label><br>
			<input type="text" name="title"/><br>
			<div style="padding-top: 20px; padding-bottom: 10px;">
				<label for="content" name="content">Post content</label><br>
				<textarea type="text" name="content" rows="8" cols="124"></textarea><br>
			</div>
			<button type = "submit" style="background-color: #069; color: white; border-color: #036; border-radius: 6px; padding: 5px 10px;">Save</button>
		</form>
		</div>
		<?php } }?>
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