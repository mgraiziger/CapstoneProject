function findPortal() {
    //This finds a portal on the map if there is one. If there is not, it returns [9, -1]
    var x = true;
    var i = -1;
    do {
        i++;
        var portalLocation = map[i].indexOf(3);
        if (i === map.length -1)
            x = false;
    } while(x && portalLocation == -1);
    return [i, portalLocation];
}