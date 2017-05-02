//This function returns an enemy from the characters.js file. Each enemy has stats specific to them, and the higher the enemy's stats, the less likely they will be returned.
function battleEnemy(){
    let bossRan = Math.floor((Math.random() * 10) + 1);
    switch(bossRan){
        case 1: case 2: case 3:
        return b1;
        break;

        case 4: case 5:
        return b2;
        break;

        case 6: case 7:
        return b3;
        break;

        case 8: case 9: 
        return b4;
        break;

        case 10:
        return b5;
        break;
    }
}