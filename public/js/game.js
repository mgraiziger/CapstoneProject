var wrapper = document.getElementById('wrapper');
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
}
/*    
    var grass = new Image(10,10);
    grass.src = '/public/js/grass.jpg';
    console.log(grass);

grass.onload = function() {

var canvas=document.getElementById(wrapper);
    var ctx=canvas.getContext("2d");
    
    
    ctx.drawImage(grass,0,0)

}*/