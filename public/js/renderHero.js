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