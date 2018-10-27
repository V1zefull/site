<?php

session_start();
if (!isset($_SESSION['id'])) die('{"result":"auth required"}');
if (!isset($_POST['text']) or !isset($_POST['did'])) die('{"result": "data required"}');

$uid = $_SESSION['id'];
$name = $_SESSION['login'];
$text = trim($_POST['text']);
$did = intval($_POST['did']);

$db = new mysqli('localhost', 'root', '', 'db2');
$db->set_charset('UTF8');

$res = $db->query("select count(*) from participants where did = $did and uid = $uid");
$res = $res->fetch_all(MYSQLI_ASSOC)[0];
$count = $res ["count(*)"];

if ($count == 0)
    die ('{"result":"permission denied"}');

$db->query("insert into messages (sender_id, sender_name, did, text) values ($uid,'$name', $did, '$text')") or die($db->error);

echo 'ok';

?>	