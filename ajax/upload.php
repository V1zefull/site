<?php

$s = 'abcdefghijkmnlopqrstuvwxyzABCDEFGHIJKMNLOPQRSTUVWXYZ0123456789-_';
$len = 32;
$name ="";

for ($i = 0; $i < $len; $i++)
	$name .= $s[rand(0, strlen($s)-1)];

echo $name;


?>