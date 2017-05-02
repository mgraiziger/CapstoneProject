//This function renders a battle if one is called in battleChance.js
function renderBattle() {
    //This disallows player movement behind the scenes
    movement = false;
    worldSound.pause();
    battleSound.play();

    context.clearRect(0, 0, 500, 500);
    context.textAlign = "start";

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

    //This uses Canvas to draw a life bar for the enemy
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
        //This makes sure no text is being rendered (by renderText()) before proceeding. If actions are taken while text is rendering, it can cause problems with things being drawn.
        if (!textPrinting) {
            //This determines how much damage is dealt to the hero and the enemy. The amount is equal to the hero/enemy's strength stat plus a number between -5 and +5.
            var enemyDamage = hero.str + ran5();
            var playerDamage = enemy.str + ran5();
            enemyLife -= enemyDamage;
            playerHealth -= playerDamage;

            //This determines the length of the health bars after calculating damage
            let pTotal = playerHealth * 240 / playerMax;
            let total = enemyLife * 240 / enemyMax;
            barLength = total;
            pBarLength = pTotal;

            //This clears and redraws the screen with all appropriate adjustments made to health and health bars.
            context.clearRect(0, 0, 500, 500);
            context.drawImage(enemy.image, 0, 0, 500, 500)
            context.font = "30px Impact";
            context.fillStyle = '#09c400';
            context.fillRect(10, 90, barLength, 30);
            context.fillStyle = '#FF0000';
            context.fillRect(255,90, pBarLength, 30);
            context.strokeText(enemyLife, 15, 117);
            context.strokeText(playerHealth,445,117);
            //If a character (enemy or player) has very low strength, it is possible for their attack to heal their opponent. If this happens, a + sign is appended to the beginning of the number, indicating that it was a very poor attack.
            if (enemyDamage.toString().includes("-")) {
                let stringDamage = enemyDamage.toString().replace('-', '');
                context.strokeText("+ " + stringDamage, 200, 155);
                //Normal attacks will have a - sign appended to clearly show the subtraction.
            } else {
                context.strokeText("- " + enemyDamage,200,155);
            }
            if (playerDamage.toString().includes("-")) {
                let stringDamage = playerDamage.toString().replace('-', '');
                context.strokeText("+ " + stringDamage, 290, 155);
            } else {
                context.strokeText("- " + playerDamage,290,155);
            }
            
        
            //This ends the battle if a lifebar is 0 or less. If the hero's lifebar reaches 0, the game is over and the page reloads.
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
            //The hero's dextarity determines how good they are at running away. The enemy's DEX has a random number between -5 and +5 added to it. If the hero's DEX is higher than this semi-random number, they escape the battle. Otherwise, they take damage, and the battle continues.
            if (hero.dex > enemy.dex + ran5()) {
                endBattle();
            } else {
                //Determines damage to the hero
                var playerDamage = enemy.str + ran5();
                playerHealth -= playerDamage;

                //Redraws the screen with adjusted health
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
                    let stringDamage = playerDamage.toString().replace('-', '');
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
    return Math.floor(Math.random() * 11) - 5;
}