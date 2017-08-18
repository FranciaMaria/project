<?php

function getConnection(){
	$servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "MyBlog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

function fetchQueryResults(){

	$sql = "SELECT posts.id, posts.title, posts.created_at, posts.content,
            profiles.name FROM posts WHERE id=1
			INNER JOIN users ON users.id = posts.created_by
			INNER JOIN profiles ON users.id = profiles.user_id";

	$statement = $connection->prepare($sql);
	$statement->execute();
	$statement->setFetchMode(PDO::FETCH_ASSOC);
	$post = $statement->fetch();

	return $post;

}

function fetchFromTableById($table, $id){

	$sql = "SELECT * FROM $table WHERE id=$id";

	return $sql;

}

function fetchRelatedRow($table, $table_id){

		$sql = "SELECT * FROM $table WHERE foreignKeyId = $table_id";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$row = $statement->fetch();

		return $row;
}

function fetchRowsRelatedToRow($table, $id){

		$sql = "SELECT * FROM $table WHERE table_id = $id";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $statement->fetchAll();

		return $rows;
}

function fetchAllFromTable($table){

		$sql ="SELECT * FROM $table";

		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$all = $statement->fetch();

		return $all;
}

function fetchAllPosts(){

		$allPosts = fetchAllFromTable('posts');
		return $allPosts;
}


?>