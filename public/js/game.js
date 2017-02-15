//This script has been migrated to /resources/view/game.blade.php to allow links to work

var canvas = document.querySelector('#canvas');
var context = canvas.getContext('2d');

var grass = new Image();
var water = new Image();
var dirt = new Image();

grass.src = '{{base_path(public/images/grass.jpg)}}';
water.src = 'water.png';
dirt.src = 'dirt.png';


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







/*var wrapper = document.getElementById('wrapper');
var newDiv = document.createElement('div');

for (let i = 0; i < 100; i++) {
	let x = Math.floor(Math.random() * 3) + 1;
	let c = 'green';
	//newDiv.id = i;
	if (x == 3) {
		c = 'red';
	} else if (x == 2) {
		c = 'green';
	} else {
		c = 'blue';
	}
	let y = '<div class=' + c + ' id =' + i + '></div>';
	wrapper.innerHTML += y;
}*/