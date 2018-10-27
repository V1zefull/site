<?php

if (!isset($_POST['login']) || !isset($_POST['password']))
     die('{"result": "required"}');
	 
$login = mb_strtolower(trim($_POST['login']));
$passw = trim($_POST['password']);


$db = new mysqli ('localhost', 'root', '', 'db2');
$db->set_charset("UTF-8");

$db->query("insert into Users (login,password) values ('$login','$passw')") or die('{"result": "internal_error"}');
$res = $db->query("select LAST_INSERT_ID()");
if ($res->num_rows == 0)
    die('{"result": "internal_error"}');
$res = $res->fetch_all(MYSQLI_ASSOC)[0];

session_start();
$_SESSION['id'] = $res['LAST_INSERT_ID()'];

echo '{"result": "ok"}';
