<?php

session_start();

$arg = explode('/', $_SERVER['QUERY_STRING']);
$page = $arg[0] == null ? "default" : $arg[0];

if (!isset($_SESSION['id']) and $page != "register")
	$page = 'login';

$inc_file = 'page/' . $page . '.php';

if (file_exists($inc_file))
	include_once $inc_file;
else
	include_once 'page/default.php';

?>