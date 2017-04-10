function battleChance() {
    //This uses a switch and a random number to start a battle (currently just a screen redraw, a 2 second wait before you can move again)
    if (!teleporting) {
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
}