//This function renders the first screen and prompts the user for stats for their hero.
function renderStart() {
    movement = false;
    var startPicture = new Image();
    startPicture.src ='../images/startMenu.png'
    context.drawImage(startPicture, 0, 0, 500, 500);
    //This function writes the string in the first param, starting at the location specified by parameters 2 and 3. Parameters 4 and 5 determine the size of the box containing the text.
    //I spent a while writing this function and this is the only place I could think to put it.
    renderText("Please enter your chosen stats. STR modifies your damage to enemies. LUCK determines how often you encounter enemies. The rest are just for show.", 50, 150, 250, 185);

    //This creates input elements and paragraph elements to get user input.
    let pArray = ["STR", "CON", "DEX", "INT", "WIS", "LUCK"];
    for (let i = 1; i < 7; i++) {
        var input = document.createElement("input");
        input.setAttribute("maxlength", "3");
        input.setAttribute("id", "input"+i);
        wrapper.appendChild(input);
        var p = document.createElement("p");
        p.setAttribute("id", "p"+i);
        p.innerHTML = pArray[i-1];
        wrapper.appendChild(p);
    }

    var button = document.createElement("button");
    button.setAttribute("id", "confirm");
    button.innerHTML = "START";
    wrapper.appendChild(button);
    
    button.onclick = function() {
        //This captures all the values the user inputs. The inputs are made into Number objects because Javascript still doesn't know the difference between strings and ints.
        var stats = document.querySelectorAll("input");
        hero.str = new Number (stats[0].value).valueOf() || 10;
        hero.con = new Number (stats[1].value).valueOf() || 10;
        hero.dex = new Number (stats[2].value).valueOf() || 10;
        hero.intel = new Number (stats[3].value).valueOf() || 10;
        hero.wis = new Number (stats[4].value).valueOf() || 10;
        hero.luck = new Number (stats[5].value).valueOf() || 8;
        movement = true;
        console.log(hero);
        //This deletes all the DOM elements except for the canvas.
        while (wrapper.children.length > 1) {
            wrapper.removeChild(wrapper.lastChild);
        }
        renderMap();

    }


}