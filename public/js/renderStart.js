var total = 50;
var statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;

var startPicture = new Image();
startPicture.src ='../images/startMenu.png'

//This function renders the first screen and prompts the user for stats for their hero.
function renderStart() {
    movement = false;
    context.drawImage(startPicture, 0, 0, 500, 500);

    renderStartStats();

    renderText("Please enter your chosen stats. STR modifies your damage to enemies. LUCK determines how often you encounter enemies. The rest are just for show.", 50, 150, 250, 185);

    var button = document.createElement("button");
    button.setAttribute("id", "confirm");
    button.innerHTML = "START";
    wrapper.appendChild(button);
    
    button.onclick = function() {
        //This captures all the values the user inputs. The inputs are made into Number objects because Javascript still doesn't know the difference between strings and ints.
        /*
        var stats = document.querySelectorAll("input");
        hero.str = new Number (stats[0].value).valueOf() || 12;
        hero.con = new Number (stats[1].value).valueOf() || 15;
        hero.dex = new Number (stats[2].value).valueOf() || 5;
        hero.intel = new Number (stats[3].value).valueOf() || 5;
        hero.wis = new Number (stats[4].value).valueOf() || 5;
        hero.luck = new Number (stats[5].value).valueOf() || 8;
        */
        statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;
        if (statsTotal <= total) {
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

//This function renders the player stat names and their current values as the player changes them.
function renderStartStats() {
    context.clearRect(0, 0, 500, 500);
    context.drawImage(startPicture, 0, 0, 500, 500);
    context.strokeStyle = "White";
    context.fillStyle = "Black";
    context.font = "30px Impact";
    context.fillText("Remaining Points: " + (total-statsTotal), 50, 130);
    context.strokeText("Remaining Points: " + (total-statsTotal), 50, 130);
    let y = 75;
    let pArray = ["STR", "CON", "DEX", "INT", "WIS", "LUCK"];
    let statNames = ["str", "con", "dex", "intel", "wis", "luck"];
    for (let i = 1; i < 7; i++) {
        context.strokeStyle = "White";
        context.fillStyle = "Black";
        context.font = "30px Impact";
        context.fillText(pArray[i-1] + " " + hero[statNames[i-1]], 370, y);
        context.strokeText(pArray[i-1] + " " + hero[statNames[i-1]], 370, y);
        y += 75;
        var plus = document.createElement("input");
        plus.setAttribute("type", "image");
        plus.setAttribute("id", "plus"+i);
        plus.setAttribute("src", "../images/plus.png");
        plus.setAttribute("onClick", "plusMinusClick(this.id)");
        wrapper.appendChild(plus);
        var minus = document.createElement("input");
        minus.setAttribute("type", "image");
        minus.setAttribute("id", "minus"+i);
        minus.setAttribute("src", "../images/minus.png");
        minus.setAttribute("onClick", "plusMinusClick(this.id)");
        wrapper.appendChild(minus);
    }

}
//This function is what changes the chosen stats
function plusMinusClick(clickedID) {
    if (!textPrinting) {
        statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;
        if (statsTotal < total || clickedID.includes("minus")) {
            //statPointsRemaining--;
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
                    hero.str--;
                    break;
                case "minus2":
                    hero.con--;
                    break;
                case "minus3":
                    hero.dex--;
                    break;
                case "minus4":
                    hero.intel--;
                    break;
                case "minus5":
                    hero.wis--;
                    break;
                case "minus6":
                    hero.luck--;
                    break;
            }
            statsTotal = hero.str + hero.con + hero.dex + hero.intel + hero.wis + hero.luck;
            renderStartStats();
        } else {
            renderText("You have no stat points left to spend.", 50, 150, 250, 75);
        }
    }
}