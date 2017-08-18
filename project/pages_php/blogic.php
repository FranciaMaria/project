<?php
	
	function fetchPostById($id){

		$sql = "SELECT posts.id, posts.title, posts.category, posts.created_at, posts.content,
                       posts.category, posts.updated_at,
        				profiles.name, comments.id, comments.content, 
                    	comments.created_at, comments.author FROM posts
                       INNER JOIN users ON users.id = posts.created_by
                       INNER JOIN profiles ON users.id = profiles.user_id
                       INNER JOIN comments ON comments.post_id = posts.id
					   WHERE posts.id={$id}";

		return fetchSingleQueryResult($sql);
	}


	function fetchUserById($id){

		$sql = "SELECT posts.id, posts.title, posts.created_by, posts.created_at, posts.content, posts.category,
        profiles.name FROM posts
		INNER JOIN users ON users.id = posts.created_by 
		INNER JOIN profiles ON users.id = profiles.user_id 
		WHERE posts.id={$id}";

		$connection = getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$user = $statement->fetchAll();

		return $user;

	}

/*
	function fetchFromTableById($table, $id){

		$sql = "SELECT * FROM $table WHERE id=$id";

		return $sql;

	}
*/


	function fetchUserWhoPosted($post) {


		$sql = "SELECT posts.created_by FROM posts WHERE posts.title = {$post}";

		$connection = getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$user = $statement->fetch();

		$user1 = fetchRelatedRow($user);

		return $user1;

	}

	function fetchCommentsByPostId($id){

		$sql = "SELECT comments.id, comments.content, 
                comments.created_at, comments.author, comments.post_id,
                profiles.name FROM comments
                INNER JOIN posts ON  posts.id = comments.author
                INNER JOIN users ON users.id = posts.id  
                INNER JOIN profiles ON profiles.user_id = users.id
				WHERE comments.post_id = '{$id}'
				ORDER BY comments.created_at DESC";

		$connection = getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$result = $statement->fetchAll();

		return $result; 

	}

	function fetchUserByEmailPass($email, $password) {

		$sql = "SELECT users.id FROM users
				WHERE users.email = '$email' AND users.password = '$password'";

		$connection = getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$result = $statement->fetch();

		return $result; 
	}

/*

	function fetchRowsRelatedToRow($table, $id){

		$sql = "SELECT * FROM $table WHERE table_id = $id";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $statement->fetchAll();

		return $rows;
	}
*/

	/*

	function fetchRelatedRow($table, $table_id){

		$sql = "SELECT * FROM $table WHERE foreignKeyId = $table_id";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$row = $statement->fetch();

		return $row;
	}
	*/



?>