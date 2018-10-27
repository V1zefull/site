<!doctype html>
<html lang="ru">
 <head>
  <title>Вход</title>
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  <style>
  
   body {
	height: 100vh;
	margin: 0;
	padding: 0;
	background: linear-gradient(45deg, rgba(255, 255, 255, 0.5), rgba(230, 230, 230, 0.5));
   }
  
  </style>
 </head>
 <body>
 
 <div class="container">
  <div class="row justify-content-center">
   <div class="col col-md-6 col-lg-4">
    <div class="card mt-5">
	 <div class="card-header text-center">
	  <h6 id="title">Вход</h6>
	 </div> <!-- card header -->
	 
	 <div class="card-body">
	 
	  <div class="input-group mb-3">
	   <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
	   </div>
	  <input id="inputLogin" type="text" class="form-control" placeholder="Логин" aria-label="Username" aria-describedby="basic-addon1">
	 </div>
	 
	 <div id="msg_p1"></div>
	 
	  <div class="input-group mb-3">
	   <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock-open"></i></span>
	   </div>
	  <input id="inputPassword" type="password" class="form-control" placeholder="Пароль" aria-label="Username" aria-describedby="basic-addon1">
	 </div>
	 
	 <div id="msg_p2"></div>

	 
	 <div class="input-group mb-3" id="confirm">
	   <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock-open"></i></span>
	   </div>
	  <input id="inputPassword2" type="password" class="form-control" placeholder="Подтвердите пароль" aria-label="Username" aria-describedby="basic-addon1">
	 </div>
	 
	<div id="msg_p3"></div>
	
	<div class="row justify-content-around">
	<div>
	<div class="btn-group" role="group" aria-label="Basic example">
	  <button id="bLogin" type="button" class="btn btn-light">Вход</button>
	  <button id="bRegister" type="button" class="btn btn-light">Регистрация</button>
	</div>
	</div>
	
	<div>
	<button id="bSignIn" class="btn btn-light"><i class="fas fa-sign-in-alt"></i></button>
	</div>
	</div>
	 
	  
	 </div> <!-- card body -->
	</div> <!-- card -->
   </div> <!-- col -->
  </div> <!-- row -->
 </div> <!-- container -->
 
 <script src="js/jquery.min.js"></script>
 <!--<script src="js/popper.min.js"></script>-->
 <script src="js/bootstrap.min.js"></script>
 <script>
 
 $(function () {
 
	var is_login = true;
	
	function warn(pos, msg) {
		$(pos).html('<div class="alert alert-warning">' + msg + '</div>').slideDown('slow');
	}
	
	function hide_all_msg() {
		$('#msg_p1').slideUp('slow');
		$('#msg_p2').slideUp('slow');
		$('#msg_p3').slideUp('slow');
	}
	
	hide_all_msg();
 
	$("#confirm").hide();
	$("#bLogin").addClass('active');
	
	$("#bLogin").click(function() {
		hide_all_msg();
		is_login = true;
		$(this).addClass('active');
		$('#bRegister').removeClass('active');
		$("#confirm").slideUp('slow');
		$('#title').text('Вход');
	});
	
	$("#bRegister").click(function() {
		hide_all_msg();
		is_login = false;
		$(this).addClass('active');
		$('#bLogin').removeClass('active');
		$("#confirm").slideDown('slow');
		$('#title').text('Регистрация');
	});
	
	$('#bSignIn').click(function () {

		var login = $('#inputLogin').val().trim();
		var passw = $('#inputPassword').val().trim();
		var passw2 = $('#inputPassword2').val().trim();
		var success = true;
		
		if (login.length == 0) {
			warn('#msg_p1', 'Не указан логин');
		} else $('#msg_p1').slideUp('slow');
		
		if (passw.length == 0) {
			warn('#msg_p2', 'Не указан пароль');
			success = false;
		} else $('#msg_p2').slideUp('slow');
		
		if (passw2.length == 0 && !is_login) {
			warn('#msg_p3', 'Подтвердите пароль');
		} 
		else if (passw != passw2 && !is_login) warn('#msg_p3', 'Пароли не совпадают');
		else $('#msg_p3').slideUp('slow');
		
		if (is_login)
		{
		    if (login.length ==0 || passw.lengt ==0) return;
			$.post("ajax/login.php", {login: login, password: passw},
			function (data) {
				//alert(data);
			data = JSON.parse(data);
			if (data.result == "wrong_pair")
			warn('#msg_p1', 'Непрвильная пара: логин и пароль');
			else if (data.result == "ok")
			{
			hide_all_msg();
			location.reload();
			}
			});
		}
		else
		{
		    if (login.length ==0 || passw.length == 0 || passw != passw2) return;
			$.post("ajax/register.php", {login: login, password: passw},
			function (data) {
				alert(data);
			data = JSON.parse(data);
			if (data.result == "internal_error")
			warn('#msg_p1', 'Внутренняя ошибка сервера');
			else if (data.result == "ok")
			{
			hide_all_msg();
			location.reload();
			}
			});
		}
				
	});
	
 });
 
 </script>
 </body>
</html>