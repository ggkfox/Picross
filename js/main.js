//-----------Configure The Game
var topColor = "red";
var baseColor = "blue";
var padding = 5; //space around game on all sides
var windowSize = 600;
var border = 150; //space for numbers
var n = 2; //number of tiles X and Y
var gap = 2; //gap between tiles (this number should be half of what you with the gap to be)
var size = (windowSize-border)/n; //size of each tile
var font = "17px Arial"; //Font for Grid Numbers
var textDistance = 20; //text distance away from first tile
var fontColor = "black";

//-----------Canvas Elements [do not change]
var baseLayer = document.getElementById('layer1');
var topLayer = document.getElementById('layer2');
baseLayer.height = windowSize + (2 * padding);
baseLayer.width = windowSize + (2 * padding);
topLayer.height = windowSize + (2 * padding);
topLayer.width = windowSize + (2 * padding);
var c1 = baseLayer.getContext('2d');
var c2 = topLayer.getContext('2d');

var complete = fillArray();
var player = initualizeArray();
drawLayer1();
displayNumbers();

topLayer.addEventListener('click', function(evt) {
    var mousePos = getMousePos(topLayer, evt);
    var coordinates = getIndex(mousePos.x, mousePos.y);
    if (coordinates != null) {
        if (player[coordinates.x][coordinates.y] == 0) 
            player[coordinates.x][coordinates.y] = 1;
        else player[coordinates.x][coordinates.y] = 0;
    }
    clearCanvas(c2);
    drawLayer2();
    if (checkWin()) alert("WIN");
}, false);