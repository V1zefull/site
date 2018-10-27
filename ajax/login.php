<?php

if (!isset($_POST['login']) || !isset($_POST['password']))
     die('{"result": "required"}');
	 
$login = mb_strtolower(trim($_POST['login']));
$passw = trim($_POST['password']);

$db = new mysqli ('localhost', 'root', '', 'db2');
$db->set_charset("UTF-8");

$res = $db->query("select id from Users where login='$login' and password = '$passw'") or die($db->error);
if ($res->num_rows == 0)
    die('{"result": "wrong_pair"}');
$res = $res->fetch_all(MYSQLI_ASSOC);
$res = $res[0];

session_start();

$login = mb_convert_case($login, MB_CASE_TITLE);

$_SESSION['id'] = $res['id'];
$_SESSION['login'] = $login;

echo '{"result": "ok"}';
