<!doctype html>
<html lang="ru">
	<head>
		<title>Breakout</title>
	</head>
	
	<body>
	
		<canvas id="cvs" width="300" height="600" style="border: 1px solid black"></canvas>
		
		<script>
		
			document.addEventListener('DOMContentLoaded', function () {
			//alert();

				var x = 150;
				var y = 300;
				var vx = 1.6;
				var vy = -1.9;

				var px = 150;


				var canv = document.getElementById('cvs');
				var c = canv.getContext('2d');
				function draw(){
					step();
					c.clearRect(0, 0, 300, 600);
					c.fillRect(x-3, y-3, 5, 5);
					c.fillRect(px-50, 550, 100, 10);
					c.fill();

					//window.requestAnimationFrame(draw);
				}

				function step(){
					x += vx;
					y += vy;

					if (y < 0) {y = 0; vy *= -1;}
					if (x < 0) {x = 0; vx *= -1;}
					if (x > 300) {x =300; vx*= -1;}

					if (y + 3 > 550 && x > px- 50 && x < px +50 && y + 3< 560){
						vy *= -1;
						y =550 - 3;
					}


				}

				setInterval(function(){requestAnimationFrame(draw);},16);

				document.addEventListener('keydown', function (e){
					if (e.code == 'ArrowLeft') {px-=5; px = Math.max(50, px);}
					if (e.code == 'ArrowRight') {px+=5; px= Math.min(250, px);}


				});


			});
		
		</script>
	</body>

</html>