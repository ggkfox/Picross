//-----------Grab html elements
var htmlMistakes = document.getElementById('mistakes');
var BackgroundColor = document.getElementById('body');
var htmlSizeSlider = document.getElementById('gridSize');
var htmlBackgroundColorSlider = document.getElementById('gridColor');
var htmlBlockColorSlider = document.getElementById('blockColor');
var htmlGridSize = document.getElementById('h3GridSize');
var htmlBackgroundColor = document.getElementById('h3BackgroundColor');
var htmlBackgroundColorT = document.getElementById('h3BackgroundColorT');
var htmlBlockColor = document.getElementById('h3BlockColor');
var htmlBlockColorT = document.getElementById('h3BlockColorT');
var htmlNewGame = document.getElementById('newGame');
var htmlControlsFont = document.getElementById('controls');
var htmlSliderColor = document.getElementsByClassName('slider');
var winText = document.getElementById('win');
var htmlmode = document.getElementById('mode');
var htmlTimer = document.getElementById('timer');
var htmlLeaderboard = document.getElementById('leaderboard');
var htmlScores = document.getElementById('scores');
var htmlTilesRemaining = document.getElementById('remaining');
var htmlScoreOrder = document.getElementById('scoreOrder');
var htmlHint = document.getElementById('hint');
var htmlBadHint = document.getElementById('incHint');
var canvasContainer = document.getElementById('ccontainer');

//-----------Configuration [adjustable by user]
var windowSize = canvasContainer.offsetWidth * .9;
var n = null; //number of tiles X and Y
var border = (Math.round(n/2)+1)*17; //space for numbers
var size = (windowSize-border)/n; //size of each tile
var correctColor = "lightgreen";
var fontColor = "white"; //grid numbers
var startTime = 0;
var currTimeM = 0;
var currTimeS = 0; 
var activeGame = false;
var tilesRemaining;
var mistakes;
var circles = [];
var complete;
var player;

//----------Configuartion [not by user]
var grid = {"border": ["2", "2", "3", "3", "4", "4", "5", "5", "6", "6", "7", "7", "8", "8", "9", "9", "10", "10", "11", "11", "12", "12", "13"],
			"correctColor" : ["navy", "aqua", "orange", "yellow", "lime", "teal", "white", "saddlebrown", "purple", "olive"],
			"backgroundColor" : ["powderblue", "rosybrown", "lavender", "lightcyan", "thistle", "snow", "cornsilk", "darkolivegreen", "darkslategrey", "mediumpurple"],
			"fontColor" : ["white", "white", "white", "white",  "white", "white", "white", "white", "white", "white"]}
var gap = 5; //gap between tiles (this number should be half of what you with the gap to be)
var padding = 5; //space around game on all sides
var textDistance = 20; //text distance away from first tile
var font = "17px Arial"; //Font for Grid Numbers
var baseColor = "snow";
var wrongColor = "grey";
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

configureBoard();
requestAnimationFrame(drawBalls);

//-----LISTENERS------
topLayer.addEventListener('click', function(evt) {
    var mousePos = getMousePos(topLayer, evt);
    var coordinates = getIndex(mousePos.x, mousePos.y);
    if (coordinates != null) {
        if (player[coordinates.y][coordinates.x] == 0) {
            player[coordinates.y][coordinates.x] = 1;
            if (isCorrect(coordinates.x, coordinates.y)) {
                htmlTilesRemaining.innerHTML="Remaining Tiles: " + --tilesRemaining;
                activeGame = true;
            }
            else {
                htmlMistakes.textContent = "Mistakes: " + ++mistakes;
                activeGame = true;
            }
        }
    }
    drawLayer2();
    calculateTime();
    if (tilesRemaining == 0) {
        winText.style.display = "block";
        topLayer.style.pointerEvents = "none";
        calculateTime();
        levelname--;
        sendScore();
        levelname++;
        circleShow();
        activeGame = false;
    }
}, false);

htmlNewGame.addEventListener('click', function(evt) {
    winText.style.display = "none";
    mistakes = 0;
    htmlMistakes.textContent = "Mistakes: 0";
    configureBoard();
    configureCanvas();
    circles = [];
    topLayer.style.pointerEvents = "visiblePainted";
    activeGame = false;
    currTimeM = 0;
    currTimeS = 0;
}, false)

htmlSizeSlider.addEventListener('input', function(evt){
    htmlGridSize.textContent = "Grid Size: " + htmlSizeSlider.value;
}, false)

htmlBackgroundColorSlider.addEventListener('input', function(){
    htmlBackgroundColor.textContent = grid.backgroundColor[htmlBackgroundColorSlider.value];
    baseColor = grid.backgroundColor[htmlBackgroundColorSlider.value];
	fontColor = grid.fontColor[htmlBackgroundColorSlider.value];
    htmlBackgroundColorT.style.color = grid.fontColor[htmlBackgroundColorSlider.value];
    htmlBlockColorT.style.color = grid.fontColor[htmlBackgroundColorSlider.value];
    drawLayer1();
}, false)

htmlBlockColorSlider.addEventListener('input', function(){
    htmlBlockColor.textContent = grid.correctColor[htmlBlockColorSlider.value];
	correctColor = grid.correctColor[htmlBlockColorSlider.value];
    drawLayer2();
}, false)

htmlScoreOrder.addEventListener('click', function(){
    levelname--;
    getScores();
    levelname++;
}, false)

htmlHint.addEventListener('click', function(){
    var hint = getBest();
    if (hint != null){
        player[hint.y][hint.x]=1;
        drawLayer2();
    }
    if (tilesRemaining == 0) {
        winText.style.display = "block";
        topLayer.style.pointerEvents = "none";
        calculateTime();
        levelname--;
        sendScore();
        levelname++;
        circleShow();
        activeGame = false;
    }
}, false)

htmlBadHint.addEventListener('click', function(){
    var hint = getWorst();
    if (hint != null){
        player[hint.y][hint.x]=1;
        drawLayer2();
    }
}, false)

window.addEventListener('load', function(){
    setTimeout(getWindowSize, 30);
})

window.addEventListener('resize', function(){
    getWindowSize();
})