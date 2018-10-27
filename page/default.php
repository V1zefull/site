<!doctype html>
<html lang="ru">
 <head>
  <title>Dialogs</title>
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  </head>
<body>

<style>

.dialog {
	cursor: pointer;
	transition: all 0.2s;
}

.dialog:hover {
	filter: hue-rotate(45deg);
}

.msg_inc
{
	margin-right: 30%;
}

.msg_out
{
	margin-left: 30%;
	text-align: right;
}

.avatar {
	width: 32px;
	height: 32px;
}

.c-ptr{
	cursor: pointer;
}

</style>

<input id="fileDialog" type="file" name="file" class="d-none">

<div id="userId" data-val="<?php echo $_SESSION['id']; ?>"></div>
<div class="container">
<div class="row">
<div class="col">
<!------------- NAVBAR -------------->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Dialogs</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a id="aLogout" class="nav-item nav-link" href="#">Logout</a>
    </div>
  </div>
</nav>
<!------------- END NAVBAR -------------->
<div id="dialog">
<div class="container">

<div class="row bg-light border-top border-primary p-3">
 <div id="msgContainer" class="col">
  
 </div>
</div>

<div class="container fixed-bottom msgBar">
 <div class="row">
 <div class="col">
	
		 <div class="input-group input-group-lg my-3" id="confirm">
		 <button id="btnAttach" class="btn btn-light"><i class="fas fa-paperclip"></i></button>
		 	  <input id="inputMessage" type="text" class="form-control" placeholder="Message...">
	   <div class="input-group-append">
	    <button class="input-group-text" id="bSend"><i class="fas fa-paper-plane"></i></button>
	   </div>
	 </div>
	
 </div>
</div>

<div class="row"><div id="fileView" class="col m-3">

</div></div>

</div>


</div><!--container-->
</div><!-- dialog -->

<div id="dialogList">
 <div class="container border-top border-warning">
  <div class="row">
   <div class="col">
    <div id="dialogsContainer">
	</div>
   </div>
  </div>
</div><!-- dialog list -->

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

$( function () { 
	
	var dialog_id;
	var user_id = $('#userId').attr('data-val');
	
	function messageView(data)
	{
		var d = '';
		if (data.sender_id == user_id)
		{
			d += '<div class="msg_out alert alert-warning mt-3">'+
			'<b>' + data.sender_name + "</b>: " +
			data.text
			+ '<img class="avatar ml-3" src="'
			+ data.avatar +'">'
			+'</div>';
		}
		else
		{
			d += '<div class="msg_inc alert alert-primary mt-3">' + '<img class="avatar mr-3" src="' + data. avatar + '">'+						
			'<b>' + data.sender_name + "</b>: " +
			data.text
			+'</div>';
		}
		
		$('#msgContainer').html(d);
	}
	
	$.get('ajax/dialogList.php', function (data) { 
		//$('#dialogsContainer').html(data);
		var content = "";
		data = JSON.parse(data);
		for (var i = 0; i < data.length; i++)
		{
			content += '<div did="'+data[i].id+'" class="alert alert-primary dialog mt-3">' + data[i].title +
			"</div>" + "<hr>";
		}
		$('#dialogsContainer').html(content);
		
		$('.dialog').click(function () {
			$('#dialogList').slideUp(500);
			$('#dialog').slideDown(500);
			var did = $(this).attr('did');
			dialog_id = did;
			//alert(did);
			//;
			$.post('ajax/getDialog.php', {did: dialog_id}, function (data) {
				// -- -- --
				// sender_id, sender_name, text, avatar
				data = JSON.parse(data);
				var d = '';
				for (var i = 0; i < data.length; i++)
				{
					if (data[i].sender_id == user_id)
					{
						d += '<div class="msg_out alert alert-warning mt-3">'+
						'<b>' + data[i].sender_name + "</b>: " +
						data[i].text
						+ '<img class="avatar ml-3" src="'
						+ data[i].avatar +'">'
						+'</div>';
					}
					else
					{
						d += '<div class="msg_inc alert alert-primary mt-3">' + '<img class="avatar mr-3" src="' + data[i]. avatar + '">'+						
						'<b>' + data[i].sender_name + "</b>: " +
						data[i].text
						+'</div>';
					}
				}
				
				$('#msgContainer').html(d);
				// -- -- -- --
			});
		});
		
		
	});
	
	$('#dialog').hide();

	$('#bSend').click( function () {
		var msg = $('#inputMessage').val().trim();
		if (msg.length == 0) return;
		var did = 1;
		$.post('ajax/send_message.php', {did: did, text:msg}, function (data) { if (data != 'ok')console.log(data)});
		data = {sender_id: user_id, sender_name: 'User', text:msg, avatar:'avatars/deffault.png'};
		var ht = messageView(data);
		$('#msgContainer').append(ht);
	});

	$('#aLogout').click(
		function () { 
			$.get('ajax/logout.php', function (data) {
				console.log(data);
				data = JSON.parse(data);
				if (data.result == "ok") {
					window.location = "/";
				}
				
			});
		}
	);
	
	var fileList =[];
	
	function updateFiles(){
		var v = $('#fileView'); 
		// v.html(''); 
		var c='';
		for (var i = 0; i <fileList.length; i++) {
			var ext_img= ['png', 'jpg', 'bmp', 'gif'];
			var ext_are= ['zip', 'rar', 'tar', 'jar'];
			var ext_doc= ['pdf', 'docx', 'txt'];
			var ext = fileList[i].name .split('.')[1];
			c += '<span class="alert alert-warning m-0 p-1">';
			c +=fileList[i].name;
			c +='<i data-idx="'+ i +'"';
			c +=' class="c-ptr ml-5 fas fa-times"></i>';
			c +='</span>';
		}
		v.html(c);

		$('.c-ptr').click(
			function() {
				var idx = $(this).attr('data-idx');
				fileList.splice(idx, 1);
				updateFiles();
				}
			);
	}
	
	$('#btnAttach').click(function () { 
		$('#fileDialog').trigger('click'); 
	});
	
	$('#fileDialog').change(function(){
		fileList.push($(this)[0].files[0]); 
		console.log(fileList); 
		updateFiles();
	});
});

</script>
</body>
</html>