<?php

function getConnection() {
    
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "MyBlog";    
    //$password = "root";
    //$dbname = "myblog";    

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $error) {
        
        echo $error->getMessage();
    }
    return $connection;
}

function getPreparedStatement($sql) {        
		$connection = getConnection();
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        return $statement;
    }

function fetchAllQueryResults($sql) {
    return getPreparedStatement($sql)->fetchAll();    
}

function fetchSingleQueryResult($sql) {
    	return getPreparedStatement($sql)->fetch();
}

function fetchFromTableById($table, $id) {
        
        $sql ="SELECT * FROM $table WHERE {$table}.id = $id";        
        return getPreparedStatement($sql);
}

function executeQuery($sql) {
    getPreparedStatement($sql);
}



function fetchQueryResults(){

	$sql = "SELECT posts.id, posts.title, posts.created_at, posts.content,
            profiles.name FROM posts 
			INNER JOIN users ON users.id = posts.created_by
			INNER JOIN profiles ON users.id = profiles.user_id
			WHERE id=1";

	$statement = $connection->prepare($sql);
	$statement->execute();
	$statement->setFetchMode(PDO::FETCH_ASSOC);
	$post = $statement->fetch();

	return $post;

}

function fetchRelatedRow($frKey){

		$sql = "SELECT profiles.name FROM posts
		INNER JOIN users ON users.id = posts.created_by
		INNER JOIN profiles ON users.id = profiles.user_id
		WHERE posts.created_by = {$frKey}";

		return fetchSingleQueryResult($sql);
}

function fetchRowsRelatedToRow($table, $id){

		$sql = "SELECT * FROM $table WHERE {$table}_id = {$id}";
		$connection = getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $statement->fetchAll();

		return $rows;
}

function fetchAllFromTable($table){

		$sql ="SELECT * FROM $table";
		$connection = getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$all = $statement->fetchAll();

		return $all;
}

function fetchAllPosts(){

		$allPosts = fetchAllFromTable('posts');
		return $allPosts;
}

function fetchAllUsers(){

		$allPosts = fetchAllFromTable('users');
		return $allPosts;
}


?>