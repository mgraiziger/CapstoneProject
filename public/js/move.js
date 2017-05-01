function move(event) {
    var key = event.keyCode;
    loc = findHero();

    //the movement variable is a boolean that is set to false when the hero should not be able to move (in a battle, teleporting)
    if (movement) {
        //UP
        if (key == 38) {
            
            //First, find the hero on the map/array. findHero() returns a 2 value array where the first value is the players y coordinate, and the second value is the x coordinate (The coordinates are backwards, not for any particular reason besides me not noticing until I was done.)

            //Next, make sure he isn't trying to leave the array (would cause an error), or trying to walk on water
            //IMPORTANT: The if statement checks the map[] array for water, not the heroMap[] array
            if (loc[0] > 0 && map[loc[0]-1][loc[1]] != 1 && map[loc[0]-1][loc[1]] != 4) {
                
                //if loc = [1,1], the player is attempting to move to [0,1]

                //This sets the value of the array index 'above' the player's current position to be the player (in this case)
                heroMap[loc[0]-1][loc[1]] = 1;

                //This changes the space the player was on into a 0
                heroMap[loc[0]][loc[1]] = 0;

                //This checks of the player is standing on a portal and if so, teleports them (currently either away from the battle, from map1 to map2 depending on where they are currently). It uses the key variable as a parameter to determine direction.
                teleport(key);
                //Finally, we redraw the map
                //TODO: Modularize this function if possible
                renderMap();

                //This uses a random number and a switch to potentially start a battle. For now, the battle is a quick redraw and 2 seconds where the player cannot move.
                battleChance();
            }
        }
        //DOWN
        if (key == 40) {
            if (loc[0] < 9 && map[loc[0]+1][loc[1]] != 1  && map[loc[0]+1][loc[1]] != 4) {
                heroMap[loc[0]+1][loc[1]] = 1;
                heroMap[loc[0]][loc[1]] = 0;
                teleport(key);
                renderMap();
                battleChance();
            }
        }
        //LEFT
        if (key == 37) {

            if (loc[1] > 0 && map[loc[0]][loc[1]-1] != 1 && map[loc[0]][loc[1]-1] != 4) {
                heroMap[loc[0]][loc[1]-1] = 1;
                heroMap[loc[0]][loc[1]] = 0;							
                teleport(key);
                renderMap();
                battleChance();
            }
        }
        //RIGHT
        if (key == 39) {
            if (loc[1] < 9 && map[loc[0]][loc[1]+1] != 1 && map[loc[0]][loc[1]+1] != 4) {
                heroMap[loc[0]][loc[1]+1] = 1;
                heroMap[loc[0]][loc[1]] = 0;
                teleport(key);
                renderMap();
                battleChance();
            }
        }
    }
}