//-----------Grab html elements
var htmlMistakes = document.getElementById('mistakes');

//-----------Configuration [adjustable by user]
var windowSize = 600;
var n = 10; //number of tiles X and Y
var border = (Math.round(n/2)+1)*17; //space for numbers
var size = (windowSize-border)/n; //size of each tile
var correctColor = "lightgreen";
var fontColor = "black";

//----------Configuartion [not by user]
var gap = 10; //gap between tiles (this number should be half of what you with the gap to be)
var padding = 5; //space around game on all sides
var textDistance = 20; //text distance away from first tile
var font = "17px Arial"; //Font for Grid Numbers
var baseColor = "grey";
var wrongColor = "red";
var ballColors = ["red", "blue", "lightgreen", "yellow", "pink"]
var gravity = 0.981; //gravity enacted on the balls
var friction = .7; //how quickly the balls stop rolling/bouncing;

//-----------other needed variables [dont change]
var startTime = null; 
var mistakes = 0;
var circles = [];
var tilesRemaining = 0;


//-----------Canvas Elements [do not change]
var baseLayer = document.getElementById('layer1');
var topLayer = document.getElementById('layer2');
var ballLayer = document.getElementById('ballLayer');
baseLayer.height = windowSize + (2 * padding);
baseLayer.width = windowSize + (2 * padding);
topLayer.height = windowSize + (2 * padding);
topLayer.width = windowSize + (2 * padding);
ballLayer.height = windowSize + (2 * padding) + 200;
ballLayer.width = windowSize + (2 * padding) + 200;
var c1 = baseLayer.getContext('2d');
var c2 = topLayer.getContext('2d');
var c3 = ballLayer.getContext('2d');

var complete = randomArray();
var player = blankArray();
drawLayer1();
displayNumbers();

//-----LISTENERS------
topLayer.addEventListener('click', function(evt) {
    var mousePos = getMousePos(topLayer, evt);
    var coordinates = getIndex(mousePos.x, mousePos.y);
    if (coordinates != null) {
        if (player[coordinates.y][coordinates.x] == 0) {
            player[coordinates.y][coordinates.x] = 1;
            if (isCorrect(coordinates.x, coordinates.y))
                tilesRemaining--;
            else {
                htmlMistakes.mistakes;
            }
        }
    }
    drawLayer2();
    if (startTime == null) startTime = Date.now();
    if (tilesRemaining == 0) {
        alert(" you took " + Math.floor((Date.now()-startTime)/1000) + "s to finish the game"); //print final time
        for (var i = 0; i < 20; i++) {
            circles.push(new Circle(300, 100));
        }
        requestAnimationFrame(drawBalls);
    }
}, false);