function endBattle() {
    //This function deletes all elements created during a battle and renders the map.
    if (!movement) {
    movement = true;
    }

    while (wrapper.children.length > 1) {
        wrapper.removeChild(wrapper.lastChild);
    }
    battleSound.pause();
    battleSound.currentTime = 0;
    worldSound.play();
    renderMap();
    
}