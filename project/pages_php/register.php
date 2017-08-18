<?php

include('Auth.php');

if (isRequestMethodPost()) {

	$auth = new Auth();
	$auth->register();
}

?>

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
			<a href="signIn.php">SIGN IN</a>
		</nav>
	</header>
	<main>
			<form method="post">
			<div class="label-childs">	
				<label for=name>Name</label><br>
				<input type=text name=name /><br>
			</div>
			<div class="label-childs">
				<label for=email>Email</label><br>
				<input type=email name=email /><br>
			</div>
			<div class="label-childs">
				<label for=password>Password</label><br>
				<input type=password name=password /><br>
			</div>
			<div class="buttons">
				<button type = "submit" style="background-color: #069; color: white; border-color: #036; border-radius: 6px; padding: 8px 13px;">Sign in</button>
			</div>
			</form>
	</main>
	<footer>
		<p>Copyright &copy; 2017.</p>
		<nav>
			<a href="home.php">Home</a>
			<a href="about.php">About</a>
			<a href="contact.php">Contact</a>
			<a href="">Admin</a>
		</nav>
	</footer>	
</body>
</html>