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

			var hero = new Image();
			var portal = new Image();
			var grass = new Image();
			var water = new Image();
			var dirt = new Image();

			
			hero.src ='{{URL::asset('images/player.png')}}';
			portal.src = '{{URL::asset('images/portal.png')}}';
			grass.src = '{{URL::asset('images/grass.png')}}';
			water.src = '{{URL::asset('images/water.png')}}';
			dirt.src = '{{URL::asset('images/dirt.png')}}';

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
			var map1 = [
			[0,0,0,1,1,0,0,0,0,0],
			[0,0,0,1,0,0,2,2,0,0],
			[0,0,0,1,0,0,0,0,0,0],
			[0,0,0,1,1,1,0,0,0,0],
			[0,0,0,0,0,1,0,0,0,0],
			[0,2,0,0,0,1,1,0,0,0],
			[0,2,0,0,0,0,0,0,0,0],
			[0,0,1,1,0,0,0,0,0,0],
			[0,0,1,1,0,0,0,2,2,0],
			[0,0,0,0,0,0,0,0,0,3]
			];
			var map2 = [
			[2,1,1,1,1,0,0,0,0,0],
			[2,1,1,1,0,0,2,2,0,0],
			[2,2,2,1,0,0,0,0,0,0],
			[0,0,2,1,1,1,0,0,0,0],
			[0,2,2,0,0,1,0,0,0,0],
			[0,2,0,0,0,1,1,0,0,0],
			[0,2,0,0,0,0,0,0,0,0],
			[0,2,1,1,0,0,2,2,2,2],
			[0,2,1,1,0,0,2,2,2,2],
			[0,2,2,2,2,2,2,0,0,3]
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
			[0,0,0,0,0,0,0,0,0,3]
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

			var heroOverworldLocation;
			var loc;

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

					if(map[i][j] == 3) {
						context.drawImage(portal, xPos, yPos, 50, 50);
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
				var x = true;
				var i = -1;
				do {
					i++;
					var charLocation = heroMap[i].indexOf(1);
					if (i == heroMap.length - 1) 
						x = false;
				} while(x && charLocation == -1);
				return [i, charLocation];
			}

			function findPortal() {
				//This finds a portal on the map if there is one. If there is not, it returns [9, -1]
				var x = true;
				var i = -1;
				do {
					i++;
					var portalLocation = map[i].indexOf(3);
					if (i === map.length -1)
						x = false;
				} while(x && portalLocation == -1);
				return [i, portalLocation];
			}

			function battleChance() {
				//This uses a switch and a random number to start a battle (currently just a teleport to enemyMap)
				if (map != enemyMap) {
					heroOverworldLocation = findHero();

					var ran = Math.floor((Math.random() * 10) + 1);
					switch(ran){
						case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8:
						break;
						case 9: case 10:
						map = enemyMap;
						break;
						
					}
				}
			}

			function teleport(key) {
				//This checks of the player is standing on a portal and if so, teleports them (currently either away from the battle, from map1 to map2 depending on where they are currently). It uses the 'key' variable as a parameter to determine direction.
				
				if (JSON.stringify(findHero()) == JSON.stringify(findPortal())) {
					if (map == enemyMap) {
						map = map1;
						heroMap[heroOverworldLocation[0]][heroOverworldLocation[1]] = 1;
						switch(key) {
							case 37:
							heroMap[loc[0]][loc[1]-1] = 0;
							break;
							case 38:
							heroMap[loc[0]-1][loc[1]] = 0;
							break;
							case 39:
							heroMap[loc[0]][loc[1]+1] = 0;
							break;
							case 40:
							heroMap[loc[0]+1][loc[1]] = 0;
							break;
						}
					} else {
						map = map2;
						heroMap[0][0] = 1;
						switch(key) {
							case 37:
							heroMap[loc[0]][loc[1]-1] = 0;
							break;
							case 38:
							heroMap[loc[0]-1][loc[1]] = 0;
							break;
							case 39:
							heroMap[loc[0]][loc[1]+1] = 0;
							break;
							case 40:
							heroMap[loc[0]+1][loc[1]] = 0;
							break;

						}
					}
				}
			}


			function move(event) {
				var key = event.keyCode;
				loc = findHero();
				//UP
				if (key == 38) {
					
					//First, find the hero on the map/array. findHero() returns a 2 value array where the first value is the players y coordinate, and the second value is the x coordinate (The coordinates are backwards, not for any particular reason besides me not noticing until I was done.)

					//Next, make sure he isn't trying to leave the array (would cause an error), or trying to walk on water
					//IMPORTANT: The if statement checks the map[] array for water, not the heroMap[] array
					if (loc[0] > 0 && map[loc[0]-1][loc[1]] != 1) {
						

						//if loc = [1,1], the player is attempting to move to [0,1]

						//This sets the value of the array index 'above' the player's current position to be the player (in this case)
						heroMap[loc[0]-1][loc[1]] = 1;

						//This changes the space the player was on into a 0
						heroMap[loc[0]][loc[1]] = 0;

						//This uses a switch and a random number to start a battle (currently just a teleport to enemyMap) 
						battleChance();

						//This checks of the player is standing on a portal and if so, teleports them (currently either away from the battle, from map1 to map2 depending on where they are currently). It uses the key variable as a parameter to determine direction.
						teleport(key);
						//Finally, we redraw the map
						//TODO: Modularize this function if possible
						renderMap();
					}
				}
				//DOWN
				if (key == 40) {
					if (loc[0] < 9 && map[loc[0]+1][loc[1]] != 1) {
						heroMap[loc[0]+1][loc[1]] = 1;
						heroMap[loc[0]][loc[1]] = 0;
						battleChance();
						teleport(key);
						renderMap();
					}
				}
				//LEFT
				if (key == 37) {

					if (loc[1] > 0 && map[loc[0]][loc[1]-1] != 1) {
						heroMap[loc[0]][loc[1]-1] = 1;
						heroMap[loc[0]][loc[1]] = 0;
						battleChance();
						teleport(key);
						renderMap();
					}
				}
				//RIGHT
				if (key == 39) {
					if (loc[1] < 9 && map[loc[0]][loc[1]+1] != 1) {
						heroMap[loc[0]][loc[1]+1] = 1;
						heroMap[loc[0]][loc[1]] = 0;
						battleChance();
						teleport(key);
						renderMap();
					}
				}
			}

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

		<footer id="foot">
		<strong id="strong"> &#169; Copyright 2017</strong>
			<p id="enjoy">ENJOY THE GAME!!!</p>
		</footer>
		</div>
		</script>
	<body>
</html>
