//-----------Grab html elements
var htmlMistakes = document.getElementById('mistakes');
var BackgroundColor = document.getElementById('body');
var htmlSizeSlider = document.getElementById('gridSize');
var htmlBackgroundColorSlider = document.getElementById('gridColor');
var htmlBlockColorSlider = document.getElementById('blockColor');
var htmlGridSize = document.getElementById('h3GridSize');
var htmlBackgroundColor = document.getElementById('h3BackgroundColor');
var htmlBlockColor = document.getElementById('h3BlockColor');
var htmlNewGame = document.getElementById('newGame');
var htmlControlsFont = document.getElementById('controls');
var htmlSliderColor = document.getElementsByClassName('slider');

//-----------Configuration [adjustable by user]
var windowSize = 700;
var n = null; //number of tiles X and Y
var border = (Math.round(n/2)+1)*17; //space for numbers
var size = (windowSize-border)/n; //size of each tile
var correctColor = "lightgreen";
var fontColor = "black"; //grid numbers
var startTime = null; 
var tilesRemaining;
var mistakes;
var circles = [];
var complete;
var player;

//----------Configuartion [not by user]
var grid = {"border": ["2", "2", "3", "3", "4", "4", "5", "5", "6", "6", "7", "7", "8", "8", "9", "9", "10", "10", "11", "11", "12", "12", "13"],
			"correctColor" : ["navy", "aqua", "orange", "yellow", "lime", "teal", "white", "maroon", "purple", "olive"],
			"backgroundColor" : ["peachpuff", "lightyellow", "darkseagreen", "lightcyan", "plum", "snow", "cornsilk", "gainsboro", "wheat", "black"],
			"fontColor" : ["black", "black", "black", "black",  "black", "black", "black", "black", "black", "white"]}
var gap = 4; //gap between tiles (this number should be half of what you with the gap to be)
var padding = 5; //space around game on all sides
var textDistance = 20; //text distance away from first tile
var font = "17px Arial"; //Font for Grid Numbers
var baseColor = "grey";
var wrongColor = "red";
var ballColors = ["red", "blue", "lightgreen", "yellow", "pink"]
var gravity = 0.4; //gravity enacted on the balls
var friction = .7; //how quickly the balls stop rolling/bouncing;

//-----------Canvas Elements [do not change]
var baseLayer = document.getElementById('layer1');
var topLayer = document.getElementById('layer2');
var ballLayer = document.getElementById('ballLayer');
baseLayer.height = windowSize + (2 * padding);
baseLayer.width = windowSize + (2 * padding);
topLayer.height = windowSize + (2 * padding);
topLayer.width = windowSize + (2 * padding);
ballLayer.height = windowSize + (2 * padding);// + 200;
ballLayer.width = windowSize + (2 * padding);// + 200;
var c1 = baseLayer.getContext('2d');
var c2 = topLayer.getContext('2d');
var c3 = ballLayer.getContext('2d');

configureCanvas();

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
                htmlMistakes.textContent = "Mistakes: " + ++mistakes;
            }
        }
    }
    drawLayer2();
    if (startTime == null) startTime = Date.now();
    if (tilesRemaining == 0) {
        topLayer.style.pointerEvents = "none";
        // alert(" you took " + Math.floor((Date.now()-startTime)/1000) + "s to finish the game"); //print final time
        requestAnimationFrame(drawBalls);
        circleShow();
    }
}, false);

htmlNewGame.addEventListener('click', function(evt) {
    mistakes = 0;
    htmlMistakes.textContent = "Mistakes: 0";
    configureCanvas();
    cancelAnimationFrame(drawBalls);
    topLayer.style.pointerEvents = "visiblePainted";
}, false)

htmlSizeSlider.addEventListener('input', function(evt){
    htmlGridSize.textContent = "Grid Size: " + htmlSizeSlider.value;
}, false)

htmlBackgroundColorSlider.addEventListener('input', function(){
    htmlBackgroundColor.textContent = "Background Color: " + grid.backgroundColor[htmlBackgroundColorSlider.value];
	fontColor = grid.fontColor[htmlBackgroundColorSlider.value];
    BackgroundColor.style.backgroundColor = grid.backgroundColor[htmlBackgroundColorSlider.value];
    drawLayer1();
}, false)

htmlBackgroundColorSlider.addEventListener('input', function(){
    htmlBackgroundColor.textContent = grid.backgroundColor[htmlBackgroundColorSlider.value];
	fontColor = grid.fontColor[htmlBackgroundColorSlider.value];
    BackgroundColor.style.backgroundColor = grid.backgroundColor[htmlBackgroundColorSlider.value];
	htmlControlsFont.style.color = grid.fontColor[htmlBackgroundColorSlider.value];
    drawLayer1();
}, false)

htmlBlockColorSlider.addEventListener('input', function(){
    htmlBlockColor.textContent = grid.correctColor[htmlBlockColorSlider.value];
	correctColor = grid.correctColor[htmlBlockColorSlider.value];
    drawLayer2();
}, false)
