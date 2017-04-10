function endBattle() {
    //This function deletes all elements created during a battle and renders the map.
    if (!movement) {
    movement = true;
    var elem = document.getElementById('button1');
    elem.parentNode.removeChild(elem);
    elem = document.getElementById('button2');
    elem.parentNode.removeChild(elem);

    battleSound.pause();
    battleSound.currentTime = 0;
    worldSound.play();
    renderMap();
    }
}