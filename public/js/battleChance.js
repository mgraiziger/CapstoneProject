function battleChance() {
    //This uses the hero's luck attribute to determine how often a battle is triggered. It rolls a random number 1-10 and compares that to the hero's luck. If the random number is greater than or equal to the hero's luck, a battle is triggered. As a result, if the hero's luck is 11 or greater, battles are not possible.
    if (!teleporting) {
        if (JSON.stringify(findPortal()) !== JSON.stringify(findHero())) {
            heroOverworldLocation = findHero();
            var ran = Math.floor((Math.random() * 10) + 1);
            if (ran >= hero.luck) {
                renderBattle();
            }
        }
    }
}