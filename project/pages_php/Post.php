<?php

include('db.php');
include('blogic.php');

function checkRequestMethod($methodName = 'POST') {    
		return $_SERVER['REQUEST_METHOD'] === $methodName;
	}

function redirect($url) {
    header("Location: http://localhost:1234/pages_php/" . ltrim($url, '/'));
    exit();
}


function isRequestMethodPost() {
     return $_SERVER['REQUEST_METHOD'] == 'POST';
 }

function isUser() {
    	$_SESSION['current_user'] = $user;
}



class Post{

	
	function isUserLoggedIn() {

    	if(isset($_SESSION['current_user'])){
    		return $_SESSION['current_user'];
    	}
    	else { ?>
    		<p style="color:red"><strong><?php echo "Korisnik treba da se uloguje ili registruje (pomocu LOGOUT) ako zeli da komentarise postove registrovanih korisnika ili da postavlja postove!"?></strong></p>;
<?php    	}
	}

	function fetchPostByUser(){

		$userId = $_SESSION['current_user']['id'];
		$sql = "SELECT * FROM posts WHERE posts.created_by = 'userId'";

		return fetchSingleQueryResult($sql);

	}

	function addNewPost() {

		if(isRequestMethodPost()){

			//var_dump($_POST);
			//die;

				$title = $_POST['title'];
				$content = $_POST['content'];
				$postUser = $_SESSION['current_user']['id'];

				if(!empty($title) && !empty($content) && !empty($postUser)) {

					$newPost = "INSERT INTO posts (title, content, created_by, category) VALUES ('$title', '$content', '$postUser', 'Plants')";
      				executeQuery($newPost);
      			}
      			else {
      				redirect('login.php');
      			}

		}

		
	}

	function allPostByUser(){

		$postUser = $_SESSION['current_user']['id'];

		$sql = "SELECT * FROM posts WHERE posts.created_by = '$postUser'";

		return fetchAllQueryResults($sql);
	}

	function addNewComment($postUser) {

		if(isRequestMethodPost()){

			$commentUser = $_SESSION['current_user']['id'];

			 if($commentUser !== $postUser){

				$content = $_POST['content'];

				$newComment = "INSERT INTO comments (author, created_at, content, post_id) VALUES ('$commentUser', '2017-12-11', '$content', '$postUser')";


      			executeQuery($newComment);

      			header("Refresh:0");

			}
		}

	}

	function validationOfComments($userId, $sessionUserId) {

		if($userId !== $sessionUserId){
			return true;
		}
		else{
			return false;
		}

	}

	function getPostForEdit($id){

		$sql="SELECT * FROM posts WHERE posts.id = '$id'";

    	$array = fetchSingleQueryResult($sql);

    	return $array;

	}

	function updatePost($postID) {

		if(isRequestMethodPost()){

			//var_dump($_POST);
			//die;

				$title = $_POST['title'];
				$content = $_POST['content'];
				$postUser = $_SESSION['current_user']['id'];
				$updateAt = "2017-08-17";

				if(!empty($title) && !empty($content) && !empty($postUser)) {

					$updatePost = "UPDATE posts SET title = '$title', updated_at = '$updateAt', content = '$content'
					WHERE posts.id = '$postID'";
      				executeQuery($updatePost);
      			}
      			else {
      				echo "Error!";
      			}

		}

	}

	public function deletePost($postId) {   

		executeQuery("DELETE FROM comments WHERE post_id = $postId;");
		executeQuery("DELETE FROM post_tags WHERE post_id = $postId;");
        executeQuery("DELETE FROM posts WHERE id = $postId;");    
    }

  }

?>