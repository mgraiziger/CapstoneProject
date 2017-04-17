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

		<!--Load Maps-->
		<script type="text/javascript" src="{{URL::asset('js/maps.js')}}"></script>

		<!--Load Images-->
		<script type="text/javascript" src="{{URL::asset('js/images.js')}}"></script>

		<!--Load Music-->
		<script type="text/javascript" src="{{URL::asset('js/sound.js')}}"></script>

		<!--Load Characters-->
		<script type="text/javascript" src="{{URL::asset('js/characters.js')}}"></script>
		
		<!--Load Teleport Animation-->
		<script type="text/javascript" src="{{URL::asset('js/teleportAnimation.js')}}"></script>

		<!--Load Battle Enemy-->
		<script type="text/javascript" src="{{URL::asset('js/battleEnemy.js')}}"></script>

		<!--Load Render Battle-->
		<script type="text/javascript" src="{{URL::asset('js/renderBattle.js')}}"></script>

		<!--Load End Battle-->
		<script type="text/javascript" src="{{URL::asset('js/endBattle.js')}}"></script>

		<!--Load Render Map-->
		<script type="text/javascript" src="{{URL::asset('js/renderMap.js')}}"></script>

		<!--Load Render Hero-->
		<script type="text/javascript" src="{{URL::asset('js/renderHero.js')}}"></script>

		<!--Load Find Hero-->
		<script type="text/javascript" src="{{URL::asset('js/findHero.js')}}"></script>

		<!--Load Find Portal-->
		<script type="text/javascript" src="{{URL::asset('js/findPortal.js')}}"></script>

		<!--Load Battle Chance-->
		<script type="text/javascript" src="{{URL::asset('js/battleChance.js')}}"></script>

		<!--Load Teleport-->
		<script type="text/javascript" src="{{URL::asset('js/teleport.js')}}"></script>

		<!--Load Move-->
		<script type="text/javascript" src="{{URL::asset('js/move.js')}}"></script>

		<!--Load Render Text-->
		<script type="text/javascript" src="{{URL::asset('js/renderText.js')}}"></script>

		<!--Load Render Start-->
		<script type="text/javascript" src="{{URL::asset('js/renderStart.js')}}"></script>

		<script type="text/javascript">

			var canvas = document.querySelector('#canvas');
			var context = canvas.getContext('2d');
			var wrapper = document.querySelector('#canvasWrapper');

			var startPicture;
			
			var map = map1;
			var movement = true;
			var teleporting = false;
			var enemyLife;
			var enemyMax;

			/*let myFirstPromise = new Promise((resolve, reject) => {
    			setTimeout(function() {
       				resolve("Success!");}, 1000);
			})
			*/

			let imagePromise = new Promise(function(resolve, reject) {
				startPicture = new Image();
				startPicture.onload = function() {
					resolve("Success");
				}
				startPicture.onerror = function() {
					reject("Failure");
				}
				startPicture.src ="{{URL::asset('images/startMenu.png')}}"
			})

			imagePromise.then(function() {
				worldSound.play();
				renderStart();
			})

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