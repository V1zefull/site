<?php

//if (!isset($_POST['text'])) exit(0);
echo 'ok';
$db = new mysqli('localhost', 'root', '', 'db2');
$db->set_charset('UTF-8');

$text = htmlspecialchars(trim($_POST['text']));

$db->query("insert into Messages (text) values ('$text')") or die($db->error);