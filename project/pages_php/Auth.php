<?php 

include('db.php');
include('blogic.php');

function isRequestMethodPost() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function redirect($url) {
    header("Location: http://localhost:1234/pages_php/" . ltrim($url, '/'));
    exit();
}

function loginUser($user) {
    $_SESSION['current_user'] = $user;
}

$auth = new Auth();

if(isRequestMethodPost()) {
    	
    	$auth->login();
}

class Auth {

	public function login(){

		//getConnection();
		$user_id = fetchUserByEmailPass($_POST['email'], $_POST['password']);

		if (!empty($user_id)) 
		{
			$_SESSION['current_user'] = $user_id;
      return($_SESSION['current_user']);
			redirect('home.php');
    }
    else {
      		redirect('register.php');
        }
	} 

	 public function register(){

	 	//getConnection();
    $name = $_POST['name'];
	 	$email = $_POST['email'];
	 	$password = $_POST['password'];

    if(!empty($name) && !empty($email) && !empty($password)) {

	 	   $sql = "SELECT users.id FROM users
				WHERE users.email = '$email' AND users.password = '$password'";
		
		    $userId = fetchSingleQueryResult($sql);

		    if (!empty($userId)) 
		    {
			   $_SESSION['current_user'] = $userId;
			   redirect('home.php');
        }
        else
        {
    	   $newUser = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    	   executeQuery($newUser);

    	   $sql = "SELECT users.id FROM users WHERE users.email = '$email' AND users.password = '$password'";
    	   $newUserId = fetchSingleQueryResult($sql);
    	   var_dump($newUserId);
    	   $newUI = $newUserId['id'];

    	   $profileNewUser = "INSERT INTO profiles VALUES (null, '{$_POST['name']}', '$newUI')";
    	   executeQuery($profileNewUser);

        redirect('home.php');
      }
    }
    else{
      echo "Error!";
    }
	 
   }
}


?>