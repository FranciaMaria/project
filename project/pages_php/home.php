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
	  		include("db.php");
	  		include("blogic.php");
	  		getConnection();
	  		$posts = fetchAllPosts();

	  	foreach($posts as $post) { 

	  		$users = fetchUserById($post['id']);

	  		foreach($users as $user) {

	  		?>

		<div class="content">
			<h2><a href="singlePost.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h2>
			<h4><?php echo($post['category']) ?></h4>
			<p><?php echo($post['created_at'] .' by ' . $user['name'] ) ?></p>
			<p><?php echo(substr($post['content'], 0, 252)." ...") ?></p>
		</div>

		<nav>
			<div class="navigation-1">
				<p><a href="">Older</a></p>
			</div>
			<div class="navigation-2">
				<p><a href="">Newer</a></p>
			</div>
		</nav>
	  <?php } }?>
	</main>
	<footer>
		<p>Copyright &copy; 2017.</p>
		<nav>
			<a href="home.php">Home</a>
			<a href="about.php">About</a>
			<a href="contact.php">Contact</a>
			<a href="user.php">Admin</a>
			<a href="logout.php">Logout</a>
		</nav>
	</footer>	
</body>
</html>