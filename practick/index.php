<!doctype html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="/practick/style.css">
	</head>
	<body>
		<!--<h1> Hello </h1>
		<h2> world </h2>
		<div class="text"> some text </div>
		<img class="img-1" src="/practick/1.jpg">
		<!--<img class="img-2" src="/practick/2.jpg">-- >
		<script src="jquery.min.js"></script>
		<script> 
		var d=0;
		$('img').click(function(){
			var ext_img= ['1.jpg', '2.jpg'];
			//$(this).attr("src","2.jpg");
			if (d==0) {$(this).attr("src",ext_img[1]); d=1;}
			else {$(this).attr("src",ext_img[0]); d=0;}
		});</script>-->
	</body>
</html>
<?php
		
	$d=100000;
	$r= 345;
	if  (sqrt($d) > $r) echo 'yes';
	else echo 'no';
?>