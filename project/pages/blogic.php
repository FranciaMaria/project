<?php
	
	function fetchPostById($id){

		$sql = "SELECT posts.id, posts.title, posts.created_at, posts.content,
        profiles.name FROM posts WHERE id=$id
		INNER JOIN users ON users.id = posts.created_by
		INNER JOIN profiles ON users.id = profiles.user_id";

		return $sql;
	}

	function fetchUserById($id){

		$sql = "SELECT users.id, users.email, users.password, profiles.name FROM users WHERE id=$id
		INNER JOIN profiles ON users.id = profiles.user_id";

		return $sql;

	}

/*
	function fetchFromTableById($table, $id){

		$sql = "SELECT * FROM $table WHERE id=$id";

		return $sql;

	}
*/

	function fetchSingleQueryResult($id){

	$sql = "SELECT posts.id, posts.title, posts.created_at, posts.content,
    profiles.name FROM posts WHERE id=$id
	INNER JOIN users ON users.id = posts.created_by
	INNER JOIN profiles ON users.id = profiles.user_id";

	$statement = $connection->prepare($sql);
	$statement->execute();
	$statement->setFetchMode(PDO::FETCH_ASSOC);
	$post = $statement->fetch();

	return $post;


	}

	function fetchAllQueryResults($sql){


		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $statement->fetchAll();

		return $posts;
	}

	function getPreparedStatement($sql){

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $statement->fetchAll();

		return $posts;
	}

	function fetchUserWhoPosted($post) {

		$postUser = $post['created_by'];

		$sql = "SELECT name FROM profiles WHERE user_id = $postUser";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$user = $statement->fetch();

		return $user;

		fetchRelatedRow($profiles, $postUser);

	}

	function fetchCommentsOnPost($post){

		$postId = $post['id'];

		$sql = "SELECT * FROM comments WHERE post_id = $postId";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$comments = $statement->fetchAll();

		return $comments;
	}

	function fetchPostsByUser($user) {

		$userId = $user['id'];

		$sql = "SELECT * FROM posts WHERE created_by = $userId";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $statement->fetchAll();

		return $posts; 

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