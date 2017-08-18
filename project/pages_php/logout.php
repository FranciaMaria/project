<?php

session_start();

session_unset();

require_once 'Auth.php';
redirect('signIn.php');

?>