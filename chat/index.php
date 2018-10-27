<?php
	
?>
<!doctype html>
<html>
	<head>
	</head>
	
	<body>
	<input type="text" id="inp"><br>
	 <textarea id="text"></textarea><br>
	 <button id="btn">send</button><br>
	<?php
	
		$db = new mysqli('localhost', 'root', '', 'dbchat');
		$db->set_charset('UTF8');
		$res = $db->query ('select * from messages');
		$res= $res->fetch_all(MYSQLI_ASSOC);
		//print_r($res);
		count($res);
		for ($i=0; $i<count($res) ; $i++){
			echo '<b>'.$res[$i]['name'].'</b>';
			echo $res[$i]['text'].'<br>';
		};
	?>
	<script src="../js/jquery.min.js">	</script>
	<script>
		$('#btn').click(function() {
			
			var user=$("#inp").val();
			var text=$("#text").val();
			$.post('.',{user:user,text:text});
			
			
			//console.log($("#txt").val());
		});
	</script>
	</body>
</html>
