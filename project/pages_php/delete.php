<?php

include('Post.php');

$postId = $_GET['post_id'];
        
$post = new Post();        
$post->deletePost($postId);
header('Location: user.php');


?>