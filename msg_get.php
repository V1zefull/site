<?php

$f = $_GET['f'];
$db = new mysqli('localhost', 'root', '', 'db2');
$db->set_charset('UTF-8');
$r=$db->query("select * from Messages where id > $f order by ts") or die($db->error);
echo json_encode($r->fetch_all(MYSQLI_ASSOC));

?>