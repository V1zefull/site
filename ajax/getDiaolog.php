<?php

session_start();

if (!isset($_SESSION['id'])) die('{"result": "auth requierd"}');
if (!isset($_POST['did'])) die('{"result": "dialo id requierd"}');

$id = $_SESSION['id'];
$did = intval ($_POST['did']);

$db = new mysqli('localhost','root','db2');
$res = $db->query("select * from messages where did = $