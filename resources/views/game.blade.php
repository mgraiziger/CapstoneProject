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
		
		<header>
			<img src="{{URL::asset('images/nHeader.jpg')}}" height="180" width="100%">
		</header>
		
		<div id="body">
		<img src="{{URL::asset('images/bg.png')}}" height="100%" width="100%">

		<!--<div id="side">
			<ul>
			<a href="index.php?page=home_page" class="text">Home Page</a>
			<a href="index.php?page=home_page" class="text">Heroes</a>
			<a href="index.php?page=home_page" class="text">Enemies</a>
			<a href="index.php?page=home_page" class="text">Maps</a>
			</ul>
		</div>-->
			
		<canvas id="canvas" height="500" width="500"></canvas>
		
		<script type="text/javascript">
			var canvas = document.querySelector('#canvas');
			var context = canvas.getContext('2d');

			
			var grass = new Image();
			var water = new Image();
			var dirt = new Image();
			var hero = new Image();
			

			grass.src = '{{URL::asset('images/grass.png')}}';
			water.src = '{{URL::asset('images/water.png')}}';
			dirt.src = '{{URL::asset('images/dirt.png')}}';
			hero.src ='{{URL::asset('images/player.jpg')}}';


			//var xPos = 0;
			//var yPos = 0;

			//0 = grass; 1 = water; 2 = dirt;
			var map = [
			[0,0,0,1,1,0,0,0,0,0],
			[0,0,0,1,0,0,2,2,0,0],
			[0,0,0,1,0,0,0,0,0,0],
			[0,0,0,1,1,1,0,0,0,0],
			[0,0,0,0,0,1,0,0,0,0],
			[0,2,0,0,0,1,1,0,0,0],
			[0,2,0,0,0,0,0,0,0,0],
			[0,0,1,1,0,0,0,0,0,0],
			[0,0,1,1,0,0,0,2,2,0],
			[0,0,0,0,0,0,0,0,0,0]
			];

			var secondMap = [
			[2,1,1,1,1,0,0,0,0,0],
			[2,1,1,1,0,0,2,2,0,0],
			[2,2,2,1,0,0,0,0,0,0],
			[0,0,2,1,1,1,0,0,0,0],
			[0,2,2,0,0,1,0,0,0,0],
			[0,2,0,0,0,1,1,0,0,0],
			[0,2,0,0,0,0,0,0,0,0],
			[0,2,1,1,0,0,2,2,2,2],
			[0,2,1,1,0,0,2,2,2,2],
			[0,2,2,2,2,2,2,0,0,0]
			];

			//1 = hero; 0 = nothing;
			var heroMap = [
				[1,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0]	
			];

			var enemyMap = [
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[2,0,2,0,2,0,2,0,2,0],
			[0,1,0,1,0,1,0,1,0,1],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0]
			];

			function renderMap() {
				context.clearRect(0,0,500,500);
				var xPos = 0;
				var yPos = 0;
				//These for loops render the map
				for(let i=0; i<map.length; i++)

				{
					for(let j=0; j<map[i].length; j++){

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
					xPos=0;
					yPos+=50;
				}
				renderHero();
			}
			
			
			function renderHero() {
				//This renders the hero. It is called in the renderMap() function
				var xPos= 0;
				var yPos= 0;
				for(let i=0; i<heroMap.length; i++)
				{
					for(let j=0; j<heroMap[i].length; j++) {
						if(heroMap[i][j] == 1) {
							context.drawImage(hero, xPos, yPos, 50, 50);
						}
						xPos+=50;
					}
					xPos=0;
					yPos+=50;
				}
			}

			function findHero() {
				//loops through each array within the heroMap array and finds the 1 value representing the hero
				//Could be replaced with a 2 value array variable which is incremented appropriately during each movement
				var i = -1;
				do {
					i++;
					var charLocation = heroMap[i].indexOf(1);
				} while(charLocation == -1);
				return [i, charLocation];
			}


			function move(event) {
				var key = event.keyCode;
				//UP
				if (key == 38) {
					//First, find the hero on the map/array. findHero() returns a 2 value array where the first value is the players x coordinate, and the second value is the y coordinate
					var loc = findHero();

					//Next, make sure he isn't trying to leave the array (would cause an error), or trying to walk on water
					//IMPORTANT: The if statement checks the map[] array for water, not the heroMap[] array
					if (loc[0] > 0 && map[loc[0]-1][loc[1]] != 1) {

						//if loc = [1,1], the player is attempting to move to [0,1]

						//This sets the value of the array index 'above' (in this case) the player's current position to be the player
						heroMap[loc[0]-1][loc[1]] = 1;

						//This changes the space the player was on into a 0
						heroMap[loc[0]][loc[1]] = 0;

						//Finally, we redraw the map
						//TODO: Fix the player creating grass bug, modularize this function if possible
						renderMap();
					}
				}
				//DOWN
				if (key == 40) {
					var loc = findHero();
					if (loc[0] < 9 && map[loc[0]+1][loc[1]] != 1) {
						heroMap[loc[0]+1][loc[1]] = 1;
						heroMap[loc[0]][loc[1]] = 0;
						renderMap();
					}
				}
				//LEFT
				if (key == 37) {
					var loc = findHero();
					if (loc[1] > 0 && map[loc[0]][loc[1]-1] != 1) {
						heroMap[loc[0]][loc[1]-1] = 1;
						heroMap[loc[0]][loc[1]] = 0;
						renderMap();
					}
				}
				//RIGHT
				if (key == 39) {
					var loc = findHero();
					if (loc[1] < 9 && map[loc[0]][loc[1]+1] != 1) {
						heroMap[loc[0]][loc[1]+1] = 1;
						heroMap[loc[0]][loc[1]] = 0;
						renderMap();
					}
				}
			}

				/*var characterId = document.getElementById('character')

				var character = {

					updown: function() {
						var y = parseInt(getComputedStyle(characterId).top);
						//UP
						if (key == 38 && y >200) {
							y-= 50;

							//creates random number for up arrow
							var ran = Math.floor((Math.random() * 10) + 1);
							switch(ran){
								case 1: case 2: case 3: case 4: case 5: case 6: case 7: 
								break;
								case 8: case 9: case 10:
								context.clearRect(0,0,canvas.width, canvas.height);
								
								var tmpcanvas = document.querySelector('#canvas');
								var tmpcontext = tmpcanvas.getContext('2d');
								
						//not drawing new images 
						dirt.onload = function() {
							for(var l=0; l<enemyMap.length; l++)
							{
								for(var k=0; k<enemyMap[l].length; k++){

								if(enemyMap[l][k] == 0) {
									context.drawImage(grass, xPos, yPos, 50, 50);
									}
					
								if(enemyMap[l][k] == 1) {
									context.drawImage(water, xPos, yPos, 50, 50);
									}

								if(enemyMap[l][k] == 2) {
									context.drawImage(dirt, xPos, yPos, 50, 50);
									}

								xPos+=50;
	
								}
								xPos =0;
								yPos+=50;
							}
						}
							break;
							default:

							}

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
				};*/


			/*function sleep(ms) {
				return new Promise(resolve => setTimeout(resolve, ms));
			}

			async function demo() {
				
				await sleep(2000);
				
			}*/

			dirt.onload = function() {
				renderMap();
			}

			//Keeps window from scrolling when arrow keys or space bar are pressed
			document.addEventListener('keydown', function(e) {
				if ([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
					e.preventDefault();
				}
			}, false);

			document.addEventListener('keydown', move);
	
		</script>

		<!--<script src='{{URL::asset('js/game.js')}}'></script>-->
		<footer id="foot">
		<strong id="strong"> &#169; Copyright 2017</strong>
			<p id="enjoy">ENJOY THE GAME!!!</p>
		</footer>
		</div>
		</script>
	<body>
</html>
