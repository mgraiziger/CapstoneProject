<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"
	lang="en">
	<head>
		<meta charset="utf-8">
		<title>Game</title>
									<!--URL::asset navigates to the /public folder -->
		<link rel="stylesheet" type="text/css" href='{{URL::asset('css/game.css')}}'>
	</head>
	<body>
		<div>
			<p> Arrow Keys to move </p>
		</div>
		<canvas id="canvas" height="500" width="500"></canvas>
		<div id="character">Char Here</div>
		
		<script type="text/javascript">
			var canvas = document.querySelector('#canvas');
			var context = canvas.getContext('2d');

			var grass = new Image();
			var water = new Image();
			var dirt = new Image();

			grass.src = '{{URL::asset('images/grass.png')}}';
			water.src = '{{URL::asset('images/water.png')}}';
			dirt.src = '{{URL::asset('images/dirt.png')}}';


			var xPos = 0;
			var yPos = 0;

			var map = [
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,1,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0],
			[0,0,0,1,2,0,0,0,0,0]

			];

			dirt.onload = function() {
				for(var i=0; i<map.length; i++)
				{
					for(var j=0; j<map[i].length; j++){

					if(map[i][j] == 0) {
						context.drawImage(grass, xPos, yPos, 50, 50);
						}
		
					if(map[i][j] == 1) {
						context.drawImage(water, xPos, yPos, 50, 50);
						}

					if(map[i][j] == 2) {
						context.drawImage(dirt, xPos, yPos, 50, 50);
						}

					xPos+=50;
	
	
					}
					xPos =0;
					yPos+=50;
				}
			}

			function move(event) {
				var key = event.keyCode;
				var characterId = document.getElementById('character')

				var character = {

					updown: function() {
						var y = parseInt(getComputedStyle(characterId).top);
						//UP
						if (key == 38 && y >200) {
							y-= 50;
						//DOWN
						} else if (key == 40 && y < 650) {
							y += 50;
						}
						return y;
					},
					leftright: function() {
						var x = parseInt(getComputedStyle(characterId).left);
						//LEFT
						if (key == 37 && x > 200) {
							x-= 50;
						//RIGHT
						} else if (key == 39 && x < 650 ) {
							x+= 50;
						}
						return x;
					} 
				};

				characterId.style.top = (character.updown()) + "px";
				characterId.style.left = (character.leftright()) + "px";
			}
			//Keeps window from scrolling when arrow keys or space bar are pressed
			document.addEventListener('keydown', function(e) {
				if ([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
					e.preventDefault();
				}
			}, false);

			document.addEventListener('keydown', move)
		</script>

		<!--<script src='{{URL::asset('js/game.js')}}'></script>-->
	<body>
</html>
