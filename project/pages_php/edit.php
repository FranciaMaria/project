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

		include('Post.php');

		$post = new Post();

		$usersPost = $post->isUserLoggedIn();

		$postId = $_GET['post_id'];
		
		$currentPost = fetchPostById($postId);

    	$array = $post->getPostForEdit($postId);

    	//var_dump($array['updated_at']);

    	//$updateDate = date('Y-m-d H:i:s');

    	//$array['updated_at'] = $updateDate;

    	//var_dump($updateDate);

    	?>
    		<div class="container">
			<h1>Edit post</h1>
			<form method="post">
			<?php /*<label for="datum" name="datum">Update date</label><br>
        		<input type="text" name="datum" value="<?php echo $array['updated_at']; ?>"/><br> */?>
    			<label for="title" name="title">Post title</label><br>
        		<input type="text" name="title" value="<?php echo $array['title']; ?>"/><br>
        	<div style="padding-top: 20px; padding-bottom: 10px;">
        		<label for="content" name="content">Post content</label><br>
        		<textarea type="text" name="content" rows="8" cols="124"><?php echo $array['content']; ?></textarea>
			</div>
			<button type = "submit" style="background-color: #069; color: white; border-color: #036; border-radius: 6px; padding: 5px 10px;">Save</button>
		</form>
		</div>
		<?php $post->updatePost($postId); 
		?>
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