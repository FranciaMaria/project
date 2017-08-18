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

		<?php
	
			session_start();

			include("Auth.php");

			$errorMessage = '';

			if (isRequestMethodPost()) {

			//getConnection();
				$user_id = fetchUserByEmailPass($_POST['email'], $_POST['password']);

				if (!empty($user_id)) 
				{
					$_SESSION['current_user'] = $user_id;
					redirect('home.php');
				}
				else{
					redirect('register.php');
				}
			}

?>


			<form method="post">
				<label for=email>Email</label><br>
				<input type=email name=email /><br>
			<div class="label-childs">	
				<label for=password>Password</label><br>
				<input type=password name=password /><br>
			</div>
			<div class="buttons">
				<button type = "submit" style="background-color: #069; color: white; border-color: #036; border-radius: 6px; padding: 8px 13px;">Sign in</button>
				<a href="" style="color: #333;">Sign up</a>
			</div>
			</form>
	</main>
	<footer>
		<p>Copyright &copy; 2017.</p>
		<nav>
			<a href="home.php">Home</a>
			<a href="about.php">About</a>
			<a href="contact.php">Contact</a>
			<a href="user.php">Admin</a>
		</nav>
	</footer>	
</body>
</html>

