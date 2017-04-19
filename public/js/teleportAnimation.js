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
            location.reload();
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