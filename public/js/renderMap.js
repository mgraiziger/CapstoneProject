function renderFog() {
    var position = findHero();
    var xPos = 0;
    var yPos = 0;
    
    //This checks if the hero's intelligence would de-fog an area above the map (throws an error)
    if (position[0] - hero.intel < 0) {
        let startPoint = [0, position[1]];
        //This checks if the hero's intelligence would de-fog an area left of the map
        //For some reason separating these two if statements removes an error thrown when the player moves to the bottom left corner within the number of spaces equal to their intelligence stat
        if (position[1] - hero.intel < 0) {
            let startPoint = [0, 0];
            for (let i = 0; i < position[0] + 1; i++) {
                for (let j = 0; j < position[1] + 1; j++) {
                    fogMap[startPoint[0]+i][startPoint[1]+j] = 1;
                }
            }
            for (let i = 0; i < position[0] + hero.intel + 1; i++) {
                for (let j = 0; j < position[1] + hero.intel + 1; j++) {
                    fogMap[startPoint[0]+i][startPoint[1]+j] = 1;
                }
            }
        }
    } else {
        let startPoint = [position[0] - hero.intel, position[1] - hero.intel];
        for (let i = 0; i < hero.intel * 2 + 1 && startPoint[0] + i <= 9; i++) {
            for (let j = 0; j < hero.intel* 2 + 1; j++) {
                fogMap[startPoint[0]+i][startPoint[1]+j] = 1;
            }
        }
    }


    for(let i = 0; i<fogMap.length; i++) {
        for (let j = 0; j<fogMap[i].length; j++) {
            if(fogMap[i][j] === 0) {
                context.drawImage(fog, xPos, yPos, 50, 50);
            }
            xPos+=50;
        }
        xPos=0;
        yPos+=50;
    }



/*
    fogMap[position[0]][position[1]] = 1;
    var arrayRoom = true;
    var arrayRoomUp = true;
    var arrayRoomDown = true;
    var arrayRoomLeft = true;
    var arrayRoomRight = true;
    var i = 0;
    debugger;
    while (arrayRoom) {
        if (position[0]-i < 0) {
            arrayRoomUP = false;
        }
        if (position[0]+i > 9) {
            arrayRoomDown = false;
        }
        if (position[1]-i < 0) {
            arrayRoomLeft = false;
        }
        if (position[0]-i < 0) {
            arrayRoomUP = false;
        }
        if (position[1]+i > 9) {
            arrayRoomRight = false;
        }
        if (i > hero.intel) {
            arrayRoom = false;
        }
        if (!arrayRoomUp && ! arrayRoomDown && !arrayRoomLeft && !arrayRoomRight) {
            arrayRoom = false;
        }
        if (arrayRoomUp) {
            fogMap[position[0]-i][position[1]] = 1;
            if (arrayRoomLeft) {
                fogMap[position[0]-i][position[1]-i] = 1;
            }
            if (arrayRoomRight) {
                fogMap[position[0]-i][position[1]+i] = 1;
            }
        }
        if (arrayRoomDown) {
            fogMap[position[0]+i][position[1]] = 1;
            if (arrayRoomLeft) {
                fogMap[position[0]+i][position[1]-i] = 1;
            }
            if (arrayRoomRight) {
                fogMap[position[0]+i][position[1]+i] = 1;
            }
        }
        if (arrayRoomLeft) {
            fogMap[position[0][position[1]-i]] = 1;
        }
        if (arrayRoomRight) {
            fogMap[position[0][position[1]+i]] = 1;
        }
        i++;
    }
    
    if (hero.intel > 0) {
        if (position[0]-hero.intel < 0) {
            for(let i = position[0]; i >= 0; i--) {
                fogMap[i][position[1]] = 1;
            }
        } else {
            
        }
    }

    var xPos = 0;
    var yPos = 0;
    for(let i = 0; i<fogMap.length; i++) {
        for (let j = 0; j<fogMap[i].length; j++) {
            if(fogMap[i][j] === 0) {
                context.drawImage(fog, xPos, yPos, 50, 50);
            }
            xPos+=50;
        }
        xPos=0;
        yPos+=50;
    }
    */
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
        
        if(map[i][j] == 4) {
            context.drawImage(lava, xPos, yPos, 50, 50);
        }

        if(map[i][j] == 3) {
            context.drawImage(portal, xPos, yPos, 50, 50);
        }
        xPos+=50;
        }
        xPos=0;
        yPos+=50;
    }
    renderFog();
    renderHero();
    
}