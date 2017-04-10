function findHero() {
    //loops through each array within the heroMap array and finds the 1 value representing the hero. It returns [9, -1] if the hero is not found
    var x = true;
    var i = -1;
    do {
        i++;
        var charLocation = heroMap[i].indexOf(1);
        if (i == heroMap.length - 1) 
            x = false;
    } while(x && charLocation == -1);
    return [i, charLocation];
}