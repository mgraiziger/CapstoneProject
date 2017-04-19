//This function will write given text (var text) at a given coordinate (var x, var y) in a rectangle of a given size (var width, var height). It will also automatically wrap a word if it is too long to be displayed in the space it has left. Note that if it is given a word that is too long to be displayed in the entire width of the rectangle (var width), it will write that word off the right side of the rectangle, and the word may not be readable.
function renderText(text, x, y, width, height) {
    text = text.concat(" ");
    var index = 0;
    var left = x + 15;
    var top = y + 15;

    //This declares variables used in finding word length, and finds the length of the first word to be written.
    var textArray = text.split("");
    var wordStart = 0;
    var wordEnd = textArray.indexOf(" ");
    var wordLength = (wordEnd - wordStart - 1) * 15;

    //This sets the color of the background and the words.
    context.fillStyle = "Black";
    context.fillRect(x, y, width, height);
    context.font = "15px Courier New";
    context.fillStyle = "White";

    function animateText() {
        //This if statement executes before each word is written, and compares the length of the word about to be written to the space left in the current line. If the line does not have enough space, the word is displayed on the next line
        movement = false;
        if (textArray[index] === " ") {
            wordStart = index;
            wordEnd = textArray.indexOf(" ", wordStart + 1);
            wordLength = (wordEnd - wordStart -1) * 15;

            if (wordLength > (width + x) - (left + 15)) {
            top += 15;
            left = x;
            }
        }
        context.fillText(textArray[index], left, top)
        index++;
        left += 15;

        if (index == textArray.length) {
            clearInterval(myInterval);
            movement = true;
        }
    }
    myInterval = setInterval(animateText, 25);
}