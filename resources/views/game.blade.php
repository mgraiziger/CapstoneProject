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
			
		<div id="canvasWrapper">
		<canvas id="canvas" height="500" width="500"></canvas>
		</div>
		<script type="text/javascript">
			var canvas = document.querySelector('#canvas');
			var context = canvas.getContext('2d');

			var portal = new Image();
			var grass = new Image();
			var water = new Image();
			var dirt = new Image();

			portal.src = '{{URL::asset('images/portal.png')}}';
			grass.src = '{{URL::asset('images/grass.png')}}';
			water.src = '{{URL::asset('images/water.png')}}';
			dirt.src = '{{URL::asset('images/dirt.png')}}';
			
			var battleSound = new Audio('{{URL::asset('Sound/danger.ogg')}}');
			battleSound.loop = true;
			
			var worldSound = new Audio('{{URL::asset('Sound/background.ogg')}}');
			worldSound.volume = 0.75;
			worldSound.loop = true;

			//0 = grass; 1 = water; 2 = dirt;
			var map;
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
			var map3 = [
			[0,0,0,0,0,0,0,1,1,1],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,3]	
			];
			var map4 = [
			[0,0,0,0,0,0,1,0,1,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,3]	
			];
			var map5 = [
			[0,0,0,0,0,1,0,1,0,1],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
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

			var heroImage = new Image();
			var b1Image = new Image();
			var b2Image = new Image();
			var b3Image = new Image();
			var b4Image = new Image();
			var b5Image = new Image();

			heroImage.src ='{{URL::asset('images/player.png')}}';
			b1Image.src = '{{URL::asset('images/B1.png')}}';
			b2Image.src = '{{URL::asset('images/B2.png')}}';
			b3Image.src = '{{URL::asset('images/B3.png')}}';
			b4Image.src = '{{URL::asset('images/B4.png')}}';
			b5Image.src = '{{URL::asset('images/B5.png')}}';

			//Stats
			var hero = {
				image: heroImage,
				str: 10,
				con: 100,
				dex: 10,
				intel: 10,
				wis: 10,
				char: 10,
				luck: 10
			}

			var b1 = {
				image: b1Image,
				str: 3,
				con: 3,
				dex: 3,
				intel: 3,
				wis: 3,
				char: 3,
				luck: 3
			}

			var b2 = {
				image: b2Image,
				str: 5,
				con: 5,
				dex: 5,
				intel: 5,
				wis: 5,
				char: 5,
				luck: 5
			}

			var b3 = {
				image: b3Image,
				str: 7,
				con: 7,
				dex: 7,
				intel: 7,
				wis: 7,
				char: 7,
				luck: 7
			}

			var b4 = {
				image: b4Image,
				str: 9,
				con: 9,
				dex: 9,
				intel: 9,
				wis: 9,
				char: 9,
				luck: 9
			}

			var b5 = {
				image: b5Image,
				str: 10,
				con: 10,
				dex: 10,
				intel: 10,
				wis: 10,
				char: 10,
				luck: 10
			}

			var loc;
			var map = map1;
			var movement = true;
			var teleporting = false;
			var enemyLife;
			var enemyMax;

			var wrapper = document.querySelector('#canvasWrapper');

			//This animation is called during teleportation. It creates a purple rectangle starting from the bottom right corner extending to the upper left corner, then clears the rectangle in the same direction.
			function teleportAnimation() {
				//Movement is disables for the extent of the animation as the renderMap() call in the move() function makes the animation skip frames
				movement = false;
				var x;
				var y;
				var myInterval;
				teleporting = true;

				x = 0;
				y = 450;
				//setInterval() executes a function (first parameter) once every set number of milliseconds (second parameter)
				//Note that setInterval() does not suspend the program while it executes, and that if you need to run code only after setInterval() has completed, you must put it inside the function being looped, in the path that leads to clearInterval(). clearInterval() ends the setInterval() loop.
				myInterval = setInterval(animateRectangle, 1);
				function animateRectangle() {
					if (x == -501) {
						clearInterval(myInterval);
						//finishRect() must only be run after animateRectangle has completed, so it is included at the very end of this function. It is only run once from the first setInterval() because it is called after the clearInterval() statement.
						switch(JSON.stringify(map)) {
						case JSON.stringify(map1):
						map = map2;
						break;
						case JSON.stringify(map2):
						map = map3;
						break;
						case JSON.stringify(map3):
						map = map4;
						break;
						case JSON.stringify(map4):
						map = map5;
						break;
						case JSON.stringify(map5):
						window.alert("You Win!");
						break;
					}
						finishRect();
					} else {
						context.clearRect(0, 0, 500, 500);
						renderMap();
						context.fillStyle="#A348A3";
						context.fillRect(500, 500, x, x);
						context.drawImage(hero.image, y, y, 50, 50);
						if (x <= -50) {
							y -= 0.5;
						}
						x--;
					}
				}
			}

			function finishRect() {
				var x;
				var y = 224.5;
				var myInterval;
				heroMap[0][0] = 1;
				
				x = 500;
				myInterval = setInterval(clearRectangle, 1);
				function clearRectangle() {
					if (x == -1) {
						clearInterval(myInterval);
						//movement should only be disabled after the setInterval() is complete, so we put if after clearInterval() so it is only run once at the end of the loop
						movement = true;
						teleporting = false;
					} else {
						context.clearRect(0, 0, 500, 500);
						renderMap();
						context.fillStyle="#A348A3";
						context.fillRect(0, 0, x, x);
						context.drawImage(hero.image, y, y, 50, 50);
						if (y > 0) {
							y -= 0.5;
						}
						x--;
					}
				}
			}

			function battleEnemy(){
				var bossRan = Math.floor((Math.random() * 10) + 1);

				switch(bossRan){
					case 1: case 2: case 3:
					return b1;
					break;

					case 4: case 5:
					return b2;
					break;

					case 6: case 7:
					return b3;
					break;

					case 8: case 9: 
					return b4;
					break;

					case 10:
					return b5;
					break;

				}

			}

			function renderBattle() {
				//This disallows player movement behind the scenes
				movement = false;
				worldSound.pause();
				battleSound.play();

				context.clearRect(0,0,500,500);

				//This selects an enemy at random (chances for particular enemies can be seen in battleEnemy()). The enemy variable is an object containing that character's battle image, and their stats.
				var enemy = battleEnemy();
				context.drawImage(enemy.image, 0, 0, 500, 500);
				enemyLife = enemy.con * 10;
				enemyMax = enemyLife;

				//This creates and places the buttons on the screen. Their position is based on CSS for <button>'s and the id's #button1 and #button2

				var button1 = document.createElement("button");
				button1.innerHTML = "Fight";
				button1.id = "button1";
				var button2 = document.createElement("button");
				button2.innerHTML = "Run";
				button2.id = "button2";
				wrapper.appendChild(button1);
				wrapper.appendChild(button2);
				
				//This creates a progress bar to represent a life bar.
				var lifeBar = document.createElement("progress");
				lifeBar.id = "enemyLife";
				//These lines sets the value of bar, or how much is filled at the start
				lifeBar.setAttribute("value", enemyLife);
				lifeBar.setAttribute("max", enemyMax);
				wrapper.appendChild(lifeBar);

				//This determines what happens when the player clicks the "Fight" button
				button1.onclick = function() {
					//This subtracts from the enemyLife value, and deletes and remakes the progress bar. The amount subtracted is the hero's strength + a random number between -5 and 5;
					enemyLife -= hero.str + Math.floor(Math.random() * 10 -5);
					lifeBar.parentNode.removeChild(lifeBar);
					lifeBar.setAttribute("value", life);
					wrapper.appendChild(lifeBar);
					//This ends the battle if the lifebar is 0 or less
					if (enemyLife <= 0) {
						endBattle();
					}
				}
				//This determines what happens when the player clicks the "Run" button
				button2.onclick = function() {
					endBattle();
					
				}
			}

			function endBattle() {
				//This function deletes all elements created during a battle and renders the map.
				if (!movement) {
				movement = true;
				var elem = document.getElementById('button1');
				elem.parentNode.removeChild(elem);
				elem = document.getElementById('button2');
				elem.parentNode.removeChild(elem);
				elem = document.getElementById('enemyLife');
				elem.parentNode.removeChild(elem);
				battleSound.pause();
				battleSound.currentTime = 0;
				worldSound.play();
				renderMap();
				}
			}

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
							context.drawImage(hero.image, xPos, yPos, 50, 50);
						}
						xPos+=50;
					}
					xPos=0;
					yPos+=50;
				}
			}

			function findHero() {
				//loops through each array within the heroMap array and finds the 1 value representing the hero. It returns [9, -1] if the hero is not found
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
				//This uses a switch and a random number to start a battle (currently just a screen redraw, a 2 second wait before you can move again)
				if (JSON.stringify(findPortal()) !== JSON.stringify(findHero())) {
					heroOverworldLocation = findHero();

					var ran = Math.floor((Math.random() * 10) + 1);
					switch(ran){
						case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8:
						break;
						case 9: case 10:
						renderBattle();
						break;
						
					}
				}
			}

			

			function teleport(key) {
				if (JSON.stringify(findHero()) == JSON.stringify(findPortal())) {
					teleportAnimation();
					//This statement is executed in the teleportAnimation() function so the hero doesn't appear in the top corner until he is animated there.
					//heroMap[0][0] = 1;
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
					//This switch is called in the teleportAnimation() so the map doesn't change until the whole screen is covered in the animated rectangle
					/*switch(JSON.stringify(map)) {
						case JSON.stringify(map1):
						map = map2;
						break;
						case JSON.stringify(map2):
						map = map3;
						break;
						case JSON.stringify(map3):
						map = map4;
						break;
						case JSON.stringify(map4):
						map = map5;
						break;
						case JSON.stringify(map5):
						window.alert("You Win!");
						break;
					}*/
				}
			}

			function move(event) {
				var key = event.keyCode;
				loc = findHero();

				//the movement variable is a boolean that is false when in a battle, or during an animation. The player cannot move in either of these circumstances.
				if (movement) {
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

							//This checks of the player is standing on a portal and if so, teleports them (currently either away from the battle, from map1 to map2 depending on where they are currently). It uses the key variable as a parameter to determine direction.
							teleport(key);
							//Finally, we redraw the map
							//TODO: Modularize this function if possible
							renderMap();

							//This uses a random number and a switch to potentially start a battle. For now, the battle is a quick redraw and 2 seconds where the player cannot move.
							battleChance();
						}
					}
					//DOWN
					if (key == 40) {
						if (loc[0] < 9 && map[loc[0]+1][loc[1]] != 1) {
							heroMap[loc[0]+1][loc[1]] = 1;
							heroMap[loc[0]][loc[1]] = 0;
							teleport(key);
							renderMap();
							battleChance();
						}
					}
					//LEFT
					if (key == 37) {

						if (loc[1] > 0 && map[loc[0]][loc[1]-1] != 1) {
							heroMap[loc[0]][loc[1]-1] = 1;
							heroMap[loc[0]][loc[1]] = 0;							
							teleport(key);
							renderMap();
							battleChance();
						}
					}
					//RIGHT
					if (key == 39) {
						if (loc[1] < 9 && map[loc[0]][loc[1]+1] != 1) {
							heroMap[loc[0]][loc[1]+1] = 1;
							heroMap[loc[0]][loc[1]] = 0;
							teleport(key);
							renderMap();
							battleChance();
						}
					}
				}
			}

			//This should be replaced with a promise if I can figure out how promises work.
			dirt.onload = function() {
				worldSound.play();
				renderMap();
			}

			//Keeps window from scrolling when arrow keys or space bar are pressed
			document.addEventListener('keydown', function(e) {
				if ([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
					e.preventDefault();
				}
			}, false);

			//This is what executes move()
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



<!--
	Temporary Storage

	function sleep(ms) {
				return new Promise(resolve => setTimeout(resolve, ms));
			}

			async function demo() {
				
				await sleep(2000);
				
			}

	var maps = {
				map1:[
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
				],
				map2:[
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
				],
				map3:[
				[0,0,0,0,0,0,0,1,1,1],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,3]	
				],
				map4:[
				[0,0,0,0,0,0,1,1,1,1],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,3]	
				],
				map5:[
				[0,0,0,0,0,1,1,1,1,1],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,0],
				[0,0,0,0,0,0,0,0,0,3]	
				]
			};

	-->