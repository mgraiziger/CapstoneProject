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

    //Sets player health * con
    var playerHealth = hero.con * 10;
    playerMax = playerHealth;

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

    //Player Life bar
    var pBarLength = 240;
    context.fillStyle = '#FF0000';
    context.fillRect(255, 90, pBarLength, 30);
    context.font = "30px Impact";
    context.strokeStyle = "#ffffff";
    context.strokeText(playerHealth, 445,117);

    //This determines what happens when the player clicks the "Fight" button
    button1.onclick = function() {
        if (!textPrinting) {
            //This subtracts from the enemyLife value, and deletes and remakes the progress bar. The amount subtracted is the hero's strength + a random number between -5 and 5;
            var enemyDamage = hero.str + ran5();
            var playerDamage = enemy.str + ran5();
            enemyLife -= enemyDamage;
            playerHealth -= playerDamage;
            let pTotal = playerHealth * 240 / playerMax;
            let total = enemyLife * 240 / enemyMax;
            barLength = total;
            pBarLength = pTotal;
            context.clearRect(0, 0, 500, 500);
            context.drawImage(enemy.image, 0, 0, 500, 500)
            context.font = "30px Impact";
            context.fillStyle = '#09c400';
            context.fillRect(10, 90, barLength, 30);
            context.fillStyle = '#FF0000';
            context.fillRect(255,90, pBarLength, 30);
            context.strokeText(enemyLife, 15, 117);
            context.strokeText(playerHealth,445,117);
            context.strokeText(enemyDamage,200,155);
            context.strokeText(playerDamage,290,155);
        
            //This ends the battle if the lifebar is 0 or less
            if (enemyLife <= 0) {
                endBattle();
            }
            if(playerHealth <= 0){
                endBattle();
                window.alert("You Lose!");
                location.reload();
            }
        }
    }
    //This determines what happens when the player clicks the "Run" button
    button2.onclick = function() {
        if (!textPrinting) {
            //var ran = Math.floor(Math.random() * 10 -5);
            if (hero.dex > enemy.dex + ran5()) {
                endBattle();
            } else {
                var playerDamage = enemy.str + ran5();
                playerHealth -= playerDamage;
                context.clearRect(0, 0, 500, 500);
                context.drawImage(enemy.image, 0, 0, 500, 500)
                context.font = "30px Impact";
                context.fillStyle = '#09c400';
                context.fillRect(10, 90, barLength, 30);
                context.fillStyle = '#FF0000';
                context.fillRect(255,90, pBarLength, 30);
                context.strokeText(enemyLife, 15, 117);
                context.strokeText(playerHealth,445,117);
                if (playerDamage.toString().includes("-")) {
                    var stringDamage = playerDamage.toString().replace('-', '');
                    context.strokeText("+ " + stringDamage, 290, 155);
                } else {
                    context.strokeText("- " + playerDamage, 290, 155);
                renderText("YOU TRY TO RUN, BUT " + enemy.name + " IS TOO FAST! " + enemy.name + " HITS YOU AS YOU TRY TO ESCAPE!", 355, 150, 130, 200);
                }
                if(playerHealth <= 0){
                    endBattle();
                    window.alert("You Lose!");
                    location.reload();
                }  
            }
        }
        
        
        
    }
}

function ran5() {
    return Math.floor(Math.random() * 10 -5);
}