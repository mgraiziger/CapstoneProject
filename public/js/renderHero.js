function renderHero() {
    //This renders the hero. It is called in the renderMap() function
    var xPos= 0;
    var yPos= 0;
    for(let i=0; i<heroMap.length; i++)
    {
        for(let j=0; j<heroMap[i].length; j++) {
            if(heroMap[i][j] == 1) {
                //Renders the hero
                context.drawImage(hero.image, xPos, yPos, 50, 50);

                //This writes the hero's current health over the hero
                context.font = "18px Impact";
                context.strokeStyle = "#ffffff";
                context.fillStyle = "#ff0000";
                context.textAlign = "center";
                context.fillText(playerHealth, xPos + 25, yPos + 45);
                context.strokeText(playerHealth, xPos + 25, yPos + 45);
            }
            xPos+=50;
        }
        xPos=0;
        yPos+=50;
    }
}