<?php

session_start();

if (!isset($_SESSION['id'])) die('{"result": "auth requierd"}');
if (!isset($_POST['did'])) die('{"result": "dialog id requierd"}');

$id = $_SESSION['id'];
$did = intval($_POST['did']);

$db = new mysqli('localhost', 'root', '', 'db2');
$db->set_charset('UTF8');
$res = $db->query("select * from messages join users on sender_id=users.id where did = $did ");
$res = $res->fetch_all(MYSQLI_ASSOC);

echo json_encode($res);

?>