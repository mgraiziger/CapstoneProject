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
    }
}