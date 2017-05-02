var total = 50;
var statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;

var startPicture = new Image();
startPicture.src ='../images/startMenu.png'

//This function renders the first screen and prompts the user for stats for their hero.
function renderStart() {
    movement = false;
    context.drawImage(startPicture, 0, 0, 500, 500);

    renderStartStats();

    renderText("STR modifies your damage to enemies. CON determines your health. DEX helps you run away. INT clears the fog of war. WIS restores your health when you move. LUCK determines how often you encounter enemies.", 50, 150, 255, 240);

    //Declares and creates the START button
    var button = document.createElement("button");
    button.setAttribute("id", "confirm");
    button.innerHTML = "START";
    wrapper.appendChild(button);
    
    //Determines what happens when the START button is clicked
    button.onclick = function() {
        if (!textPrinting) {

            //This prevents the player from entering stats above the possible total for their character. Technically, this should be impossible given the button setup, but it hurts nothing by being here
            statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;
            if (statsTotal <= total) {
                //This sets the hero's starting health
                playerMax = hero.con * 10;
                playerHealth = hero.con * 10;
                movement = true;
                //This deletes all the DOM elements except for the canvas.
                while (wrapper.children.length > 1) {
                    wrapper.removeChild(wrapper.lastChild);
                }
                renderMap();
            } else {
                context.drawImage(startPicture, 0, 0, 500, 500);
                renderText("You're hero's stats are too high. You have " + total +  " point to spend total. You have " + statsTotal + " points spent including preset defaults", 50, 150, 250, 185);
            }
        }
    }

}

//This function renders the player stat names and their current values as the player changes them. It is called every time the player clicks a plus or minus button.
function renderStartStats() {
    context.clearRect(0, 0, 500, 500);
    context.drawImage(startPicture, 0, 0, 500, 500);
    context.textAlign = "start";
    context.strokeStyle = "White";
    context.fillStyle = "Black";
    context.font = "30px Impact";
    context.textAlign = "start";
    context.fillText("Remaining Points: " + (total-statsTotal), 50, 130);
    context.strokeText("Remaining Points: " + (total-statsTotal), 50, 130);
    let y = 75;
    let pArray = ["STR", "CON", "DEX", "INT", "WIS", "LUCK"];
    let statNames = ["str", "con", "dex", "intel", "wis", "luck"];
    //This loop creates all the plus and minus buttons as well as the text and number value between them.
    for (let i = 1; i < 7; i++) {
        //Writes text/stat number
        context.strokeStyle = "White";
        context.fillStyle = "Black";
        context.font = "30px Impact";
        context.fillText(pArray[i-1] + " " + hero[statNames[i-1]], 370, y);
        context.strokeText(pArray[i-1] + " " + hero[statNames[i-1]], 370, y);
        y += 75;
        //Creates plus button
        var plus = document.createElement("input");
        plus.setAttribute("type", "image");
        plus.setAttribute("id", "plus"+i);
        plus.setAttribute("src", "../images/plus.png");
        plus.setAttribute("onClick", "plusMinusClick(this.id)");
        wrapper.appendChild(plus);
        //Creates minus button
        var minus = document.createElement("input");
        minus.setAttribute("type", "image");
        minus.setAttribute("id", "minus"+i);
        minus.setAttribute("src", "../images/minus.png");
        minus.setAttribute("onClick", "plusMinusClick(this.id)");
        wrapper.appendChild(minus);
    }

}
//This function is what changes the chosen stats. It is called when a plus or minus button is clicked. It gets the ID of the button clicked to determine what to change. Each button has a unique ID. This function doesn't allow a player to lower any stat below 1.
function plusMinusClick(clickedID) {
    if (!textPrinting) {
        statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;
        //If the player tries to add more stats than allowed, their change isn't allowed unless the button pressed is a minus.
        if (statsTotal < total || clickedID.includes("minus")) {
            switch(clickedID) {
                case "plus1":
                    hero.str++;
                    break;
                case "plus2":
                    hero.con++;
                    break;
                case "plus3":
                    hero.dex++;
                    break;
                case "plus4":
                    hero.intel++;
                    break;
                case "plus5":
                    hero.wis++;
                    break;
                case "plus6":
                    hero.luck++;
                    break;
                case "minus1":
                    if (hero.str > 1) {
                        hero.str--;
                    }
                    break;
                case "minus2":
                    if (hero.con > 1) {
                        hero.con--;
                    }
                    break;
                case "minus3":
                    if (hero.dex > 1) {
                        hero.dex--;
                    }
                    break;
                case "minus4":
                    if (hero.intel > 1) {
                        hero.intel--;
                    }
                    break;
                case "minus5":
                    if (hero.wis > 1) {
                        hero.wis--;
                    }
                    break;
                case "minus6":
                    if (hero.luck > 1) {
                        hero.luck--;
                    }
                    break;
            }
            statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;
            renderStartStats();
        } else {
            renderText("You have no stat points left to spend.", 50, 150, 250, 75);
        }
    }
}