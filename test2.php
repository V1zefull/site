<?php
$S = "red green blue" ;
$e = explode (' ',$S) ;
//print_r ($e) ;
$b = count($e) ;
for ($i=0 ; $i<$b ; $i++ ) {
	echo ($i + 1) ;
	echo $e[$i].'<br>' ;
}
?>