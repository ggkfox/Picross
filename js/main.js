//-----------Configuration
var correctColor = "lightgreen";
var wrongColor = "red";
var baseColor = "grey";
var padding = 5; //space around game on all sides
var windowSize = 600;
var border = 240; //space for numbers
var n = 10; //number of tiles X and Y
var gap = 2; //gap between tiles (this number should be half of what you with the gap to be)
var size = (windowSize-border)/n; //size of each tile
var font = "17px Arial"; //Font for Grid Numbers
var textDistance = 20; //text distance away from first tile
var fontColor = "black";
var gravity = 0.981; //gravity enacted on the balls
var friction = .7; //how quickly the balls stop rolling/bouncing;
var ballColors = ["red", "blue", "lightgreen", "yellow", "pink"]

//-----------other needed variables [dont change]
var startTime = null; 
var mistakes = 0;
var circles = [];


//-----------Canvas Elements [do not change]
var baseLayer = document.getElementById('layer1');
var topLayer = document.getElementById('layer2');
var ballLayer = document.getElementById('ballLayer');
baseLayer.height = windowSize + (2 * padding);
baseLayer.width = windowSize + (2 * padding);
topLayer.height = windowSize + (2 * padding);
topLayer.width = windowSize + (2 * padding);
ballLayer.height = windowSize + (2 * padding);
ballLayer.width = windowSize + (2 * padding);
var c1 = baseLayer.getContext('2d');
var c2 = topLayer.getContext('2d');
var c3 = ballLayer.getContext('2d');

var complete = fillArray();
var player = initualizeArray();
drawLayer1();
displayNumbers();

topLayer.addEventListener('click', function(evt) {
    var mousePos = getMousePos(topLayer, evt);
    var coordinates = getIndex(mousePos.x, mousePos.y);
    if (coordinates != null) {
        if (player[coordinates.y][coordinates.x] == 0) 
            player[coordinates.y][coordinates.x] = 1;
        else player[coordinates.y][coordinates.x] = 0;
    }
    drawLayer2();
    if (startTime == null) startTime = Date.now();
    if (checkWin()) alert(" you took " + Math.floor((Date.now()-startTime)/1000) + "s to finish the game"); //print final time
}, false);

for (var i = 0; i < 20; i++) {
    circles.push(new Circle(300, 100));
}
requestAnimationFrame(drawBalls);