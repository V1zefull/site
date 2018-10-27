<?php

session_start();
if (!isset($_SESSION['id']))
{
	die('{"result": "noauth"}');
}

$db = new mysqli('localhost', 'root', '', 'db2');
$db->set_charset('UTF-8');
$uid = $_SESSION['id'];
$res = $db->query("select did from participants where uid = $uid") or die($db->error);
$L = array();
$res = $res->fetch_all(MYSQLI_ASSOC);
foreach ($res as $v) $L[count($L)] = $v['did'];
$lst = implode(', ', $L);
$r = $db->query("select * from dialogs where id in ($lst)") or die($db->error);
$r = $r->fetch_all(MYSQLI_ASSOC);

echo json_encode($r);

?>