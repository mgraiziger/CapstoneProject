function renderBattle() {
    //This disallows player movement behind the scenes
    movement = false;
    worldSound.pause();
    battleSound.play();

    context.clearRect(0, 0, 500, 500);

    //This selects an enemy at random (chances for particular enemies can be seen in battleEnemy()). The enemy variable is an object containing that character's battle image, and their stats.
    var enemy = battleEnemy();
    context.drawImage(enemy.image, 0, 0, 500, 500);
    enemyLife = enemy.con * 10;
    enemyMax = enemyLife;

    //This creates and places the buttons on the screen. Their position is based on CSS for <button>'s and the id's #button1 and #button2

    var button1 = document.createElement("button");
    button1.innerHTML = "Fight";
    button1.id = "button1";
    var button2 = document.createElement("button");
    button2.innerHTML = "Run";
    button2.id = "button2";
    wrapper.appendChild(button1);
    wrapper.appendChild(button2);

    //This uses Canvas to draw a life bar
    var barLength = 240;
    context.fillStyle = '#09c400';
    context.fillRect(10, 90, barLength, 30);
    context.font = "30px Impact";
    context.strokeStyle = "#ffffff";
    context.strokeText(enemyLife, 15, 117);


    //This determines what happens when the player clicks the "Fight" button
    button1.onclick = function() {
        //This subtracts from the enemyLife value, and deletes and remakes the progress bar. The amount subtracted is the hero's strength + a random number between -5 and 5;
        enemyLife -= hero.str + Math.floor(Math.random() * 10 -5);
        let total = enemyLife * 240 / enemyMax;
        barLength = total;
        context.clearRect(0, 0, 500, 500);
        context.drawImage(enemy.image, 0, 0, 500, 500)
        context.fillRect(10, 90, barLength, 30);
        context.strokeText(enemyLife, 15, 117);

        //This ends the battle if the lifebar is 0 or less
        if (enemyLife <= 0) {
            endBattle();
        }
    }
    //This determines what happens when the player clicks the "Run" button
    button2.onclick = function() {
        endBattle();
        
    }
}