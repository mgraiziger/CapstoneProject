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
    renderHero();
    
}